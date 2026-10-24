<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutComponentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_does_not_include_theme_toggle_and_has_toast_and_back_to_top(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('x-theme-toggle');
        $response->assertDontSee('localStorage.getItem(\'theme\')', false);
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

    public function test_auth_pages_include_toast_and_back_to_top_without_theme_toggle(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Tilbage til toppen');
        $response->assertDontSee('localStorage.getItem(\'theme\')', false);
        $response->assertDontSee('x-theme-toggle');
    }

    public function test_toast_does_not_leak_raw_javascript_when_flashed(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->withSession([
            'success' => 'Din bemandingsforespørgsel er oprettet! FreyaService er gået i gang med at matche vikarer.',
        ])->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertDontSee('{ this.startTimer(newToast); });', false);
        $response->assertDontSee('role="region" aria-label="Notifications" >', false);
        $response->assertSee('Din bemandingsforespørgsel er oprettet!');
    }

    public function test_hero_renders_circular_experience_badge(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('16+');
        $response->assertSee('ÅRS ERFARING');

        $responseEn = $this->get('/locale/en');
        $responseEn = $this->get('/');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('16+');
        $responseEn->assertSee('YEARS EXP.');
    }
}
