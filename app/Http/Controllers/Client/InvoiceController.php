<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Timesheet;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $client = $request->user()->clientProfile;

        $invoices = Invoice::with('items')
            ->where('client_id', $client->id)
            ->latest('issue_date')
            ->paginate(12);

        // Staff expenditure summary
        $totalSpent = Invoice::where('client_id', $client->id)
            ->whereIn('status', ['paid', 'sent'])
            ->sum('total');

        $thisMonthSpent = Invoice::where('client_id', $client->id)
            ->whereMonth('issue_date', now()->month)
            ->whereYear('issue_date', now()->year)
            ->sum('total');

        $totalHours = Timesheet::whereHas('assignment.staffRequest', function ($q) use ($client) {
            $q->where('client_id', $client->id);
        })->where('status', 'approved')->sum('hours');

        return view('client.invoices.index', compact('invoices', 'client', 'totalSpent', 'thisMonthSpent', 'totalHours'));
    }

    public function download(Invoice $invoice, Request $request, InvoiceService $invoiceService): BinaryFileResponse
    {
        $client = $request->user()->clientProfile;
        if ($invoice->client_id !== $client->id) {
            abort(403);
        }

        // Regenerate PDF if not cached
        if (! $invoice->pdf_path || ! Storage::disk('public')->exists($invoice->pdf_path)) {
            $invoiceService->generatePdf($invoice);
        }

        $filePath = Storage::disk('public')->path($invoice->pdf_path);

        return response()->download($filePath, "Faktura-{$invoice->invoice_number}.pdf");
    }
}
