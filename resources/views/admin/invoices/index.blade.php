<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Fakturering & Moms</h1>
                <p class="text-xs text-slate-500 mt-0.5">Generer kundefakturaer for godkendte vikartimer med 25% moms jf. dansk momslovgivning.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.invoices.export') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                    <span>Eksportér CSV</span>
                </a>

                <!-- Generate Invoice Modal Trigger -->
                <div x-data="{ openGen: false }">
                    <button type="button" @click="openGen = true" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                        <span>+ Opret Faktura</span>
                    </button>

                    <div x-show="openGen" x-cloak class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
                        <div @click.away="openGen = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl space-y-4">
                            <h3 class="text-base font-bold text-slate-900">Opret ny kundefaktura</h3>
                            <p class="text-xs text-slate-500">Systemet samler alle godkendte, uafregnede timesedler for den valgte virksomhed og beregner 25% moms.</p>

                            <form method="POST" action="{{ route('admin.invoices.generate') }}" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Vælg Virksomhed (Kunde)</label>
                                    <select name="client_id" required class="w-full text-xs rounded-xl border-slate-300">
                                        @foreach($clients as $c)
                                            <option value="{{ $c->id }}">{{ $c->company_name }} (CVR: {{ $c->cvr }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Evt. bemærkning på fakturaen</label>
                                    <textarea name="notes" rows="2" class="w-full text-xs rounded-xl border-slate-300" placeholder="F.eks. Vikardækning i uge 42"></textarea>
                                </div>

                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" @click="openGen = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">Annuller</button>
                                    <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-indigo-600 text-white hover:bg-indigo-700">Generer & Opret PDF</button>
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
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-semibold">
                {{ session('warning') }}
            </div>
        @endif

        <!-- Filter bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-wrap gap-2 items-center">
            <a href="{{ route('admin.invoices.index', ['status' => 'all']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !$status || $status === 'all' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Alle fakturaer
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'sent']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'sent' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Afsendte
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'paid']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'paid' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Betalte
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'overdue']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'overdue' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Forfaldne
            </a>
        </div>

        <!-- Invoices Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Fakturanr.</th>
                            <th class="p-4">Kunde</th>
                            <th class="p-4">Dato</th>
                            <th class="p-4">Forfald</th>
                            <th class="p-4">Ekskl. moms</th>
                            <th class="p-4">Moms (25%)</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Handlinger</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($invoices as $inv)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-mono font-bold text-slate-900">{{ $inv->invoice_number }}</td>
                                <td class="p-4 font-semibold text-slate-900">{{ $inv->client->company_name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->issue_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $inv->due_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->subtotal, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-slate-700">{{ number_format($inv->vat_amount, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($inv->total, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <form method="POST" action="{{ route('admin.invoices.update-status', $inv) }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="text-[10px] py-1 px-2 rounded-lg font-bold uppercase border-slate-200">
                                            <option value="sent" {{ $inv->status->value === 'sent' ? 'selected' : '' }}>Afsendt</option>
                                            <option value="paid" {{ $inv->status->value === 'paid' ? 'selected' : '' }}>Betalt</option>
                                            <option value="overdue" {{ $inv->status->value === 'overdue' ? 'selected' : '' }}>Forfalden</option>
                                            <option value="cancelled" {{ $inv->status->value === 'cancelled' ? 'selected' : '' }}>Annulleret</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.invoices.download', $inv) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-semibold text-xs transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        <span>PDF</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-8 text-center text-slate-400">
                                    Ingen fakturaer fundet. Klik på "+ Opret Faktura" for at afregne godkendte vikarer.
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
