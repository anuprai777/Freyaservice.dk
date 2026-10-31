<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Fakturaer & Forbrug') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oversigt over fakturerede vikartimer, 25% dansk moms og betalingsstatus.') }}</p>
            </div>
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til dashboard') }}</span>
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
                    <x-heroicon-o-banknotes class="w-5 h-5 text-[#7B1E3A]" />
                </x-slot:icon>
            </x-stat-card>

            <x-stat-card
                :label="__('Samlet faktureret')"
                :value="number_format($totalSpent, 2, ',', '.') . ' kr.'"
                :sublabel="__('Historisk total ekskl./inkl. moms')"
                accent="primary"
            >
                <x-slot:icon>
                    <x-heroicon-o-document-text class="w-5 h-5 text-[#7B1E3A]" />
                </x-slot:icon>
            </x-stat-card>

            <x-stat-card
                :label="__('Godkendte vikartimer')"
                :value="number_format($totalHours, 1, ',', '.') . ' ' . __('timer')"
                :sublabel="__('Udført af FreyaService vikarer')"
                accent="teal"
            >
                <x-slot:icon>
                    <x-heroicon-o-clock class="w-5 h-5 text-emerald-600" />
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
                                <span class="text-base font-black text-[#7B1E3A]">{{ number_format($inv->total, 2, ',', '.') }} kr.</span>
                            </div>
                            <a href="{{ route('client.invoices.download', $inv) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 font-bold text-xs transition shadow-xs">
                                <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                <span>{{ __('Download PDF') }}</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">
                        {{ __('Der er ingen udstedte fakturaer for din virksomhed endnu.') }}
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View (hidden md:block) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Fakturanr.') }}</th>
                            <th class="p-4">{{ __('Udstedt') }}</th>
                            <th class="p-4">{{ __('Forfaldsdato') }}</th>
                            <th class="p-4">{{ __('Ekskl. moms') }}</th>
                            <th class="p-4">{{ __('Moms (25%)') }}</th>
                            <th class="p-4">{{ __('Total inkl. moms') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Faktura PDF') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($invoices as $inv)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-mono font-bold text-slate-900">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-document-text class="w-3.5 h-3.5 text-slate-400" />
                                        <span>{{ $inv->invoice_number }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">{{ $inv->issue_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->due_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700 font-medium">{{ number_format($inv->subtotal, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->vat_amount, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-bold text-[#7B1E3A] text-sm">{{ number_format($inv->total, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                        @if($inv->status->value === 'paid') bg-emerald-100 text-emerald-800
                                        @elseif($inv->status->value === 'overdue') bg-rose-100 text-rose-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ $inv->status->label() }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('client.invoices.download', $inv) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 font-semibold text-xs transition shadow-xs">
                                        <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                        <span>{{ __('Download PDF') }}</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-400">
                                    {{ __('Der er ingen udstedte fakturaer for din virksomhed endnu.') }}
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