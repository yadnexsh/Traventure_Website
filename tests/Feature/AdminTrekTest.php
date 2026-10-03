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

    public function test_admin_can_view_index_and_create_form()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        
        $this->actingAs($admin)->get('/admin/treks')->assertOk()->assertViewIs('admin.treks.index');
        $this->actingAs($admin)->get('/admin/treks/create')->assertOk()->assertViewIs('admin.treks.create');
    }

    public function test_admin_can_create_trek_with_valid_difficulty_and_slug()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $response = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'New Trek',
            'slug' => 'new-trek',
            'price' => 5000,
            'summary' => 'A great trek',
            'difficulty' => 'Moderate',
            'duration' => 7,
            'published_status' => 'published',
        ]);
        
        $response->assertRedirect('/admin/treks');
        $this->assertDatabaseHas('treks', [
            'slug' => 'new-trek', 
            'difficulty' => 'Moderate',
        ]);
    }

    public function test_difficulty_is_required_when_publishing()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        
        // Fails because published without difficulty
        $response = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'Missing Difficulty',
            'slug' => 'missing-difficulty',
            'price' => 1000,
            'published_status' => 'published',
            'difficulty' => '', // placeholder or missing
        ]);
        $response->assertSessionHasErrors(['difficulty']);
        $this->assertDatabaseMissing('treks', ['slug' => 'missing-difficulty']);

        // Succeeds because saved as draft without difficulty
        $responseDraft = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'Missing Difficulty Draft',
            'slug' => 'missing-difficulty-draft',
            'price' => 1000,
            'published_status' => 'draft',
            'difficulty' => '',
        ]);
        $responseDraft->assertSessionHasNoErrors();
        $this->assertDatabaseHas('treks', ['slug' => 'missing-difficulty-draft']);
    }

    public function test_invalid_difficulty_and_slug_format_are_rejected()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $response = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'Bad Values',
            'slug' => 'Bad Slug With Spaces!', // Invalid slug format
            'price' => 1000,
            'published_status' => 'published',
            'difficulty' => 'Impossible', // Invalid enum
        ]);
        
        $response->assertSessionHasErrors(['slug', 'difficulty']);
        $this->assertDatabaseMissing('treks', ['title' => 'Bad Values']);
    }

    public function test_duplicate_slug_is_rejected()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        Trek::factory()->create(['slug' => 'existing-trek']);

        $response = $this->actingAs($admin)->post('/admin/treks', [
            'title' => 'Another Trek',
            'slug' => 'existing-trek', // Duplicate
            'price' => 1000,
            'published_status' => 'draft',
        ]);
        
        $response->assertSessionHasErrors(['slug']);
    }

    public function test_admin_can_edit_title_without_changing_slug()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create(['title' => 'Old Title', 'slug' => 'original-slug', 'published_status' => 'draft']);

        $response = $this->actingAs($admin)->put('/admin/treks/' . $trek->id, [
            'title' => 'New Custom Title',
            'slug' => 'original-slug', // Preserved slug from UI
            'price' => 1000,
            'published_status' => 'draft',
        ]);
        
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('treks', ['id' => $trek->id, 'title' => 'New Custom Title', 'slug' => 'original-slug']);
    }

    public function test_publishing_and_unpublishing_updates_the_correct_trek()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create(['published_status' => 'draft', 'difficulty' => 'Easy']);

        $payload = [
            'title' => $trek->title,
            'slug' => $trek->slug,
            'price' => $trek->price,
            'difficulty' => $trek->difficulty,
            'published_status' => 'published'
        ];

        // Publish
        $this->actingAs($admin)->put('/admin/treks/' . $trek->id, $payload)->assertSessionHasNoErrors();
        $this->assertDatabaseHas('treks', ['id' => $trek->id, 'published_status' => 'published']);

        // Unpublish
        $payload['published_status'] = 'draft';
        $this->actingAs($admin)->put('/admin/treks/' . $trek->id, $payload)->assertSessionHasNoErrors();
        $this->assertDatabaseHas('treks', ['id' => $trek->id, 'published_status' => 'draft']);
    }

    public function test_public_trek_listings_show_published_and_hide_drafts()
    {
        $publishedTrek = Trek::factory()->create(['published_status' => 'published']);
        $draftTrek = Trek::factory()->create(['published_status' => 'draft']);

        $response = $this->get('/treks');
        $response->assertOk();
        $response->assertSee($publishedTrek->title);
        $response->assertDontSee($draftTrek->title);
        
        // Direct detail page access
        $this->get('/treks/' . $publishedTrek->slug)->assertOk();
        $this->get('/treks/' . $draftTrek->slug)->assertNotFound();
    }

    public function test_guests_and_customers_cannot_access_admin_routes()
    {
        $customer = User::factory()->create(['role' => 'Customer']);
        
        $this->get('/admin/treks')->assertRedirect('/login');
        $this->actingAs($customer)->get('/admin/treks')->assertForbidden();
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
