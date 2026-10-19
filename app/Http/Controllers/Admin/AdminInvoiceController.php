<?php

namespace App\Http\Controllers\Admin;

use App\Enums\InvoiceStatus;
use App\Http\Controllers\Controller;
use App\Models\ClientProfile;
use App\Models\Invoice;
use App\Models\Timesheet;
use App\Services\AuditService;
use App\Services\InvoiceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminInvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $query = Invoice::with(['client', 'items'])->latest('issue_date');

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $invoices = $query->paginate(15)->withQueryString();
        $clients = ClientProfile::orderBy('company_name')->get();

        return view('admin.invoices.index', compact('invoices', 'clients', 'status'));
    }

    public function generate(Request $request, InvoiceService $invoiceService): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:client_profiles,id'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $client = ClientProfile::findOrFail($validated['client_id']);

        // Find approved timesheets without invoice items
        $timesheets = Timesheet::whereHas('assignment.staffRequest', function ($q) use ($client) {
            $q->where('client_id', $client->id);
        })
        ->where('status', 'approved')
        ->whereDoesntHave('invoiceItem')
        ->pluck('id')
        ->toArray();

        if (empty($timesheets)) {
            return back()->with('warning', 'Ingen uafregnede, godkendte timesedler fundet for denne virksomhed.');
        }

        $invoice = $invoiceService->generateForClient($client, $timesheets, $validated['notes'] ?? null);

        AuditService::log('invoice_generated', Invoice::class, $invoice->id, null, ['amount' => $invoice->total]);

        return back()->with('success', "Faktura {$invoice->invoice_number} på {$invoice->total} DKK (inkl. moms) er oprettet og PDF genereret!");
    }

    public function updateStatus(Invoice $invoice, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,sent,paid,overdue,cancelled'],
        ]);

        $oldStatus = $invoice->status->value;
        $invoice->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'paid' ? now() : null,
        ]);

        AuditService::log(
            'invoice_status_updated',
            Invoice::class,
            $invoice->id,
            ['status' => $oldStatus],
            ['status' => $validated['status']]
        );

        return back()->with('success', 'Fakturastatus opdateret til ' . $invoice->status->label());
    }

    public function download(Invoice $invoice, InvoiceService $invoiceService): BinaryFileResponse
    {
        if (! $invoice->pdf_path || ! Storage::disk('public')->exists($invoice->pdf_path)) {
            $invoiceService->generatePdf($invoice);
        }

        $filePath = Storage::disk('public')->path($invoice->pdf_path);

        return response()->download($filePath, "Faktura-{$invoice->invoice_number}.pdf");
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'freya_invoices_' . date('Y-m-d_His') . '.csv';
        $invoices = Invoice::with('client')->latest('issue_date')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($invoices) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); // BOM

            fputcsv($handle, [
                'Fakturanummer',
                'Kunde',
                'CVR',
                'Fakturadato',
                'Forfaldsdato',
                'Subtotal (DKK)',
                'Moms 25% (DKK)',
                'Total (DKK)',
                'Status',
                'Betalt Dato',
            ], ';');

            foreach ($invoices as $inv) {
                fputcsv($handle, [
                    $inv->invoice_number,
                    $inv->client->company_name ?? 'N/A',
                    $inv->client->cvr ?? 'N/A',
                    $inv->issue_date->format('Y-m-d'),
                    $inv->due_date->format('Y-m-d'),
                    number_format((float)$inv->subtotal, 2, ',', '.'),
                    number_format((float)$inv->vat_amount, 2, ',', '.'),
                    number_format((float)$inv->total, 2, ',', '.'),
                    $inv->status->label(),
                    $inv->paid_at ? $inv->paid_at->format('Y-m-d') : '',
                ], ';');
            }

            fclose($handle);
        }, 200, $headers);
    }
}
