<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAssessmentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_assessments_management_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user', 'name' => 'Budi Pengguna']);

        $assessment = Assessment::create([
            'user_id' => $user->id,
            'session_id' => 'sesi-budi-1234',
            'risk_level' => 'high',
            'information_status' => 'sufficient',
            'match_status' => 'matched',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.assessments.index'));

        $response->assertOk();
        $response->assertSee('Pemeriksaan Risiko Pengguna');
        $response->assertSee('Budi Pengguna');
        $response->assertSee('#SEC-' . str_pad($assessment->id, 5, '0', STR_PAD_LEFT));
    }

    public function test_admin_can_view_specific_assessment_detail(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);

        $assessment = Assessment::create([
            'user_id' => $user->id,
            'session_id' => 'sesi-detail-999',
            'risk_level' => 'warning',
            'information_status' => 'sufficient',
            'match_status' => 'matched',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.assessments.show', $assessment->id));

        $response->assertOk();
        $response->assertSee('Detail Asesmen #SEC-' . str_pad($assessment->id, 5, '0', STR_PAD_LEFT));
        $response->assertSee('sesi-detail-999');
    }

    public function test_regular_user_cannot_access_admin_assessments(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.assessments.index'));

        $response->assertForbidden();
    }
}
