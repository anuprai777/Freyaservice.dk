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

        $responseDa = $this->actingAs($admin)
            ->withSession(['locale' => 'da'])
            ->get('/admin/dashboard');

        $responseDa->assertStatus(200);
        $responseDa->assertSee('Vikarer (CRM)');
        $responseDa->assertSee('Fakturaer');
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
}
