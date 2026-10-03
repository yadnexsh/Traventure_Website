<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CustomerRecord;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Verified;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('verification.notice', absolute: false));

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Customer', $user->role);
        $this->assertTrue(Hash::check('password', $user->password));

        $customerRecord = CustomerRecord::where('user_id', $user->id)->first();
        $this->assertNotNull($customerRecord);
        $this->assertEquals('Test User', $customerRecord->name);
    }

    public function test_duplicate_email_registration_rejected()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->post('/register', [
            'name' => 'Another User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_customer_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/');
    }

    public function test_invalid_login_rejected()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_customer_can_logout()
    {
        $user = User::factory()->create();
        
        $this->actingAs($user);
        
        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_password_reset_request_does_not_reveal_email_existence()
    {
        $response = $this->post('/forgot-password', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertSessionHas('status'); // it should act like it sent the email
    }

    public function test_password_can_be_reset()
    {
        $user = User::factory()->create();

        $token = Password::createToken($user);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect('/login');
        
        $user->refresh();
        
        $this->assertTrue(Hash::check('new-password', $user->password));
    }
    
    public function test_email_verification_screen_can_be_rendered()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->get('/verify-email');
        $response->assertStatus(200);
    }

    public function test_successful_email_verification()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        
        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('/');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        Event::assertDispatched(Verified::class);
    }

    public function test_invalid_email_verification_link()
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email@example.com')]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertStatus(403);
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_already_verified_account_redirects()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        
        $response = $this->actingAs($user)->get('/verify-email');
        $response->assertRedirect('/');
    }

    public function test_unverified_customer_can_login()
    {
        $user = User::factory()->create([
            'email' => 'unverified@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => null,
        ]);

        $response = $this->post('/login', [
            'email' => 'unverified@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/');
    }

    public function test_session_regenerated_after_login()
    {
        $user = User::factory()->create([
            'email' => 'test2@example.com',
            'password' => Hash::make('password'),
        ]);

        // Hit a page to start a session
        $this->get('/');
        $oldSessionId = session()->getId();

        $this->post('/login', [
            'email' => 'test2@example.com',
            'password' => 'password',
        ]);

        $this->assertNotEquals($oldSessionId, session()->getId());
    }

    public function test_password_reset_token_cannot_be_reused_and_old_password_invalidated()
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);
        $token = Password::createToken($user);

        // First reset
        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Attempt second reset with same token
        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'another-password',
            'password_confirmation' => 'another-password',
        ]);

        $response->assertSessionHasErrors('email'); // Invalid token
        
        // Old password no longer works
        $loginResponse = $this->post('/login', [
            'email' => $user->email,
            'password' => 'old-password',
        ]);
        
        $loginResponse->assertSessionHasErrors('email');
        $this->assertGuest();
        
        // New password works
        $loginResponse2 = $this->post('/login', [
            'email' => $user->email,
            'password' => 'new-password',
        ]);
        $this->assertAuthenticatedAs($user);
    }

    public function test_expired_or_invalid_password_reset_token()
    {
        $user = User::factory()->create();

        $response = $this->post('/reset-password', [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_role_tampering_during_registration_is_ignored()
    {
        $this->post('/register', [
            'name' => 'Hacker User',
            'email' => 'hacker@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'Admin', // Attempt to tamper
        ]);

        $user = User::where('email', 'hacker@example.com')->first();
        $this->assertEquals('Customer', $user->role);
    }

    public function test_verification_email_resend_is_rate_limited()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        
        for ($i = 0; $i < 6; $i++) {
            $this->actingAs($user)->post('/email/verification-notification');
        }

        $response = $this->actingAs($user)->post('/email/verification-notification');
        $response->assertStatus(429);
    }

    public function test_password_reset_is_rate_limited()
    {
        for ($i = 0; $i < 6; $i++) {
            $this->post('/forgot-password', [
                'email' => 'test@example.com',
            ]);
        }

        $response = $this->post('/forgot-password', [
            'email' => 'test@example.com',
        ]);
        $response->assertStatus(429);
    }
}
