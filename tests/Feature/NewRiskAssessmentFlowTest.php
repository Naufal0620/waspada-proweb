<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\AssessmentQuestionSeeder;
use Database\Seeders\IndicatorSeeder;
use Database\Seeders\PatternSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewRiskAssessmentFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AdminSeeder::class,
            IndicatorSeeder::class,
            AssessmentQuestionSeeder::class,
            PatternSeeder::class,
        ]);
    }

    public function test_home_page_can_be_rendered(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Security You Can Rely On');
    }

    public function test_assessment_page_can_be_rendered(): void
    {
        $response = $this->get(route('assessments.create'));

        $response->assertOk();
        $response->assertSee('Pemeriksaan Potensi Risiko');
        $response->assertSee('Kuesioner Indikator');
    }

    public function test_user_can_submit_assessment_and_view_high_risk_result(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        // Ambil opsi 'yes' dari pertanyaan pertanyaan
        $questions = \App\Models\AssessmentQuestion::with('options')->get();
        $answers = [];

        foreach ($questions as $q) {
            $yesOption = $q->options->firstWhere('value', 'yes');
            $answers[$q->id] = $yesOption->id;
        }

        $response = $this->actingAs($user)->post(route('assessments.store'), [
            'answers' => $answers,
        ]);

        $response->assertOk();
        $response->assertSee('Hasil Analisis Risiko');
        $response->assertSee('CRITICAL DANGER');

        $this->assertDatabaseHas('assessments', [
            'user_id' => $user->id,
            'risk_level' => 'high',
        ]);
    }

    public function test_missing_core_questions_triggers_validation_error(): void
    {
        $response = $this->post(route('assessments.store'), [
            'answers' => [9999 => 1],
        ]);

        $response->assertSessionHasErrors('answers');
    }
}
