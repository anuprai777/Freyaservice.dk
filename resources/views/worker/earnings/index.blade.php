<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Indtjenings- & Lønoversigt') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Dine registrerede timer og udbetalinger fra gennemførte vagter.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til overblik') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        <!-- Metrics Cards: 2x2 grid on mobile for instant thumb readability, 4 cols on desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Denne uge') }}</span>
                    <span class="text-lg sm:text-2xl font-black text-slate-900 mt-1 block">{{ number_format($thisWeekEarnings, 2, ',', '.') }} kr.</span>
                </div>
                <span class="text-[10px] sm:text-[11px] text-slate-500 mt-2 block">{{ __('Mandag til søndag') }}</span>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Denne måned') }}</span>
                    <span class="text-lg sm:text-2xl font-black text-indigo-600 mt-1 block">{{ number_format($thisMonthEarnings, 2, ',', '.') }} kr.</span>
                </div>
                <span class="text-[10px] sm:text-[11px] text-slate-500 mt-2 block">{{ __('Indeværende lønperiode') }}</span>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Samlet udbetalt') }}</span>
                    <span class="text-lg sm:text-2xl font-black text-emerald-600 mt-1 block">{{ number_format($totalEarningsAllTime, 2, ',', '.') }} kr.</span>
                </div>
                <span class="text-[10px] sm:text-[11px] text-slate-500 mt-2 block">{{ __('Godkendte vagter i alt') }}</span>
            </div>

            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <span class="text-[10px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Afventer godkendelse') }}</span>
                    <span class="text-lg sm:text-2xl font-black text-amber-500 mt-1 block">{{ number_format($pendingApprovalAmount, 2, ',', '.') }} kr.</span>
                </div>
                <span class="text-[10px] sm:text-[11px] text-slate-500 mt-2 block">{{ __('Indsendte timesedler') }}</span>
            </div>
        </div>

        <!-- Timesheets Container -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-4 sm:p-6 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-sm sm:text-base font-bold text-slate-900">{{ __('Udførte vagter & timesedler') }}</h2>
                <span class="text-xs text-slate-500">{{ __('Valuta: DKK') }}</span>
            </div>

            <!-- Mobile Stacked Cards (Visible on screens < md) -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse($timesheets as $ts)
                    <div class="p-4 space-y-3 hover:bg-slate-50/50 transition">
                        <!-- Top Row: Date and Status Badge -->
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full @if($ts->status->value === 'approved') bg-emerald-500 @elseif($ts->status->value === 'rejected') bg-rose-500 @else bg-amber-500 @endif"></span>
                                <span class="font-bold text-sm text-slate-900">{{ $ts->clock_in->format('d.m.Y') }}</span>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                @if($ts->status->value === 'approved') bg-emerald-100 text-emerald-800
                                @elseif($ts->status->value === 'rejected') bg-rose-100 text-rose-800
                                @else bg-amber-100 text-amber-800 @endif">
                                {{ $ts->status->label() }}
                            </span>
                        </div>

                        <!-- Company & Role -->
                        <div class="flex items-center gap-1.5 text-xs text-slate-700 font-semibold">
                            <x-heroicon-o-building-office-2 class="w-4 h-4 text-slate-400 shrink-0" />
                            <span>{{ $ts->shift->staffRequest->client->company_name ?? __('Virksomhed') }}</span>
                            @if(isset($ts->shift->staffRequest->role))
                                <span class="text-slate-400 font-normal">• {{ $ts->shift->staffRequest->role }}</span>
                            @endif
                        </div>

                        <!-- Working Hours & Break -->
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500">
                            <span class="flex items-center gap-1">
                                <x-heroicon-o-clock class="w-3.5 h-3.5 text-slate-400" />
                                <span>{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : '' }}</span>
                            </span>
                            <span>•</span>
                            <span>{{ __('Pause:') }} {{ $ts->break_minutes }} min</span>
                        </div>

                        <!-- Bottom Strip: Total Hours, Rate, and Total Pay -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between bg-slate-50/80 -mx-4 -mb-4 px-4 py-3 rounded-b-xl">
                            <div class="text-xs">
                                <span class="font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</span>
                                <span class="text-slate-500 text-[11px] block">à {{ number_format($ts->hourly_rate, 2, ',', '.') }} kr./t</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Løn i alt') }}</span>
                                <span class="text-base font-black text-indigo-700">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 text-xs">
                        {{ __('Ingen afsluttede vagter endnu. Når du tjekker ind og ud på dine vagter, vises de her.') }}
                    </div>
                @endforelse
            </div>

            <!-- Desktop Full Table (Visible on md and larger) -->
            <div class="hidden md:block overflow-x-auto" tabindex="0" role="region" aria-label="Udførte vagter & timesedler">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] sticky top-0">
                        <tr>
                            <th class="p-4">{{ __('Dato') }}</th>
                            <th class="p-4">{{ __('Kunde') }}</th>
                            <th class="p-4">{{ __('Tidsrum') }}</th>
                            <th class="p-4">{{ __('Pause') }}</th>
                            <th class="p-4">{{ __('Timer') }}</th>
                            <th class="p-4">{{ __('Timeløn') }}</th>
                            <th class="p-4">{{ __('Løn i alt') }}</th>
                            <th class="p-4 text-right">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($timesheets as $ts)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-semibold text-slate-900">{{ $ts->clock_in->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700">{{ $ts->shift->staffRequest->client->company_name ?? __('Virksomhed') }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : '' }}</td>
                                <td class="p-4 text-slate-600">{{ $ts->break_minutes }} min</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} t</td>
                                <td class="p-4 text-slate-600">{{ number_format($ts->hourly_rate, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-black text-indigo-700">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</td>
                                <td class="p-4 text-right">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
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
                                    {{ __('Ingen afsluttede vagter endnu. Når du tjekker ind og ud på dine vagter, vises de her.') }}
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


