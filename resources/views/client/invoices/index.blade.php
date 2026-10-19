<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Fakturaer & Forbrug</h1>
                <p class="text-xs text-slate-500 mt-0.5">Oversigt over fakturerede vikartimer, 25% dansk moms og betalingsstatus.</p>
            </div>
            <a href="{{ route('client.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage til dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Expenditure Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Forbrug i denne måned</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ number_format($thisMonthSpent, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Inkl. 25% moms</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Samlet faktureret</span>
                <span class="text-2xl font-black text-indigo-600 mt-1 block">{{ number_format($totalSpent, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Historisk total ekskl./inkl. moms</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Godkendte vikartimer</span>
                <span class="text-2xl font-black text-emerald-600 mt-1 block">{{ number_format($totalHours, 1, ',', '.') }} timer</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Udført af FreyaService vikarer</span>
            </div>
        </div>

        <!-- Invoices List -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-base font-bold text-slate-900">Fakturaoversigt</h2>
                <span class="text-xs text-slate-500">Valuta: DKK • Betalingsbetingelse: Netto 14 dage</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Fakturanummer</th>
                            <th class="p-4">Dato</th>
                            <th class="p-4">Forfald</th>
                            <th class="p-4">Beløb ekskl. moms</th>
                            <th class="p-4">Moms (25%)</th>
                            <th class="p-4">Total inkl. moms</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">PDF</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($invoices as $inv)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-bold text-slate-900">{{ $inv->invoice_number }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->issue_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->due_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->subtotal, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->vat_amount, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($inv->total, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                        @if($inv->status->value === 'paid') bg-emerald-100 text-emerald-800
                                        @elseif($inv->status->value === 'overdue') bg-rose-100 text-rose-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $inv->status->label() }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('client.invoices.download', $inv) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>Download PDF</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-400">
                                    Ingen fakturaer udstedt endnu. Fakturaer genereres automatisk, når timesedler godkendes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $invoices->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
