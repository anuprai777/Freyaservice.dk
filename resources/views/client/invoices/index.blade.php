<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Fakturaer & Forbrug') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oversigt over fakturerede vikartimer, 25% dansk moms og betalingsstatus.') }}</p>
            </div>
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; {{ __('Tilbage til dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        <!-- Expenditure Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-6">
            <x-stat-card
                :label="__('Forbrug i denne måned')"
                :value="number_format($thisMonthSpent, 2, ',', '.') . ' kr.'"
                :sublabel="__('Inkl. 25% moms')"
            >
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </x-slot:icon>
            </x-stat-card>

            <x-stat-card
                :label="__('Samlet faktureret')"
                :value="number_format($totalSpent, 2, ',', '.') . ' kr.'"
                :sublabel="__('Historisk total ekskl./inkl. moms')"
                accent="primary"
            >
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </x-slot:icon>
            </x-stat-card>

            <x-stat-card
                :label="__('Godkendte vikartimer')"
                :value="number_format($totalHours, 1, ',', '.') . ' ' . __('timer')"
                :sublabel="__('Udført af FreyaService vikarer')"
                accent="teal"
            >
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </x-slot:icon>
            </x-stat-card>
        </div>

        <!-- Invoices List -->
        <x-card padding="none">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 w-full">
                    <h2 class="text-base font-bold text-slate-900">{{ __('Fakturaoversigt') }}</h2>
                    <span class="text-xs text-slate-500">{{ __('Valuta: DKK • Betalingsbetingelse: Netto 14 dage') }}</span>
                </div>
            </x-slot:header>

            <!-- Mobile Card View (md:hidden) -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse($invoices as $inv)
                    <div class="p-4 space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <div>
                                <span class="text-xs text-slate-400 block">{{ __('Faktura') }}</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $inv->invoice_number }}</span>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                @if($inv->status->value === 'paid') bg-emerald-100 text-emerald-800
                                @elseif($inv->status->value === 'overdue') bg-rose-100 text-rose-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ $inv->status->label() }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs py-2 border-y border-slate-100 bg-slate-50/50 -mx-4 px-4">
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Dato:') }}</span>
                                <span class="font-medium text-slate-700">{{ $inv->issue_date->format('d.m.Y') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Forfald:') }}</span>
                                <span class="font-medium text-slate-700">{{ $inv->due_date->format('d.m.Y') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Ekskl. moms:') }}</span>
                                <span class="font-medium text-slate-700">{{ number_format($inv->subtotal, 2, ',', '.') }} kr.</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Moms (25%):') }}</span>
                                <span class="font-medium text-slate-700">{{ number_format($inv->vat_amount, 2, ',', '.') }} kr.</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div>
                                <span class="text-[11px] text-slate-400 block uppercase font-semibold">{{ __('Total inkl. moms') }}</span>
                                <span class="text-base font-black text-slate-900">{{ number_format($inv->total, 2, ',', '.') }} kr.</span>
                            </div>
                            <a href="{{ route('client.invoices.download', $inv) }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition min-h-[40px]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>PDF</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-xs text-slate-400">
                        {{ __('Ingen fakturaer udstedt endnu. Fakturaer genereres automatisk, når timesedler godkendes.') }}
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View (hidden md:block) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">{{ __('Fakturanummer') }}</th>
                            <th class="p-4">{{ __('Dato') }}</th>
                            <th class="p-4">{{ __('Forfald') }}</th>
                            <th class="p-4">{{ __('Beløb ekskl. moms') }}</th>
                            <th class="p-4">{{ __('Moms (25%)') }}</th>
                            <th class="p-4">{{ __('Total inkl. moms') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
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
                                        <span>{{ __('Download PDF') }}</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen fakturaer udstedt endnu. Fakturaer genereres automatisk, når timesedler godkendes.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $invoices->links() }}
            </div>
        </x-card>

    </div>
</x-app-layout>
