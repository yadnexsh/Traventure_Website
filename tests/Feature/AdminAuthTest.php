<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_customers_receive_forbidden_response()
    {
        $user = User::factory()->create(['role' => 'Customer']);
        
        $response = $this->actingAs($user)->get('/admin');
        
        $response->assertStatus(403);
    }

    public function test_authorized_administrators_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        
        $response = $this->actingAs($admin)->get('/admin');
        
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_customer_cannot_promote_to_admin_via_registration()
    {
        $response = $this->post('/register', [
            'name' => 'Sneaky User',
            'email' => 'sneaky@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'Admin' // Attempting to tamper
        ]);

        $response->assertRedirect('/verify-email');
        
        $user = User::where('email', 'sneaky@example.com')->first();
        $this->assertEquals('Customer', $user->role);
    }
}
