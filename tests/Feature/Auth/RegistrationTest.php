<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_client_registration_shows_only_company_form(): void
    {
        $response = $this->get('/register?role=client');

        $response->assertStatus(200);
        $response->assertSee('Opret virksomhedskonto');
        $response->assertSee('Virksomhedsoplysninger');
        $response->assertSee('CVR-nummer');
        $response->assertDontSee('Vikar (Arbejdstager)');
        $response->assertDontSee('Vikarprofil & Kompetencer');
    }

    public function test_worker_registration_shows_only_worker_form(): void
    {
        $response = $this->get('/register?role=worker');

        $response->assertStatus(200);
        $response->assertSee('Opret vikarprofil');
        $response->assertSee('Vikarprofil & Kompetencer');
        $response->assertDontSee('Virksomhed (Kunde)');
        $response->assertDontSee('Virksomhedsoplysninger');
        $response->assertDontSee('CVR-nummer (8 cifre)');
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'newworker@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'worker',
            'phone' => '+45 12 34 56 78',
            'gdpr_consent' => '1',
            'city' => 'København',
            'postcode' => '2100',
            'availability_type' => 'any',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('worker.dashboard'));
    }

    public function test_new_clients_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Client Admin',
            'email' => 'clientcorp@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'client',
            'phone' => '+45 28 26 09 26',
            'gdpr_consent' => '1',
            'company_name' => 'Nordic Hospitality ApS',
            'cvr' => '12345678',
            'address' => 'Vestergade 10',
            'city' => 'København',
            'postcode' => '1456',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('client.dashboard'));
    }
}
