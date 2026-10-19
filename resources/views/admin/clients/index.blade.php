<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Virksomheder & Kunder (CRM)</h1>
                <p class="text-xs text-slate-500 mt-0.5">Oversigt over registrerede virksomheder, CVR-numre og bemandingshistorik.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row gap-4 justify-between items-stretch sm:items-center">
            <form method="GET" action="{{ route('admin.clients.index') }}" class="flex gap-2 items-center flex-1">
                <input type="text" name="search" value="{{ $search }}" placeholder="Søg firmanavn, CVR, by eller kontaktperson..." class="text-xs rounded-xl border-slate-300 w-full sm:w-80">
                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs">Søg</button>
            </form>
        </div>

        <!-- Clients Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Virksomhed</th>
                            <th class="p-4">CVR</th>
                            <th class="p-4">Kontaktperson</th>
                            <th class="p-4">Lokation</th>
                            <th class="p-4">Ordrer</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Handlinger</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($clients as $c)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-bold text-slate-900">{{ $c->company_name }}</td>
                                <td class="p-4 text-slate-700 font-mono">{{ $c->cvr }}</td>
                                <td class="p-4 text-slate-700">
                                    {{ $c->contact_person }}
                                    <span class="block text-[11px] text-slate-400">{{ $c->phone }}</span>
                                </td>
                                <td class="p-4 text-slate-600">{{ $c->city }} ({{ $c->postcode }})</td>
                                <td class="p-4 font-bold text-indigo-700">{{ $c->staffRequests->count() }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($c->status === 'active') bg-emerald-100 text-emerald-800
                                        @elseif($c->status === 'pending') bg-amber-100 text-amber-800
                                        @else bg-rose-100 text-rose-800 @endif">
                                        {{ $c->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.clients.show', $c) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold">
                                        Se profil &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    Ingen virksomheder fundet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $clients->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
