<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Bemandingsforespørgsler') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oversigt over alle kundeordrer og vikaranmodninger.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til overblik') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Filters & Search -->
        <x-card padding="sm">
            <form method="GET" action="{{ route('admin.requests.index') }}" class="flex flex-wrap gap-2.5 items-center flex-1">
                <div class="relative w-full sm:w-64">
                    <x-heroicon-o-magnifying-glass class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
                    <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Søg stilling, by eller virksomhed...') }}" class="text-xs rounded-xl border-slate-300 pl-9 w-full focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                </div>

                <select name="status" class="text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                    <option value="all">{{ __('Alle statusser') }}</option>
                    <option value="new" {{ $status === 'new' ? 'selected' : '' }}>{{ __('Ny') }}</option>
                    <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>{{ __('Under match') }}</option>
                    <option value="matched" {{ $status === 'matched' ? 'selected' : '' }}>{{ __('Matchet') }}</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>{{ __('Aktiv') }}</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>{{ __('Fuldført') }}</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>{{ __('Annulleret') }}</option>
                </select>

                <select name="type" class="text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                    <option value="all">{{ __('Alle typer') }}</option>
                    <option value="temporary_cover" {{ $type === 'temporary_cover' ? 'selected' : '' }}>{{ __('Akut / Midlertidig') }}</option>
                    <option value="part_time" {{ $type === 'part_time' ? 'selected' : '' }}>{{ __('Deltid') }}</option>
                    <option value="full_time" {{ $type === 'full_time' ? 'selected' : '' }}>{{ __('Fuldtid') }}</option>
                </select>

                <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                    <x-heroicon-o-funnel class="w-3.5 h-3.5" />
                    <span>{{ __('Filtrer') }}</span>
                </button>
            </form>
        </x-card>

        <!-- Requests Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                        <tr>
                            <th class="p-4">{{ __('Stilling') }}</th>
                            <th class="p-4">{{ __('Virksomhed') }}</th>
                            <th class="p-4">{{ __('Lokation') }}</th>
                            <th class="p-4">{{ __('Startdato') }}</th>
                            <th class="p-4">{{ __('Behov') }}</th>
                            <th class="p-4">{{ __('Status') }}</th>
                            <th class="p-4 text-right">{{ __('Handlinger') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($requests as $req)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-1.5">
                                        <span>{{ $req->role }}</span>
                                        @if($req->is_urgent)
                                            <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded bg-rose-100 text-rose-800 text-[9px] font-bold">
                                                <x-heroicon-s-bolt class="w-2.5 h-2.5" />
                                                <span>{{ __('AKUT') }}</span>
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-normal">{{ $req->request_type->label() }}</span>
                                </td>
                                <td class="p-4 text-slate-700 font-semibold">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $req->client->company_name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $req->city }} ({{ $req->postcode }})</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $req->start_date->format('d.m.Y') }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700 font-semibold">
                                    <div class="flex items-center gap-1">
                                        <x-heroicon-o-users class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                        <span>{{ $req->workers_needed }} {{ __('vikar(er)') }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status->badgeClasses() }}">
                                        {{ $req->status->label() }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.matching.show', $req) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                                            <x-heroicon-s-sparkles class="w-3.5 h-3.5 text-[#C9A24B]" />
                                            <span>{{ __('Match') }}</span>
                                        </a>
                                        <a href="{{ route('admin.requests.show', $req) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition">
                                            <span>{{ __('Detaljer') }}</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    {{ __('Ingen forespørgsler fundet.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $requests->links() }}
            </div>
        </x-card>

    </div>
</x-app-layout>
