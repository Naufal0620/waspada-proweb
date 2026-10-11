<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Indicator;
use App\Models\Pattern;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RiskAssessmentTest extends TestCase
{
    use RefreshDatabase;

    private function createIndicator(
        string $category,
        string $label
    ): Indicator {
        return Indicator::create([
            'category' => $category,
            'label' => $label,
            'is_active' => true,
        ]);
    }

    private function createPattern(
        string $name,
        string $riskLevel,
        array $indicators
    ): Pattern {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $pattern = Pattern::create([
            'name' => $name,
            'description' => 'Pola untuk pengujian.',
            'risk_level' => $riskLevel,
            'created_by' => $admin->id,
        ]);

        $pattern->indicators()->sync(
            collect($indicators)->pluck('id')->all()
        );

        return $pattern;
    }

    public function test_phishing_indicators_return_high_risk(): void
    {
        $identity = $this->createIndicator(
            'identity',
            'Mengaku sebagai pihak resmi'
        );

        $credential = $this->createIndicator(
            'credential',
            'Meminta kode OTP atau kata sandi'
        );

        $link = $this->createIndicator(
            'link',
            'Mengirim tautan yang mencurigakan'
        );

        $this->createPattern(
            'Phishing melalui Tautan',
            'high',
            [$identity, $credential, $link]
        );

        $response = $this->postJson('/assessments', [
            'indicators' => [
                $identity->id,
                $credential->id,
                $link->id,
            ],
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.risk_level', 'high');

        $this->assertDatabaseHas('assessments', [
            'id' => 1,
            'risk_level' => 'high',
        ]);

        $this->assertDatabaseCount('assessment_indicators', 3);
    }

    public function test_gift_scam_indicators_return_warning_risk(): void
    {
        $prize = $this->createIndicator(
            'prize',
            'Menjanjikan hadiah yang tidak terduga'
        );

        $payment = $this->createIndicator(
            'payment',
            'Meminta transfer ke rekening pribadi'
        );

        $urgency = $this->createIndicator(
            'urgency',
            'Tekanan untuk bertindak segera'
        );

        $this->createPattern(
            'Penipuan Berkedok Hadiah',
            'warning',
            [$prize, $payment, $urgency]
        );

        $response = $this->postJson('/assessments', [
            'indicators' => [
                $prize->id,
                $payment->id,
                $urgency->id,
            ],
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.risk_level', 'warning');
    }

    public function test_unmatched_indicators_return_low_risk(): void
    {
        $indicator = $this->createIndicator(
            'other',
            'Indikator pengujian tanpa pola'
        );

        $response = $this->postJson('/assessments', [
            'indicators' => [$indicator->id],
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.risk_level', 'low');
    }

    public function test_empty_indicators_are_rejected(): void
    {
        $response = $this->postJson('/assessments', [
            'indicators' => [],
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('indicators');

        $this->assertDatabaseCount('assessments', 0);
    }

    public function test_nonexistent_indicator_is_rejected(): void
    {
        $response = $this->postJson('/assessments', [
            'indicators' => [999999],
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('indicators.0');

        $this->assertDatabaseCount('assessments', 0);
    }
}
