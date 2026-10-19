<?php

namespace App\Http\Controllers\Worker;

use App\Enums\DocumentStatus;
use App\Enums\DocumentType;
use App\Http\Controllers\Controller;
use App\Models\WorkerDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WorkerDocumentController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user()->workerProfile;
        $documents = $worker->documents()->latest()->get();

        return view('worker.documents.index', compact('worker', 'documents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $worker = $request->user()->workerProfile;

        $validated = $request->validate([
            'type' => ['required', 'in:work_permit,certificate,id,contract'],
            'document_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'], // 10MB max
            'expiry_date' => ['nullable', 'date', 'after:today'],
        ]);

        $file = $request->file('document_file');
        $originalName = $file->getClientOriginalName();
        $mimeType = $file->getClientMimeType();

        // Store privately
        $path = $file->store('worker_documents/' . $worker->id, 'local');

        WorkerDocument::create([
            'worker_profile_id' => $worker->id,
            'type' => $validated['type'],
            'file_path' => $path,
            'original_filename' => $originalName,
            'mime_type' => $mimeType,
            'expiry_date' => $validated['expiry_date'] ?? null,
            'status' => DocumentStatus::PENDING,
        ]);

        return back()->with('success', 'Dokumentet er uploadet sikkert og afventer verifikation fra administrationen.');
    }

    public function download(WorkerDocument $document, Request $request): BinaryFileResponse
    {
        $worker = $request->user()->workerProfile;
        if ($document->worker_profile_id !== $worker->id && ! $request->user()->isAdmin()) {
            abort(403);
        }

        if (! Storage::disk('local')->exists($document->file_path)) {
            abort(404, 'Filen blev ikke fundet.');
        }

        return response()->download(Storage::disk('local')->path($document->file_path), $document->original_filename);
    }
}
