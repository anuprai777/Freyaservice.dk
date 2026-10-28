<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Bemandingsforespørgsler') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oversigt over alle kundeordrer og vikaranmodninger.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; {{ __('Tilbage') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Filters & Search -->
        <x-card padding="sm">
            <form method="GET" action="{{ route('admin.requests.index') }}" class="flex flex-wrap gap-2 items-center flex-1">
                <input type="text" name="search" value="{{ $search }}" placeholder="{{ __('Søg stilling, by eller virksomhed...') }}" class="text-xs rounded-xl border-slate-300 w-full sm:w-64">

                <select name="status" class="text-xs rounded-xl border-slate-300">
                    <option value="all">{{ __('Alle statusser') }}</option>
                    <option value="new" {{ $status === 'new' ? 'selected' : '' }}>{{ __('Ny') }}</option>
                    <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>{{ __('Under match') }}</option>
                    <option value="matched" {{ $status === 'matched' ? 'selected' : '' }}>{{ __('Matchet') }}</option>
                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>{{ __('Aktiv') }}</option>
                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>{{ __('Fuldført') }}</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>{{ __('Annulleret') }}</option>
                </select>

                <select name="type" class="text-xs rounded-xl border-slate-300">
                    <option value="all">{{ __('Alle typer') }}</option>
                    <option value="temporary_cover" {{ $type === 'temporary_cover' ? 'selected' : '' }}>{{ __('Akut / Midlertidig') }}</option>
                    <option value="part_time" {{ $type === 'part_time' ? 'selected' : '' }}>{{ __('Deltid') }}</option>
                    <option value="full_time" {{ $type === 'full_time' ? 'selected' : '' }}>{{ __('Fuldtid') }}</option>
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs">{{ __('Filtrer') }}</button>
            </form>
        </x-card>

        <!-- Requests Table -->
        <x-card padding="none">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
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
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-1.5">
                                        <span>{{ $req->role }}</span>
                                        @if($req->is_urgent)
                                            <span class="px-1.5 py-0.5 rounded bg-rose-100 text-rose-800 text-[9px] font-bold">⚡ {{ __('AKUT') }}</span>
                                        @endif
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-normal">{{ $req->request_type->label() }}</span>
                                </td>
                                <td class="p-4 text-slate-700 font-semibold">{{ $req->client->company_name ?? 'N/A' }}</td>
                                <td class="p-4 text-slate-600">{{ $req->city }} ({{ $req->postcode }})</td>
                                <td class="p-4 text-slate-700">{{ $req->start_date->format('d.m.Y') }}</td>
                                <td class="p-4 text-slate-700 font-semibold">{{ $req->workers_needed }} {{ __('vikar(er)') }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status->badgeClasses() }}">
                                        {{ $req->status->label() }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('admin.matching.show', $req) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                                            🎯 {{ __('Match') }}
                                        </a>
                                        <a href="{{ route('admin.requests.show', $req) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold">
                                            {{ __('Detaljer') }}
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
