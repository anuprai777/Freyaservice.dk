<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientProfile;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminClientController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $query = ClientProfile::with(['user', 'staffRequests'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('cvr', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('contact_person', 'like', "%{$search}%");
            });
        }

        $clients = $query->paginate(15)->withQueryString();

        return view('admin.clients.index', compact('clients', 'search'));
    }

    public function show(ClientProfile $client): View
    {
        $client->load(['user', 'staffRequests.shifts.assignments.worker.user', 'invoices']);

        return view('admin.clients.show', compact('client'));
    }

    public function updateStatus(ClientProfile $client, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:active,pending,suspended'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $client->update([
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? $client->notes,
        ]);

        AuditService::log('client_status_updated', ClientProfile::class, $client->id);

        return back()->with('success', 'Virksomhedens status er opdateret.');
    }
}
