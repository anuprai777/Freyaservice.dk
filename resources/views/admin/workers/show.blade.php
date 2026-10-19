<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800
                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800
                        @else bg-rose-100 text-rose-800 @endif">
                        {{ $worker->status }}
                    </span>
                    <span class="text-xs font-semibold text-slate-500">★ {{ $worker->rating_avg }} ({{ $worker->ratings_count }} anmeldelser)</span>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $worker->user->name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">Tilmeldt {{ $worker->created_at->format('d.m.Y') }} &bull; E-mail: {{ $worker->user->email }} &bull; Tlf: {{ $worker->user->phone }}</p>
            </div>
            <a href="{{ route('admin.workers.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; Tilbage til vikarer
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

            <!-- Left: Profile & Verification -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Documents Verification Section -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Uploadede Dokumenter & Verifikation</h2>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                                <tr>
                                    <th class="p-3">Type</th>
                                    <th class="p-3">Udløb</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Fil</th>
                                    <th class="p-3 text-right">Verifikation</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($worker->documents as $doc)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="p-3 font-bold text-slate-900">{{ $doc->type->label() }}</td>
                                        <td class="p-3 text-slate-600">{{ $doc->expiry_date ? $doc->expiry_date->format('d.m.Y') : 'Ingen udløb' }}</td>
                                        <td class="p-3">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                                @if($doc->status->value === 'approved') bg-emerald-100 text-emerald-800
                                                @elseif($doc->status->value === 'rejected') bg-rose-100 text-rose-800
                                                @else bg-amber-100 text-amber-800 @endif">
                                                {{ $doc->status->label() }}
                                            </span>
                                            @if($doc->rejection_reason)
                                                <div class="text-[10px] text-rose-600 mt-0.5">Afvist: {{ $doc->rejection_reason }}</div>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            <a href="{{ route('worker.documents.download', $doc) }}" class="text-indigo-600 hover:underline font-semibold">
                                                Download fil
                                            </a>
                                        </td>
                                        <td class="p-3 text-right">
                                            <div class="inline-flex items-center gap-1.5">
                                                <!-- Approve Form -->
                                                <form method="POST" action="{{ route('admin.documents.verify', $doc) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="px-2.5 py-1 rounded bg-emerald-600 text-white font-bold text-[11px] hover:bg-emerald-700">
                                                        Godkend
                                                    </button>
                                                </form>

                                                <!-- Reject Form Trigger -->
                                                <div x-data="{ openReject: false }">
                                                    <button type="button" @click="openReject = true" class="px-2.5 py-1 rounded border border-rose-300 bg-rose-50 text-rose-700 font-semibold text-[11px] hover:bg-rose-100">
                                                        Afvis
                                                    </button>

                                                    <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
                                                        <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left shadow-2xl">
                                                            <h3 class="text-sm font-bold text-slate-900">Afvis dokument</h3>
                                                            <form method="POST" action="{{ route('admin.documents.verify', $doc) }}" class="mt-3 space-y-3">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <textarea name="rejection_reason" required rows="2" class="w-full text-xs rounded-xl border-slate-300" placeholder="Begrundelse (f.eks. Utydeligt foto eller udløbet dato)..."></textarea>
                                                                <div class="flex justify-end gap-2">
                                                                    <button type="button" @click="openReject = false" class="px-3 py-1 rounded-lg text-xs text-slate-500">Luk</button>
                                                                    <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-rose-600 text-white">Bekræft afvisning</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-slate-400">Ingen dokumenter uploadet endnu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Client Ratings & Reviews -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Kundebedømmelser & Feedback</h2>

                    <div class="space-y-3">
                        @forelse($worker->ratings as $rating)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-xs space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-900">{{ $rating->client->company_name ?? 'Virksomhed' }}</span>
                                    <span class="text-amber-500 font-bold">★ {{ $rating->rating }} / 5</span>
                                </div>
                                @if($rating->comment)
                                    <p class="text-slate-600 italic">"{{ $rating->comment }}"</p>
                                @endif
                                <div class="text-[10px] text-slate-400">{{ $rating->created_at->format('d.m.Y H:i') }}</div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">Ingen anmeldelser modtaget endnu.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right: Status & Notes -->
            <div class="space-y-6">
                <!-- Status Changer -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Vikarstatus & CRM Noter</h2>

                    <form method="POST" action="{{ route('admin.workers.update-status', $worker) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Status</label>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300">
                                <option value="pending" {{ $worker->status === 'pending' ? 'selected' : '' }}>Afventer godkendelse</option>
                                <option value="approved" {{ $worker->status === 'approved' ? 'selected' : '' }}>Godkendt (Aktiv vikar)</option>
                                <option value="suspended" {{ $worker->status === 'suspended' ? 'selected' : '' }}>Suspenderet</option>
                                <option value="blocked" {{ $worker->status === 'blocked' ? 'selected' : '' }}>Blokeret</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Interne noter</label>
                            <textarea name="notes" rows="4" class="w-full text-xs rounded-xl border-slate-300" placeholder="Skriv interne bemærkninger om vikaren her...">{{ old('notes', $worker->notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            Gem vikarstatus & noter
                        </button>
                    </form>
                </div>

                <!-- Profile Overview Box -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-3 text-xs">
                    <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-2">Kompetencer & Data</h3>
                    <div><strong>By:</strong> {{ $worker->city }} ({{ $worker->postcode }})</div>
                    <div><strong>Løn:</strong> {{ number_format($worker->hourly_rate, 2, ',', '.') }} DKK/time</div>
                    <div><strong>Rådighedstype:</strong> {{ $worker->availability_type }}</div>
                    <div><strong>Bank:</strong> {{ $worker->bank_reg_number ? '✓ Registreret (krypteret)' : 'Ej angivet' }}</div>
                    <div class="pt-2">
                        <span class="block font-semibold text-slate-700 mb-1">Færdigheder:</span>
                        <div class="flex flex-wrap gap-1">
                            @foreach((array)$worker->skills as $sk)
                                <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[10px]">{{ $sk }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
