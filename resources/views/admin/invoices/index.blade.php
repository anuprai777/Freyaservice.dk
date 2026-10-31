<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Fakturering & Moms') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Generer kundefakturaer for godkendte vikartimer med 25% moms jf. dansk momslovgivning.') }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.invoices.export') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                    <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                    <span>{{ __('Eksportér CSV') }}</span>
                </a>

                <!-- Generate Invoice Modal Trigger -->
                <div x-data="{ openGen: false }">
                    <button type="button" @click="openGen = true" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                        <x-heroicon-s-plus class="w-3.5 h-3.5 text-[#C9A24B]" />
                        <span>{{ __('Opret Faktura') }}</span>
                    </button>

                    <div x-show="openGen" x-cloak class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
                        <div @click.away="openGen = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl space-y-4">
                            <h3 class="text-base font-bold text-slate-900">{{ __('Opret ny kundefaktura') }}</h3>
                            <p class="text-xs text-slate-500">{{ __('Systemet samler alle godkendte, uafregnede timesedler for den valgte virksomhed og beregner 25% moms.') }}</p>

                            <form method="POST" action="{{ route('admin.invoices.generate') }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Vælg Virksomhed (Kunde)') }}</label>
                                    <select name="client_id" required class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                        @foreach($clients as $c)
                                            <option value="{{ $c->id }}">{{ $c->company_name }} (CVR: {{ $c->cvr }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Evt. bemærkning på fakturaen') }}</label>
                                    <textarea name="notes" rows="2" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('F.eks. Vikardækning i uge 42') }}"></textarea>
                                </div>

                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" @click="openGen = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                    <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#7B1E3A] text-white hover:bg-[#5A1429] shadow-xs">{{ __('Generer & Opret PDF') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-amber-600 shrink-0" />
                <span>{{ session('warning') }}</span>
            </div>
        @endif

        <!-- Filter bar -->
        <x-card padding="sm" class="flex flex-wrap gap-2 items-center">
            <a href="{{ route('admin.invoices.index', ['status' => 'all']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ !$status || $status === 'all' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                {{ __('Alle fakturaer') }}
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'sent']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'sent' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                {{ __('Afsendte') }}
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'paid']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'paid' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                {{ __('Betalte') }}
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'overdue']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'overdue' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                {{ __('Forfaldne') }}
            </a>
        </x-card>

        <!-- Invoices Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Fakturanr.') }}</th>
                            <th class="p-4">{{ __('Kunde') }}</th>
                            <th class="p-4">{{ __('Dato') }}</th>
                            <th class="p-4">{{ __('Forfald') }}</th>
                            <th class="p-4">{{ __('Ekskl. moms') }}</th>
                            <th class="p-4">{{ __('Moms (25%)') }}</th>
                            <th class="p-4">{{ __('Total') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Handlinger') }}</th>
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
                                <td class="p-4 font-semibold text-slate-900">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-slate-400" />
                                        <span>{{ $inv->client->company_name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">{{ $inv->issue_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->due_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->subtotal, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->vat_amount, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-bold text-[#7B1E3A]">{{ number_format($inv->total, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <form method="POST" action="{{ route('admin.invoices.update-status', $inv) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="text-[10px] py-1 px-2 rounded-lg font-bold uppercase border-slate-200 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                            <option value="sent" {{ $inv->status->value === 'sent' ? 'selected' : '' }}>{{ __('Afsendt') }}</option>
                                            <option value="paid" {{ $inv->status->value === 'paid' ? 'selected' : '' }}>{{ __('Betalt') }}</option>
                                            <option value="overdue" {{ $inv->status->value === 'overdue' ? 'selected' : '' }}>{{ __('Forfalden') }}</option>
                                            <option value="cancelled" {{ $inv->status->value === 'cancelled' ? 'selected' : '' }}>{{ __('Annulleret') }}</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.invoices.download', $inv) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 font-semibold text-xs transition">
                                        <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                        <span>PDF</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen fakturaer fundet. Klik på "+ Opret Faktura" for at afregne godkendte vikarer.') }}
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
