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
    
    public function test_partial_pattern_match_is_not_detected(): void
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

        // Dua dari tiga indikator pola dipilih → threshold ≥2 terpenuhi → terdeteksi.
        $response = $this->postJson('/assessments', [
            'indicators' => [
                $identity->id,
                $credential->id,
            ],
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.risk_level', 'high')
            ->assertJsonCount(1, 'data.matched_patterns');
    }

    public function test_multiple_matching_patterns_are_returned(): void
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
            [$identity, $credential]
        );

        $this->createPattern(
            'Penipuan Mengatasnamakan Pihak Resmi',
            'warning',
            [$identity, $link]
        );

        // Pilihan ini cocok dengan kedua pola.
        $response = $this->postJson('/assessments', [
            'indicators' => [
                $identity->id,
                $credential->id,
                $link->id,
            ],
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.risk_level', 'high')
            ->assertJsonCount(2, 'data.matched_patterns')
            ->assertJsonFragment([
                'name' => 'Phishing melalui Tautan',
            ])
            ->assertJsonFragment([
                'name' => 'Penipuan Mengatasnamakan Pihak Resmi',
            ]);
    }

    public function test_inactive_indicator_is_rejected(): void
    {
        $indicator = Indicator::create([
            'category' => 'credential',
            'label' => 'Indikator yang sudah tidak aktif',
            'is_active' => false,
        ]);

        $response = $this->postJson('/assessments', [
            'indicators' => [$indicator->id],
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('indicators');

        $this->assertDatabaseCount('assessments', 0);
    }

    
    public function test_duplicate_indicators_are_rejected(): void
    {
        $indicator = $this->createIndicator(
            'identity',
            'Mengaku sebagai pihak resmi'
        );

        $response = $this->postJson('/assessments', [
            'indicators' => [
                $indicator->id,
                $indicator->id,
            ],
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('indicators.1');

        $this->assertDatabaseCount('assessments', 0);
    }

}
