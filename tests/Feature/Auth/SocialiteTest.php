<?php

namespace Tests\Feature\Auth;

use App\Models\CustomerRecord;
use App\Models\ExternalIdentity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;

class SocialiteTest extends TestCase
{
    use RefreshDatabase;

    protected function mockGoogleUser($id = '12345', $email = 'test@gmail.com', $name = 'Test User', $emailVerified = true)
    {
        $abstractUser = \Mockery::mock(SocialiteUser::class);
        $abstractUser->shouldReceive('getId')->andReturn($id);
        $abstractUser->shouldReceive('getEmail')->andReturn($email);
        $abstractUser->shouldReceive('getName')->andReturn($name);
        $abstractUser->user = ['email_verified' => $emailVerified];

        $provider = \Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        return $abstractUser;
    }

    public function test_google_redirect_route_exists()
    {
        $response = $this->get(route('google.redirect'));
        $response->assertRedirect();
        $this->assertStringContainsString('accounts.google.com/o/oauth2', $response->headers->get('Location'));
    }

    public function test_new_google_user_creates_account()
    {
        $this->mockGoogleUser();

        $response = $this->get(route('google.callback'));

        $response->assertRedirect(route('home', absolute: false));
        $this->assertAuthenticated();

        $user = User::where('email', 'test@gmail.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Customer', $user->role);
        $this->assertNull($user->password); // Google-only account doesn't need fake password
        $this->assertNotNull($user->email_verified_at); // Came from trusted claim

        $customerRecord = CustomerRecord::where('user_id', $user->id)->first();
        $this->assertNotNull($customerRecord);
        $this->assertEquals('Test User', $customerRecord->name);

        $identity = ExternalIdentity::where('user_id', $user->id)->first();
        $this->assertNotNull($identity);
        $this->assertEquals('google', $identity->provider);
        $this->assertEquals('12345', $identity->provider_user_id);
    }

    public function test_existing_google_identity_logs_in()
    {
        $this->mockGoogleUser();

        // First login creates the user
        $this->get(route('google.callback'));
        $this->post('/logout');
        $this->assertGuest();

        // Second login
        $this->mockGoogleUser();
        $response = $this->get(route('google.callback'));

        $response->assertRedirect(route('home', absolute: false));
        $this->assertAuthenticated();

        $this->assertEquals(1, User::where('email', 'test@gmail.com')->count()); // No duplicate users created
    }

    public function test_google_session_regeneration()
    {
        $this->mockGoogleUser();
        Session::start();
        $oldSessionId = Session::getId();

        $this->get(route('google.callback'));

        $this->assertNotEquals($oldSessionId, Session::getId());
    }

    public function test_existing_email_password_account_is_not_silently_merged()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
        ]);
        CustomerRecord::create(['user_id' => $user->id, 'name' => 'Existing']);

        $this->mockGoogleUser('999', 'test@gmail.com'); // Same email, new google ID

        $response = $this->get(route('google.callback'));

        // Should be rejected to login with password
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->assertEquals(0, ExternalIdentity::count());
    }

    public function test_authenticated_user_can_link_google_account()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->mockGoogleUser('999', 'test@gmail.com');

        $response = $this->get(route('google.callback'));
        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('external_identities', [
            'user_id' => $user->id,
            'provider' => 'google',
            'provider_user_id' => '999',
        ]);
    }

    public function test_invalid_oauth_callback_is_rejected()
    {
        // Mock throwing exception like Socialite does on invalid state
        Socialite::shouldReceive('driver')->with('google')->andThrow(new \Exception('Invalid state'));

        $response = $this->get(route('google.callback'));
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
