<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_admin_authenticates_and_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_client_authenticates_and_redirects_to_client_dashboard(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        $response = $this->post('/login', [
            'email' => $client->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($client);
        $response->assertRedirect(route('client.dashboard'));
    }

    public function test_worker_authenticates_and_redirects_to_worker_dashboard(): void
    {
        $worker = User::factory()->create(['role' => 'worker']);

        $response = $this->post('/login', [
            'email' => $worker->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($worker);
        $response->assertRedirect(route('worker.dashboard'));
    }

    public function test_multiple_accounts_with_same_email_authenticate_by_password(): void
    {
        $sharedEmail = 'freyaservicevikar@gmail.com';
        $admin = User::factory()->create(['email' => $sharedEmail, 'role' => 'admin', 'password' => 'admin123']);
        $client = User::factory()->create(['email' => $sharedEmail, 'role' => 'client', 'password' => 'client123']);
        $worker = User::factory()->create(['email' => $sharedEmail, 'role' => 'worker', 'password' => 'worker123']);

        // Admin login
        $resAdmin = $this->post('/login', ['email' => $sharedEmail, 'password' => 'admin123']);
        $this->assertAuthenticatedAs($admin);
        $resAdmin->assertRedirect(route('admin.dashboard'));
        $this->post('/logout');

        // Client login
        $resClient = $this->post('/login', ['email' => $sharedEmail, 'password' => 'client123']);
        $this->assertAuthenticatedAs($client);
        $resClient->assertRedirect(route('client.dashboard'));
        $this->post('/logout');

        // Worker login
        $resWorker = $this->post('/login', ['email' => $sharedEmail, 'password' => 'worker123']);
        $this->assertAuthenticatedAs($worker);
        $resWorker->assertRedirect(route('worker.dashboard'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function test_user_can_switch_roles_without_logging_out_first(): void
    {
        $admin = User::factory()->create(['email' => 'freyaservicevikar@gmail.com', 'role' => 'admin', 'password' => 'admin123']);
        $client = User::factory()->create(['email' => 'freyaservicevikar@gmail.com', 'role' => 'client', 'password' => 'client123']);

        // Log in as admin
        $this->actingAs($admin);
        $this->assertAuthenticatedAs($admin);

        // While still logged in as admin (not logged out), log in as client
        $response = $this->post('/login', [
            'email' => 'freyaservicevikar@gmail.com',
            'password' => 'client123',
        ]);

        $this->assertAuthenticatedAs($client);
        $response->assertRedirect(route('client.dashboard'));
    }

    public function test_worker_with_custom_email_can_authenticate_via_shared_email_and_worker_password(): void
    {
        // Custom worker email like anuplimbu70@gmail.com
        $worker = User::factory()->create([
            'email' => 'anuplimbu70@gmail.com',
            'role' => 'worker',
            'password' => 'worker123',
        ]);

        $response = $this->post('/login', [
            'email' => 'freyaservicevikar@gmail.com',
            'password' => 'worker123',
        ]);

        $this->assertAuthenticatedAs($worker);
        $response->assertRedirect(route('worker.dashboard'));
    }
}
