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
}
