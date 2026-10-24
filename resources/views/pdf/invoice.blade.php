<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Faktura {{ $invoice->invoice_number }} - FreyaService</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
            padding: 30px;
        }
        .header {
            width: 100%;
            margin-bottom: 40px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
        }
        .header table {
            width: 100%;
        }
        .brand-title {
            font-size: 26px;
            font-weight: bold;
            color: #0f172a;
        }
        .brand-title span {
            color: #4f46e5;
        }
        .brand-sub {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .invoice-title {
            text-align: right;
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }
        .invoice-number {
            text-align: right;
            font-size: 13px;
            color: #4f46e5;
            font-weight: 600;
        }
        .info-section {
            width: 100%;
            margin-bottom: 35px;
        }
        .info-section table {
            width: 100%;
        }
        .info-box {
            vertical-align: top;
            width: 50%;
        }
        .info-heading {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .company-name {
            font-size: 15px;
            font-weight: bold;
            color: #0f172a;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 12px;
            border-bottom: 1px solid #cbd5e1;
            text-align: left;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
        }
        .items-table td.text-right, .items-table th.text-right {
            text-align: right;
        }
        .totals-table {
            width: 45%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 7px 12px;
        }
        .totals-table tr.total-row td {
            border-top: 2px solid #0f172a;
            font-size: 15px;
            font-weight: bold;
            color: #0f172a;
            padding-top: 10px;
        }
        .payment-box {
            margin-top: 40px;
            padding: 16px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }
        .payment-box h4 {
            margin: 0 0 8px 0;
            color: #0f172a;
            font-size: 12px;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                <td>
                    <div class="brand-title">Freya<span>Service</span></div>
                    <div class="brand-sub">Vikarbureau Danmark</div>
                </td>
                <td>
                    <div class="invoice-title">FAKTURA</div>
                    <div class="invoice-number">Nr. {{ $invoice->invoice_number }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td class="info-box">
                    <div class="info-heading">Faktureres til</div>
                    <div class="company-name">{{ $invoice->client->company_name ?? 'Kunde' }}</div>
                    <div>Att: {{ $invoice->client->contact_person ?? '' }}</div>
                    <div>{{ $invoice->client->address ?? '' }}</div>
                    <div>{{ $invoice->client->postcode ?? '' }} {{ $invoice->client->city ?? '' }}</div>
                    <div>CVR-nr.: {{ $invoice->client->cvr ?? '-' }}</div>
                </td>
                <td class="info-box" style="text-align: right;">
                    <div class="info-heading">Fakturadetaljer</div>
                    <div><strong>Fakturadato:</strong> {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d.m.Y') }}</div>
                    <div><strong>Forfaldsdato:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('d.m.Y') }}</div>
                    <div><strong>Betalingsbetingelse:</strong> Netto 14 dage</div>
                    <div><strong>Valuta:</strong> {{ $invoice->currency }}</div>
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 55%;">Beskrivelse</th>
                <th class="text-right" style="width: 15%;">Timer/Antal</th>
                <th class="text-right" style="width: 15%;">Enhedspris</th>
                <th class="text-right" style="width: 15%;">Beløb DKK</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice->items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td class="text-right">{{ number_format($item->quantity, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }} kr.</td>
                    <td class="text-right">{{ number_format($item->total, 2, ',', '.') }} kr.</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #94a3b8; padding: 20px;">Ingen fakturalinjer</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td>Subtotal ekskl. moms:</td>
            <td class="text-right">{{ number_format($invoice->subtotal, 2, ',', '.') }} kr.</td>
        </tr>
        <tr>
            <td>Moms ({{ number_format($invoice->vat_rate, 0) }}%):</td>
            <td class="text-right">{{ number_format($invoice->vat_amount, 2, ',', '.') }} kr.</td>
        </tr>
        <tr class="total-row">
            <td>Total inkl. moms:</td>
            <td class="text-right">{{ number_format($invoice->total, 2, ',', '.') }} kr.</td>
        </tr>
    </table>

    <div class="payment-box">
        <h4>Betalingsoplysninger</h4>
        <div>Overfør venligst beløbet til vores bankkonto senest på forfaldsdatoen:</div>
        <div style="margin-top: 6px;">
            <strong>Bank:</strong> Danske Bank &bull;
            <strong>Reg.nr.:</strong> 3001 &bull;
            <strong>Kontonr.:</strong> 0012345678
        </div>
        <div style="margin-top: 4px; font-size: 11px; color: #64748b;">
            Angiv venligst fakturanummer <strong>{{ $invoice->invoice_number }}</strong> som betalingsreference.
        </div>
    </div>

    @if($invoice->notes)
        <div style="margin-top: 20px; font-size: 12px; color: #475569;">
            <strong>Note:</strong> {{ $invoice->notes }}
        </div>
    @endif

    <div class="footer">
        FreyaService ApS &bull; Vesterbrogade 100, 1620 København V &bull; Tlf: +45 28 26 09 26 &bull; E-mail: faktura@freyaservice.dk &bull; CVR: 44556677
    </div>

</body>
</html>
