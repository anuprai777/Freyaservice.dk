<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Indtjenings- & Lønoversigt</h1>
                <p class="text-xs text-slate-500 mt-0.5">Dine registrerede timer og udbetalinger fra gennemførte vagter.</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Metrics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Denne uge</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ number_format($thisWeekEarnings, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Mandag til søndag</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Denne måned</span>
                <span class="text-2xl font-black text-indigo-600 mt-1 block">{{ number_format($thisMonthEarnings, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Indeværende lønperiode</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Samlet udbetalt</span>
                <span class="text-2xl font-black text-emerald-600 mt-1 block">{{ number_format($totalEarningsAllTime, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Godkendte vagter i alt</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Afventer godkendelse</span>
                <span class="text-2xl font-black text-amber-500 mt-1 block">{{ number_format($pendingApprovalAmount, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">Indsendte timesedler</span>
            </div>
        </div>

        <!-- Timesheets Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-base font-bold text-slate-900">Udførte vagter & timesedler</h2>
                <span class="text-xs text-slate-500">Valuta: DKK</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Dato</th>
                            <th class="p-4">Kunde</th>
                            <th class="p-4">Tidsrum</th>
                            <th class="p-4">Pause</th>
                            <th class="p-4">Timer</th>
                            <th class="p-4">Timeløn</th>
                            <th class="p-4">Løn i alt</th>
                            <th class="p-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($timesheets as $ts)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-semibold text-slate-900">{{ $ts->clock_in->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $ts->shift->staffRequest->client->company_name ?? 'Virksomhed' }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : '' }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->break_minutes }} min</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} t</td>
                                <td class="p-4 text-slate-600">{{ number_format($ts->hourly_rate, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-black text-indigo-700">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-right">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($ts->status->value === 'approved') bg-emerald-100 text-emerald-800
                                        @elseif($ts->status->value === 'rejected') bg-rose-100 text-rose-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ $ts->status->label() }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-slate-400">
                                    Ingen afsluttede vagter endnu. Når du tjekker ind og ud på dine vagter, vises de her.
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
