<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetAndVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_screen_can_be_rendered(): void
    {
        $response = $this->get(route('password.request'));

        $response->assertOk();
        $response->assertSee('Pemulihan Kata Sandi');
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::factory()->create(['email' => 'user@waspada.test']);

        $response = $this->post(route('password.email'), [
            'email' => 'user@waspada.test',
        ]);

        $response->assertSessionHas('status');
        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create(['email' => 'user@waspada.test']);
        $token = Password::createToken($user);

        $response = $this->get(route('password.reset', ['token' => $token, 'email' => 'user@waspada.test']));

        $response->assertOk();
        $response->assertSee('Kata Sandi Baru');
    }

    public function test_password_can_be_reset(): void
    {
        $user = User::factory()->create(['email' => 'user@waspada.test']);
        $token = Password::createToken($user);

        $response = $this->post(route('password.update'), [
            'token' => $token,
            'email' => 'user@waspada.test',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertTrue(auth()->attempt([
            'email' => 'user@waspada.test',
            'password' => 'new-secure-password',
        ]));
    }
}
