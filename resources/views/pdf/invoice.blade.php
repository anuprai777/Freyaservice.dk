<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <title>Faktura {{ $invoice->invoice_number }} - FreyaService</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #1F1519;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
            padding: 30px;
            background-color: #FFFFFF;
        }
        .header {
            width: 100%;
            margin-bottom: 35px;
            border-bottom: 2px solid #E4D6D9;
            padding-bottom: 20px;
        }
        .header table {
            width: 100%;
        }
        .brand-title {
            font-size: 26px;
            font-weight: 800;
            color: #1F1519;
            letter-spacing: -0.5px;
        }
        .brand-title span {
            color: #C9A24B;
        }
        .brand-sub {
            font-size: 11px;
            color: #6B5E62;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .invoice-title {
            text-align: right;
            font-size: 28px;
            font-weight: 900;
            color: #1F1519;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .invoice-number {
            text-align: right;
            font-size: 14px;
            color: #7B1E3A;
            font-weight: 700;
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
            font-weight: 700;
            color: #6B5E62;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .company-name {
            font-size: 15px;
            font-weight: 700;
            color: #1F1519;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #F3E3E6;
            color: #1F1519;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 10px 12px;
            border-bottom: 2px solid #E4D6D9;
            text-align: left;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #E4D6D9;
            color: #1F1519;
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
            color: #1F1519;
        }
        .totals-table tr.total-row td {
            border-top: 2px solid #7B1E3A;
            font-size: 15px;
            font-weight: 800;
            color: #7B1E3A;
            padding-top: 10px;
        }
        .payment-box {
            margin-top: 40px;
            padding: 16px;
            background-color: #FAF5F2;
            border: 1px solid #E4D6D9;
            border-left: 4px solid #C9A24B;
            border-radius: 6px;
        }
        .payment-box h4 {
            margin: 0 0 8px 0;
            color: #1F1519;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #6B5E62;
            border-top: 1px solid #E4D6D9;
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
