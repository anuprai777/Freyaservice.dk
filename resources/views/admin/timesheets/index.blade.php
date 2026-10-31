<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Timesedler & Løngrundlag') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Overvåg vikarernes registrerede arbejdstimer og eksportér data til løn og bogholderi.') }}</p>
            </div>
            <div class="w-full sm:w-auto flex items-center gap-3">
                <a href="{{ route('admin.timesheets.export') }}" class="w-full sm:w-auto justify-center inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition min-h-[40px]">
                    <x-heroicon-o-arrow-down-tray class="w-4 h-4" />
                    <span>{{ __('Eksportér CSV (Excel)') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter Bar (horizontally scrollable on mobile) -->
        <x-card padding="sm" class="overflow-x-auto scrollbar-none">
            <div class="flex items-center gap-2 min-w-max">
                <a href="{{ route('admin.timesheets.index', ['status' => 'all']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ !$status || $status === 'all' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ __('Alle timesedler') }}
                </a>
                <a href="{{ route('admin.timesheets.index', ['status' => 'submitted']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'submitted' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ __('Afventer godkendelse') }}
                </a>
                <a href="{{ route('admin.timesheets.index', ['status' => 'approved']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'approved' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ __('Godkendte') }}
                </a>
                <a href="{{ route('admin.timesheets.index', ['status' => 'rejected']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition {{ $status === 'rejected' ? 'bg-[#7B1E3A] text-white font-bold shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                    {{ __('Afviste') }}
                </a>
            </div>
        </x-card>

        <!-- Timesheets List -->
        <x-card padding="none">
            <!-- Mobile Card View (md:hidden) -->
            <div class="md:hidden divide-y divide-slate-100">
                @forelse($timesheets as $ts)
                    <div class="p-4 space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="font-bold text-slate-900 text-sm block">{{ $ts->worker->user->name ?? __('Vikar') }}</span>
                                <span class="text-xs text-slate-500">{{ $ts->shift->staffRequest->client->company_name ?? __('Ukendt kunde') }}</span>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                @if($ts->status->value === 'approved') bg-emerald-100 text-emerald-800
                                @elseif($ts->status->value === 'rejected') bg-rose-100 text-rose-800
                                @else bg-amber-100 text-amber-800 @endif">
                                {{ $ts->status->label() }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 p-3 rounded-xl border border-slate-100">
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Dato') }}:</span>
                                <span class="font-medium text-slate-700">{{ $ts->clock_in->format('d.m.Y') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Tidsrum') }}:</span>
                                <span class="font-medium text-slate-700">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('I gang') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Timer') }} ({{ __('pause') }} {{ $ts->break_minutes }}m):</span>
                                <span class="font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 text-[11px] block">{{ __('Vikar løn:') }}</span>
                                <span class="font-bold text-emerald-600">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</span>
                            </div>
                            <div class="col-span-2 pt-1 border-t border-slate-200/60 flex justify-between items-center">
                                <span class="text-slate-400 text-[11px]">{{ __('Kunde faktura:') }}</span>
                                <span class="font-bold text-[#7B1E3A]">{{ number_format($ts->client_total_charge, 2, ',', '.') }} kr.</span>
                            </div>
                        </div>

                        @if($ts->status->value !== 'approved')
                            <form method="POST" action="{{ route('admin.timesheets.approve', $ts) }}" class="pt-1">
                                @csrf
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition shadow-xs min-h-[42px]">
                                    <x-heroicon-s-check class="w-4 h-4" />
                                    <span>{{ __('Godkend timeseddel') }}</span>
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="p-6 text-center text-xs text-slate-400">
                        {{ __('Ingen timesedler fundet.') }}
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View (hidden md:block) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Dato') }}</th>
                            <th class="p-4">{{ __('Vikar') }}</th>
                            <th class="p-4">{{ __('Kunde (Virksomhed)') }}</th>
                            <th class="p-4">{{ __('Tidsrum') }}</th>
                            <th class="p-4">{{ __('Pause') }}</th>
                            <th class="p-4">{{ __('Timer') }}</th>
                            <th class="p-4">{{ __('Vikar Løn') }}</th>
                            <th class="p-4">{{ __('Kunde Faktura') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Handling') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($timesheets as $ts)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-semibold text-slate-900">{{ $ts->clock_in->format('d.m.Y') }}</td>
                                <td class="p-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-[10px] shrink-0">
                                            {{ strtoupper(substr($ts->worker->user->name ?? 'V', 0, 1)) }}
                                        </div>
                                        <span>{{ $ts->worker->user->name ?? __('Vikar') }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">{{ $ts->shift->staffRequest->client->company_name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-clock class="w-3.5 h-3.5 text-slate-400" />
                                        <span>{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('I gang') }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600">{{ $ts->break_minutes }} min</td>
                                <td class="p-4 font-bold text-slate-900">{{ number_format($ts->hours, 2, ',', '.') }} t</td>
                                <td class="p-4 font-semibold text-emerald-700">{{ number_format($ts->worker_total_pay, 2, ',', '.') }} kr.</td>
                                <td class="p-4 font-semibold text-[#7B1E3A]">{{ number_format($ts->client_total_charge, 2, ',', '.') }} kr.</td>
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
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-xs transition">
                                                <x-heroicon-s-check class="w-3.5 h-3.5" />
                                                <span>{{ __('Godkend') }}</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-400 text-[11px] inline-flex items-center gap-1 font-medium">
                                            <x-heroicon-s-check class="w-3.5 h-3.5 text-emerald-600" />
                                            <span>{{ __('Godkendt') }}</span>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen timesedler fundet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $timesheets->links() }}
            </div>
        </x-card>

    </div>
</x-app-layout>
