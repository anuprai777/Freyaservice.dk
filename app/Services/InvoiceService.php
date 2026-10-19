<?php

namespace App\Services;

use App\Enums\InvoiceStatus;
use App\Models\ClientProfile;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Timesheet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceService
{
    /**
     * Generate an invoice for approved timesheets of a client.
     */
    public function generateForClient(ClientProfile $client, array $timesheetIds, ?string $notes = null): Invoice
    {
        $timesheets = Timesheet::whereIn('id', $timesheetIds)
            ->where('status', 'approved')
            ->get();

        $invoiceNumber = 'FS-' . date('Y') . '-' . strtoupper(Str::random(6));

        $invoice = Invoice::create([
            'client_id' => $client->id,
            'invoice_number' => $invoiceNumber,
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(14)->toDateString(),
            'subtotal' => 0,
            'vat_rate' => 25.00,
            'vat_amount' => 0,
            'total' => 0,
            'currency' => 'DKK',
            'status' => InvoiceStatus::SENT,
            'notes' => $notes,
        ]);

        $subtotal = 0;

        foreach ($timesheets as $ts) {
            $hours = (float) $ts->hours;
            $rate = (float) $ts->client_hourly_rate;
            $lineTotal = round($hours * $rate, 2);

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'timesheet_id' => $ts->id,
                'description' => sprintf(
                    'Vikararbejde: %s (%s) - %s timer @ %s DKK/time',
                    $ts->worker->user->name ?? 'Vikar',
                    $ts->clock_in->format('d/m/Y'),
                    number_format($hours, 2, ',', '.'),
                    number_format($rate, 2, ',', '.')
                ),
                'quantity' => $hours,
                'unit_price' => $rate,
                'total' => $lineTotal,
            ]);

            $subtotal += $lineTotal;
        }

        $vatAmount = round($subtotal * 0.25, 2);
        $total = $subtotal + $vatAmount;

        $invoice->update([
            'subtotal' => $subtotal,
            'vat_amount' => $vatAmount,
            'total' => $total,
        ]);

        $this->generatePdf($invoice);

        return $invoice;
    }

    /**
     * Render and store the PDF invoice using DomPDF.
     */
    public function generatePdf(Invoice $invoice): string
    {
        $invoice->load(['client.user', 'items']);

        $pdf = Pdf::loadView('pdf.invoice', ['invoice' => $invoice]);
        $pdf->setPaper('a4', 'portrait');

        $fileName = 'invoices/' . $invoice->invoice_number . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        $invoice->update(['pdf_path' => $fileName]);

        return $fileName;
    }
}
