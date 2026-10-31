<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Vikarer & Kandidater (CRM)') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Godkend registreringer, spor arbejdstilladelser og administrer vikarstatus.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter Bar -->
        <x-card padding="sm">
            <form method="GET" action="{{ route('admin.workers.index') }}" class="flex flex-wrap gap-2.5 items-center flex-1">
                <div class="relative w-full sm:w-64">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
                    <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Søg navn, e-mail, by eller postnr...') }}" class="text-xs rounded-xl border-slate-300 pl-9 w-full focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                </div>

                <select name="status" class="text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                    <option value="all">{{ __('Alle statusser') }}</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>{{ __('Afventer godkendelse') }}</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>{{ __('Godkendt') }}</option>
                    <option value="suspended" {{ $status === 'suspended' ? 'selected' : '' }}>{{ __('Suspenderet') }}</option>
                    <option value="blocked" {{ $status === 'blocked' ? 'selected' : '' }}>{{ __('Blokeret') }}</option>
                </select>

                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                    <x-heroicon-o-funnel class="w-3.5 h-3.5" />
                    <span>{{ __('Filtrer') }}</span>
                </button>
            </form>
        </x-card>

        <!-- Workers Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Vikar') }}</th>
                            <th class="p-4">{{ __('Lokation') }}</th>
                            <th class="p-4">{{ __('Kompetencer') }}</th>
                            <th class="p-4">{{ __('Rating') }}</th>
                            <th class="p-4">{{ __('Timeløn') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Handlinger') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($workers as $worker)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-xs shrink-0">
                                            {{ strtoupper(substr($worker->user->name ?? 'V', 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="block text-slate-900">{{ $worker->user->name }}</span>
                                            <span class="block text-[11px] text-slate-400 font-normal">{{ $worker->user->email }} &bull; {{ $worker->user->phone }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $worker->city }} ({{ $worker->postcode }})</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1 max-w-xs">
                                        @foreach(array_slice((array)$worker->skills, 0, 3) as $s)
                                            <span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 text-slate-700 font-medium border border-slate-200/50">{{ __($s) }}</span>
                                        @endforeach
                                        @if(count((array)$worker->skills) > 3)
                                            <span class="text-[10px] text-slate-400 font-medium">+{{ count((array)$worker->skills) - 3 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700 font-semibold">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-s-star class="w-3.5 h-3.5 text-amber-500" />
                                        <span>{{ $worker->rating_avg }} ({{ $worker->ratings_count }})</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700 font-medium">{{ number_format($worker->hourly_rate, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800
                                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800
                                        @else bg-rose-100 text-rose-800 @endif">
                                        {{ __($worker->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.workers.show', $worker) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition">
                                        <span>{{ __('Administrer') }}</span>
                                        <x-heroicon-o-chevron-right class="w-3.5 h-3.5 text-slate-400" />
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen vikarer fundet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $workers->links() }}
            </div>
        </x-card>

    </div>
</x-app-layout>
