<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Vikarer & Kandidater (CRM)</h1>
                <p class="text-xs text-slate-500 mt-0.5">Godkend registreringer, spor arbejdstilladelser og administrer vikarstatus.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row gap-4 justify-between items-stretch sm:items-center">
            <form method="GET" action="{{ route('admin.workers.index') }}" class="flex flex-wrap gap-2 items-center flex-1">
                <input type="text" name="search" value="{{ $search }}" placeholder="Søg navn, e-mail, by eller postnr..." class="text-xs rounded-xl border-slate-300 w-full sm:w-64">

                <select name="status" class="text-xs rounded-xl border-slate-300">
                    <option value="all">Alle statusser</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Afventer godkendelse</option>
                    <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Godkendt</option>
                    <option value="suspended" {{ $status === 'suspended' ? 'selected' : '' }}>Suspenderet</option>
                    <option value="blocked" {{ $status === 'blocked' ? 'selected' : '' }}>Blokeret</option>
                </select>

                <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs">Filtrer</button>
            </form>
        </div>

        <!-- Workers Table -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                        <tr>
                            <th class="p-4">Vikar</th>
                            <th class="p-4">Lokation</th>
                            <th class="p-4">Kompetencer</th>
                            <th class="p-4">Rating</th>
                            <th class="p-4">Timeløn</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Handlinger</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($workers as $worker)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 font-bold text-slate-900">
                                    {{ $worker->user->name }}
                                    <span class="block text-[11px] text-slate-400 font-normal">{{ $worker->user->email }} &bull; {{ $worker->user->phone }}</span>
                                </td>
                                <td class="p-4 text-slate-700">{{ $worker->city }} ({{ $worker->postcode }})</td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1 max-w-xs">
                                        @foreach(array_slice((array)$worker->skills, 0, 3) as $s)
                                            <span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 text-slate-700">{{ $s }}</span>
                                        @endforeach
                                        @if(count((array)$worker->skills) > 3)
                                            <span class="text-[10px] text-slate-400">+{{ count((array)$worker->skills) - 3 }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-slate-700 font-semibold">★ {{ $worker->rating_avg }} ({{ $worker->ratings_count }})</td>
                                <td class="p-4 text-slate-700">{{ number_format($worker->hourly_rate, 2, ',', '.') }} kr.</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800
                                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800
                                        @else bg-rose-100 text-rose-800 @endif">
                                        {{ $worker->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.workers.show', $worker) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold">
                                        Administrer &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-slate-400">
                                    Ingen vikarer fundet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $workers->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
