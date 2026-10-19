<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $client->company_name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">CVR: {{ $client->cvr }} &bull; Tilmeldt {{ $client->created_at->format('d.m.Y') }}</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage til virksomheder
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left: Info & Staff Requests History -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Company info card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-3 text-xs">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Virksomhedsoplysninger</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div><strong>Kontaktperson:</strong> {{ $client->contact_person }}</div>
                        <div><strong>Telefon:</strong> {{ $client->phone }}</div>
                        <div><strong>E-mail:</strong> {{ $client->user->email ?? 'N/A' }}</div>
                        <div><strong>Faktura E-mail:</strong> {{ $client->billing_email ?? $client->user->email }}</div>
                        <div class="col-span-2"><strong>Adresse:</strong> {{ $client->address }}, {{ $client->postcode }} {{ $client->city }}</div>
                        @if($client->industry)
                            <div><strong>Branche:</strong> {{ $client->industry }}</div>
                        @endif
                    </div>
                </div>

                <!-- Staff Requests History -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Historiske bemandingsforespørgsler</h2>

                    <div class="space-y-3">
                        @forelse($client->staffRequests as $req)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex justify-between items-center text-xs">
                                <div>
                                    <div class="font-bold text-slate-900">{{ $req->role }}</div>
                                    <div class="text-slate-500">Start: {{ $req->start_date->format('d.m.Y') }} &bull; {{ $req->workers_needed }} vikar(er)</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status->badgeClasses() }}">{{ $req->status->label() }}</span>
                                    <a href="{{ route('admin.requests.show', $req) }}" class="text-indigo-600 font-bold hover:underline">Vis &rarr;</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">Ingen ordrer oprettet af denne virksomhed endnu.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right: Status Changer -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Administrer status</h2>

                    <form method="POST" action="{{ route('admin.clients.update-status', $client) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Status</label>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300">
                                <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>Aktiv</option>
                                <option value="pending" {{ $client->status === 'pending' ? 'selected' : '' }}>Afventer godkendelse</option>
                                <option value="suspended" {{ $client->status === 'suspended' ? 'selected' : '' }}>Suspenderet</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Interne noter</label>
                            <textarea name="notes" rows="4" class="w-full text-xs rounded-xl border-slate-300">{{ old('notes', $client->notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            Gem virksomhedsstatus
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
