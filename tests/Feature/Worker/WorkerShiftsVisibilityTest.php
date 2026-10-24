<?php

namespace Tests\Feature\Worker;

use App\Enums\AssignmentStatus;
use App\Enums\ShiftStatus;
use App\Enums\StaffRequestReason;
use App\Enums\StaffRequestStatus;
use App\Enums\StaffRequestType;
use App\Models\Assignment;
use App\Models\ClientProfile;
use App\Models\Shift;
use App\Models\StaffRequest;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkerShiftsVisibilityTest extends TestCase
{
    use RefreshDatabase;

    private User $workerUser;
    private WorkerProfile $workerProfile;
    private User $clientUser;
    private ClientProfile $clientProfile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->workerUser = User::factory()->create([
            'role' => 'worker',
            'is_active' => true,
        ]);

        $this->workerProfile = WorkerProfile::create([
            'user_id' => $this->workerUser->id,
            'skills' => ['Tjener', 'Opvasker'],
            'city' => 'København',
            'postcode' => '2100',
            'hourly_rate' => 195.00,
            'rating_avg' => 5.0,
            'ratings_count' => 5,
            'availability_type' => 'any',
            'status' => 'approved',
        ]);

        $this->clientUser = User::factory()->create([
            'role' => 'client',
            'is_active' => true,
        ]);

        $this->clientProfile = ClientProfile::create([
            'user_id' => $this->clientUser->id,
            'company_name' => 'Grand Hotel A/S',
            'cvr' => '12345678',
            'address' => 'Vesterbrogade 10',
            'city' => 'København V',
            'postcode' => '1620',
            'contact_person' => 'Hotel Manager',
            'phone' => '+45 28 26 09 26',
            'status' => 'active',
        ]);
    }

    public function test_client_creating_staff_request_auto_generates_shift_and_preferred_worker_offer(): void
    {
        $response = $this->actingAs($this->clientUser)->post(route('client.requests.store'), [
            'request_type' => 'part_time',
            'role' => 'Tjener',
            'workers_needed' => 3,
            'reason' => 'peak',
            'location' => 'Grand Hotel Restaurant, Vesterbrogade 10',
            'city' => 'København V',
            'postcode' => '1620',
            'start_date' => now()->addDay()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'start_time' => '16:00',
            'end_time' => '23:00',
            'hours_per_week' => 25,
            'dress_code' => 'Sort tøj',
            'preferred_worker_id' => $this->workerProfile->id,
        ]);

        $response->assertRedirect(route('client.dashboard'));

        $this->assertDatabaseHas('staff_requests', [
            'client_id' => $this->clientProfile->id,
            'role' => 'Tjener',
            'workers_needed' => 3,
        ]);

        $staffRequest = StaffRequest::where('client_id', $this->clientProfile->id)->first();
        $this->assertNotNull($staffRequest);

        // Assert Shift was automatically generated
        $this->assertDatabaseHas('shifts', [
            'staff_request_id' => $staffRequest->id,
            'status' => 'open',
            'workers_needed' => 3,
        ]);

        // Assert direct assignment was created for preferred worker
        $this->assertDatabaseHas('assignments', [
            'staff_request_id' => $staffRequest->id,
            'worker_id' => $this->workerProfile->id,
            'status' => 'offered',
        ]);
    }

    public function test_available_worker_sees_client_uploaded_staff_requests_on_dashboard(): void
    {
        $staffRequest = StaffRequest::create([
            'client_id' => $this->clientProfile->id,
            'request_type' => StaffRequestType::TEMPORARY_COVER,
            'role' => 'Opvasker',
            'workers_needed' => 2,
            'reason' => StaffRequestReason::ABSENCE,
            'location' => 'Vesterbrogade 10',
            'city' => 'København V',
            'postcode' => '1620',
            'start_date' => now()->addDay()->toDateString(),
            'end_date' => now()->addDay()->toDateString(),
            'start_time' => '08:00',
            'end_time' => '16:00',
            'status' => StaffRequestStatus::NEW,
            'hourly_rate_offered' => 245.00,
        ]);

        Shift::create([
            'staff_request_id' => $staffRequest->id,
            'title' => 'Opvasker dækning',
            'start_at' => now()->addDay()->setTime(8, 0),
            'end_at' => now()->addDay()->setTime(16, 0),
            'workers_needed' => 2,
            'status' => ShiftStatus::OPEN,
        ]);

        $response = $this->actingAs($this->workerUser)->get(route('worker.dashboard'));

        $response->assertOk();
        $response->assertSee('Åbne vagter oprettet af kunder');
        $response->assertSee('Opvasker');
        $response->assertSee('Grand Hotel A/S');
        $response->assertSee('København V');
        $response->assertSee('245,00');
    }

    public function test_worker_can_see_open_requests_on_offers_page_even_with_different_city(): void
    {
        // Worker city is København, but client request is in Aarhus
        $staffRequest = StaffRequest::create([
            'client_id' => $this->clientProfile->id,
            'request_type' => StaffRequestType::TEMPORARY_COVER,
            'role' => 'Lagerarbejder',
            'workers_needed' => 5,
            'reason' => StaffRequestReason::PEAK,
            'location' => 'Havnevej 1',
            'city' => 'Aarhus C',
            'postcode' => '8000',
            'start_date' => now()->addDays(2)->toDateString(),
            'status' => StaffRequestStatus::NEW,
            'hourly_rate_offered' => 250.00,
        ]);

        $response = $this->actingAs($this->workerUser)->get(route('worker.offers.index'));

        $response->assertOk();
        $response->assertSee('Lagerarbejder');
        $response->assertSee('Aarhus C');
        $response->assertSee('Accepter Vagt');
    }

    public function test_worker_can_claim_and_accept_open_client_staff_request(): void
    {
        $staffRequest = StaffRequest::create([
            'client_id' => $this->clientProfile->id,
            'request_type' => StaffRequestType::TEMPORARY_COVER,
            'role' => 'Tjener',
            'workers_needed' => 1,
            'reason' => StaffRequestReason::ABSENCE,
            'location' => 'Vesterbrogade 10',
            'city' => 'København V',
            'postcode' => '1620',
            'start_date' => now()->addDay()->toDateString(),
            'status' => StaffRequestStatus::NEW,
            'hourly_rate_offered' => 260.00,
        ]);

        $shift = Shift::create([
            'staff_request_id' => $staffRequest->id,
            'title' => 'Tjener dækning',
            'start_at' => now()->addDay()->setTime(12, 0),
            'end_at' => now()->addDay()->setTime(20, 0),
            'workers_needed' => 1,
            'status' => ShiftStatus::OPEN,
        ]);

        $response = $this->actingAs($this->workerUser)
            ->post(route('worker.offers.claim', $staffRequest));

        $response->assertRedirect(route('worker.dashboard'));
        $response->assertSessionHas('success');

        // Check Assignment created in accepted status
        $this->assertDatabaseHas('assignments', [
            'staff_request_id' => $staffRequest->id,
            'worker_id' => $this->workerProfile->id,
            'status' => AssignmentStatus::ACCEPTED,
        ]);

        // Shift should now be filled
        $shift->refresh();
        $this->assertEquals(ShiftStatus::FILLED, $shift->status);

        // StaffRequest should be matched
        $staffRequest->refresh();
        $this->assertEquals(StaffRequestStatus::MATCHED, $staffRequest->status);

        // Worker dashboard should now show it under accepted assignments
        $dashboardResponse = $this->actingAs($this->workerUser)->get(route('worker.dashboard'));
        $dashboardResponse->assertSee('Dine accepterede opgaver og vagter');
        $dashboardResponse->assertSee('Tjener');
    }
}
