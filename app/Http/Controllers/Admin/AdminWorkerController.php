<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DocumentStatus;
use App\Enums\WorkerStatus;
use App\Http\Controllers\Controller;
use App\Models\WorkerDocument;
use App\Models\WorkerProfile;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminWorkerController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = WorkerProfile::with(['user', 'documents'])->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('city', 'like', "%{$search}%")
                  ->orWhere('postcode', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $workers = $query->paginate(15)->withQueryString();

        return view('admin.workers.index', compact('workers', 'status', 'search'));
    }

    public function show(WorkerProfile $worker): View
    {
        $worker->load(['user', 'documents.verifiedByUser', 'availabilities', 'ratings.client', 'assignments.staffRequest.client']);

        return view('admin.workers.show', compact('worker'));
    }

    public function updateStatus(WorkerProfile $worker, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,suspended,blocked'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $oldStatus = $worker->status;
        $worker->update([
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? $worker->notes,
        ]);

        AuditService::log(
            'worker_status_updated',
            WorkerProfile::class,
            $worker->id,
            ['status' => $oldStatus],
            ['status' => $validated['status']]
        );

        return back()->with('success', 'Vikarstatus opdateret til ' . $worker->status);
    }

    public function verifyDocument(WorkerDocument $document, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $document->update([
            'status' => $validated['status'],
            'rejection_reason' => $validated['status'] === 'rejected' ? $validated['rejection_reason'] : null,
            'verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        AuditService::log(
            'worker_document_verified',
            WorkerDocument::class,
            $document->id,
            null,
            ['status' => $validated['status'], 'type' => $document->type->value]
        );

        return back()->with('success', 'Dokumentstatus er opdateret.');
    }
}
