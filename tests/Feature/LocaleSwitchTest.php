<?php

namespace Tests\Feature;

use App\Models\ClientProfile;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleSwitchTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_switch_locale(): void
    {
        $response = $this->from('/')->get('/locale/en');
        $response->assertSessionHas('locale', 'en');
        $response->assertRedirect('/');

        $response = $this->from('/')->get('/locale/da');
        $response->assertSessionHas('locale', 'da');
        $response->assertRedirect('/');
    }

    public function test_guest_login_has_home_link_and_password_visibility_control_in_both_locales(): void
    {
        $this->withSession(['locale' => 'en'])
            ->get('/login')
            ->assertOk()
            ->assertSee('Home')
            ->assertSee('href="' . route('home') . '"', false)
            ->assertSee('Show password')
            ->assertSee('Hide password');

        $this->withSession(['locale' => 'da'])
            ->get('/login')
            ->assertOk()
            ->assertSee('Hjem')
            ->assertSee('Vis adgangskode')
            ->assertSee('Skjul adgangskode');
    }

    public function test_admin_dashboard_renders_in_english_and_danish(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'locale' => 'en',
        ]);

        $response = $this->actingAs($admin)
            ->withSession(['locale' => 'en'])
            ->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Workers (CRM)');
        $response->assertSee('Invoices');
        $response->assertSee(route('locale.switch', 'da'), false);
        $response->assertSee(route('locale.switch', 'en'), false);
        $response->assertSee('Switch to English', false);

        $responseDa = $this->actingAs($admin)
            ->withSession(['locale' => 'da'])
            ->get('/admin/dashboard');

        $responseDa->assertStatus(200);
        $responseDa->assertSee('Vikarer (CRM)');
        $responseDa->assertSee('Fakturaer');
        $responseDa->assertSee(route('locale.switch', 'da'), false);
        $responseDa->assertSee(route('locale.switch', 'en'), false);
        $responseDa->assertSee('Skift til dansk', false);
    }

    public function test_client_dashboard_renders_in_english_and_danish(): void
    {
        $user = User::factory()->create([
            'role' => 'client',
            'locale' => 'en',
        ]);

        ClientProfile::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'cvr' => '12345678',
            'address' => 'Vestergade 1',
            'city' => 'København',
            'postcode' => '1456',
            'contact_person' => 'Thomas Jensen',
            'phone' => '12345678',
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)
            ->withSession(['locale' => 'en'])
            ->get('/client/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Book Staff');

        $responseDa = $this->actingAs($user)
            ->withSession(['locale' => 'da'])
            ->get('/client/dashboard');

        $responseDa->assertStatus(200);
        $responseDa->assertSee('Bestil Vikar');
    }

    public function test_worker_dashboard_renders_in_english_and_danish(): void
    {
        $user = User::factory()->create([
            'role' => 'worker',
            'locale' => 'en',
        ]);

        WorkerProfile::create([
            'user_id' => $user->id,
            'city' => 'København',
            'postcode' => '1456',
            'status' => 'approved',
            'skills' => ['Tjener'],
        ]);

        $response = $this->actingAs($user)
            ->withSession(['locale' => 'en'])
            ->get('/worker/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Available Shifts');
        $response->assertSee('Earnings');

        $responseDa = $this->actingAs($user)
            ->withSession(['locale' => 'da'])
            ->get('/worker/dashboard');

        $responseDa->assertStatus(200);
        $responseDa->assertSee('Ledige Vagter');
        $responseDa->assertSee('Indtjening');
    }

    public function test_how_it_works_page_renders_in_english_and_danish(): void
    {
        $responseEn = $this->withSession(['locale' => 'en'])->get('/how-it-works');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Company (Client)');
        $responseEn->assertSee('Create a request via the portal in under 2 min');
        $responseEn->assertSee("Receive confirmation with the temp worker&#039;s name and profile", false);
        $responseEn->assertSee('Generate company QR code once');
        $responseEn->assertSee('Approve hours with one click — zero paperwork');
        $responseEn->assertSee('Receive invoice automatically with detailed specification');
        $responseEn->assertSee('Worker (Employee)');
        $responseEn->assertSee('Create your profile and choose qualifications');

        $responseDa = $this->withSession(['locale' => 'da'])->get('/how-it-works');
        $responseDa->assertStatus(200);
        $responseDa->assertSee('Virksomhed (Kunde)');
        $responseDa->assertSee('Opret en forespørgsel via portalen på under 2 min');
        $responseDa->assertSee('Modtag bekræftelse med vikarens navn og profil');
        $responseDa->assertSee('Generer QR-kode til virksomheden én gang');
        $responseDa->assertSee('Godkend timer med ét klik — ingen papirarbejde');
        $responseDa->assertSee('Modtag faktura automatisk med specifikation');
        $responseDa->assertSee('Vikar (Arbejdstager)');
        $responseDa->assertSee('Opret din profil og vælg kompetencer');
    }

    public function test_services_page_renders_in_english_and_danish(): void
    {
        $responseEn = $this->withSession(['locale' => 'en'])->get('/services');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('Temporary Staff');
        $responseEn->assertSee('Urgent &amp; short-term coverage', false);
        $responseEn->assertSee('Permanent Hiring');
        $responseEn->assertSee('Part-Time Staff');
        $responseEn->assertSee('Flexible Part-Time Staffing');
        $responseEn->assertSee('Healthcare');
        $responseEn->assertSee('Hospitality');
        $responseEn->assertSee('Vetted temp workers with verified references');
        $responseEn->assertSee('Request staffing');
        $responseEn->assertSee('Apply as worker');

        $responseDa = $this->withSession(['locale' => 'da'])->get('/services');
        $responseDa->assertStatus(200);
        $responseDa->assertSee('Vikarbemanding');
        $responseDa->assertSee('Akut og kortvarig vikardækning');
        $responseDa->assertSee('Fast Rekruttering');
        $responseDa->assertSee('Deltidsbemanding');
        $responseDa->assertSee('Fleksibel deltidsbemanding');
        $responseDa->assertSee('Sundhed &amp; Pleje', false);
        $responseDa->assertSee('Hotel &amp; Restauration', false);
        $responseDa->assertSee('Gennemtestede vikarer med referencer');
        $responseDa->assertSee('Bestil bemanding');
        $responseDa->assertSee('Bliv vikar');
    }

    public function test_top_bar_language_switch_shows_low_underline_for_active_locale(): void
    {
        // Default / Danish
        $responseDa = $this->withSession(['locale' => 'da'])->get('/');
        $responseDa->assertStatus(200);
        $responseDa->assertSee('underline underline-offset-4 decoration-2 decoration-teal');

        // English switch
        $responseEn = $this->withSession(['locale' => 'en'])->get('/');
        $responseEn->assertStatus(200);
        $responseEn->assertSee('underline underline-offset-4 decoration-2 decoration-teal');

        // Public layout page (services)
        $responseServices = $this->withSession(['locale' => 'en'])->get('/services');
        $responseServices->assertStatus(200);
        $responseServices->assertSee('underline underline-offset-4 decoration-2 decoration-teal');
    }

    public function test_locale_switched_before_login_persists_to_portal_and_user_profile(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'locale' => 'da',
            'password' => bcrypt('Admin2026!'),
        ]);

        // 1. Switch locale to English on the landing/login page
        $this->get('/locale/en');

        // 2. Perform login
        $loginResponse = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'Admin2026!',
        ]);

        $loginResponse->assertRedirect(route('admin.dashboard'));

        // 3. Admin user database profile is now updated to English
        $this->assertEquals('en', $admin->fresh()->locale);

        // 4. Portal renders entirely in English
        $portalResponse = $this->get('/admin/dashboard');
        $portalResponse->assertStatus(200);
        $portalResponse->assertSee('Workers (CRM)');
        $portalResponse->assertSee('Invoices');
    }

    public function test_portal_navbar_includes_language_switcher_like_public_and_login_pages(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'locale' => 'da',
        ]);

        // Portal navbar should expose the language switcher for the current admin
        $portalResponse = $this->actingAs($admin)->get('/admin/dashboard');
        $portalResponse->assertStatus(200);
        $portalResponse->assertSee('/locale/da');
        $portalResponse->assertSee('/locale/en');
        $portalResponse->assertSee('aria-current="true"', false);
        $portalResponse->assertSee('Admin Portal');

        // Public and login pages should contain language switcher
        auth()->logout();

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('/locale/da');
        $homeResponse->assertSee('/locale/en');

        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('/locale/da');
        $loginResponse->assertSee('/locale/en');
    }
}
