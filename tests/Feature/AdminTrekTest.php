<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Trek;

class AdminTrekTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_trek()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $response = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'New Trek',
            'slug' => 'new-trek',
            'price' => 5000,
            'published_status' => 'published',
        ]);
        $response->assertRedirect('/admin/treks');
        $this->assertDatabaseHas('treks', ['slug' => 'new-trek', 'published_status' => 'published']);
    }

    public function test_public_cannot_create_trek()
    {
        $response = $this->post('/admin/treks', [
            'title' => 'New Trek',
            'slug' => 'new-trek',
            'price' => 5000,
            'published_status' => 'published',
        ]);
        $response->assertRedirect('/login');
    }

    public function test_admin_can_edit_trek()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create(['published_status' => 'draft']);

        $response = $this->actingAs($admin)->put('/admin/treks/' . $trek->id, [
            'title' => 'Updated Trek',
            'slug' => $trek->slug,
            'price' => 6000,
            'published_status' => 'published',
        ]);
        
        $response->assertRedirect('/admin/treks');
        $this->assertDatabaseHas('treks', ['id' => $trek->id, 'published_status' => 'published', 'price' => 6000]);
    }

    public function test_admin_cannot_delete_trek()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();

        $response = $this->actingAs($admin)->delete('/admin/treks/' . $trek->id);
        
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('treks', ['id' => $trek->id]);
    }
}
