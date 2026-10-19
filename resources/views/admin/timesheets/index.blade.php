<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Timesedler & Løngrundlag</h1>
                <p class="text-xs text-slate-500 mt-0.5">Overvåg vikarernes registrerede arbejdstimer og eksportér data til løn og bogholderi.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.timesheets.export') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Eksportér CSV (Excel)</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-wrap gap-2 items-center">
            <a href="{{ route('admin.timesheets.index', ['status' => 'all']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !$status || $status === 'all' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Alle timesedler
            </a>
            <a href="{{ route('admin.timesheets.index', ['status' => 'submitted']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'submitted' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Afventer godkendelse
            </a>
            <a href="{{ route('admin.timesheets.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'approved' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Godkendte
            </a>
            <a href="{{ route('admin.timesheets.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $status === 'rejected' ? 'bg-slate-900 text-white font-bold' : 'text-slate-600 hover:bg-slate-100' }}">
                Afviste
            </a>
        </div>

        <!-- Timesheets Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Dato</th>
                            <th class="p-4">Vikar</th>
                            <th class="p-4">Kunde (Virksomhed)</th>
                            <th class="p-4">Tidsrum</th>
                            <th class="p-4">Pause</th>
                            <th class="p-4">Timer</th>
                            <th class="p-4">Vikar Løn</th>
                            <th class="p-4">Kunde Faktura</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Handling</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($timesheets as $ts)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-semibold text-slate-900">{{ $ts->clock_in->format('d.m.Y') }}</td>
                                <td class="p-4 font-bold text-slate-900">{{ $ts->worker->user->name ?? 'Vikar' }}</td>
                                <td class="p-4 text-slate-700">{{ $ts->shift->staffRequest->client->company_name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : 'I gang' }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->break_minutes }} min</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} t</td>
                                <td class="p-4 font-semibold text-emerald-700">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-semibold text-indigo-700">{{ number_format($ts->client_total_charge, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($ts->status->value === 'approved') bg-emerald-100 text-emerald-800
                                        @elseif($ts->status->value === 'rejected') bg-rose-100 text-rose-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ $ts->status->label() }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    @if($ts->status->value !== 'approved')
                                        <form method="POST" action="{{ route('admin.timesheets.approve', $ts) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-[11px] transition">
                                                Godkend
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-400 text-[11px]">Godkendt</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="p-8 text-center text-slate-400">
                                    Ingen timesedler fundet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $timesheets->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
