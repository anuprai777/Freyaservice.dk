<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutComponentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_includes_theme_toggle_toast_and_back_to_top(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('localStorage.getItem(\'theme\')', false);
        $response->assertSee('Meddelelser');
        $response->assertSee('Tilbage til toppen');
    }

    public function test_form_success_notification_renders_when_flashed(): void
    {
        $response = $this->withSession([
            'success' => 'Bemandingsforespørgsel oprettet!',
        ])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Bemandingsforespørgsel oprettet!');
        $response->assertSee('Succes');
    }

    public function test_form_status_notification_renders_when_flashed(): void
    {
        $response = $this->withSession([
            'status' => 'profile-updated',
        ])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Profil opdateret!');
    }

    public function test_auth_pages_include_theme_toggle_and_toast(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Tilbage til toppen');
        $response->assertSee('localStorage.getItem(\'theme\')', false);
    }
}
