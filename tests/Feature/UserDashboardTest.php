<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Discussion;
use App\Models\ForumCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_dashboard_and_history(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $assessment = Assessment::create([
            'user_id' => $user->id,
            'session_id' => 'dummy-session-123',
            'risk_level' => 'high',
            'information_status' => 'sufficient',
            'match_status' => 'matched',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Riwayat Pemeriksaan Risiko');
        $response->assertSee('CRITICAL DANGER');
        $response->assertSee('#SEC-' . str_pad($assessment->id, 5, '0', STR_PAD_LEFT));
    }

    public function test_admin_is_redirected_from_user_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_user_can_view_their_own_assessment_result(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $assessment = Assessment::create([
            'user_id' => $user->id,
            'session_id' => 'sess-1',
            'risk_level' => 'warning',
            'information_status' => 'sufficient',
            'match_status' => 'matched',
        ]);

        $response = $this->actingAs($user)->get(route('assessments.show', $assessment->id));

        $response->assertOk();
        $response->assertSee('Hasil Analisis Risiko');
    }

    public function test_user_cannot_view_other_users_assessment(): void
    {
        $userA = User::factory()->create(['role' => 'user']);
        $userB = User::factory()->create(['role' => 'user']);

        $assessmentA = Assessment::create([
            'user_id' => $userA->id,
            'session_id' => 'sess-a',
            'risk_level' => 'high',
            'information_status' => 'sufficient',
            'match_status' => 'matched',
        ]);

        $response = $this->actingAs($userB)->get(route('assessments.show', $assessmentA->id));

        $response->assertForbidden();
    }
}
