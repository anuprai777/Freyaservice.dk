<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Virksomheder & Kunder (CRM)') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oversigt over registrerede virksomheder, CVR-numre og bemandingshistorik.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Search Bar -->
        <x-card padding="sm">
            <form method="GET" action="{{ route('admin.clients.index') }}" class="flex flex-wrap gap-2.5 items-center flex-1">
                <div class="relative w-full sm:w-80">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
                    <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Søg firmanavn, CVR, by eller kontaktperson...') }}" class="text-xs rounded-xl border-slate-300 pl-9 w-full focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                </div>
                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                    <x-heroicon-o-magnifying-glass class="w-3.5 h-3.5" />
                    <span>{{ __('Søg') }}</span>
                </button>
            </form>
        </x-card>

        <!-- Clients Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Virksomhed') }}</th>
                            <th class="p-4">{{ __('CVR') }}</th>
                            <th class="p-4">{{ __('Kontaktperson') }}</th>
                            <th class="p-4">{{ __('Lokation') }}</th>
                            <th class="p-4">{{ __('Ordrer') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Handlinger') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($clients as $c)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] flex items-center justify-center shrink-0">
                                            <x-heroicon-o-building-office-2 class="w-4 h-4 text-[#7B1E3A]" />
                                        </div>
                                        <span>{{ $c->company_name }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700 font-mono">
                                    <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold border border-slate-200/50">
                                        {{ $c->cvr }}
                                    </span>
                                </td>
                                <td class="p-4 text-slate-700">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-user class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $c->contact_person }}</span>
                                    </div>
                                    <span class="block text-[11px] text-slate-400 pl-5">{{ $c->phone }}</span>
                                </td>
                                <td class="p-4 text-slate-600">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $c->city }} ({{ $c->postcode }})</span>
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-[#7B1E3A]">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A]">
                                        {{ $c->staffRequests->count() }} {{ __('ordrer') }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($c->status === 'active') bg-emerald-100 text-emerald-800
                                        @elseif($c->status === 'pending') bg-amber-100 text-amber-800
                                        @else bg-rose-100 text-rose-800 @endif">
                                        {{ __($c->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.clients.show', $c) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition">
                                        <span>{{ __('Se profil') }}</span>
                                        <x-heroicon-o-chevron-right class="w-3.5 h-3.5 text-slate-400" />
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen virksomheder fundet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $clients->links() }}
            </div>
        </x-card>

    </div>
</x-app-layout>
