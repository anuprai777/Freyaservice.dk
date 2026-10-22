<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $staffRequest->status->badgeClasses() }}">
                        {{ $staffRequest->status->label() }}
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">⚡ {{ __('AKUT') }}</span>
                    @endif
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $staffRequest->role }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oprettet') }} {{ $staffRequest->created_at->format('d.m.Y H:i') }} • {{ $staffRequest->request_type->label() }}</p>
            </div>
            <div class="flex items-center gap-3">
                @if(in_array($staffRequest->status->value, ['new', 'in_progress', 'matched']))
                    <form method="POST" action="{{ route('client.requests.cancel', $staffRequest) }}" onsubmit="return confirm('{{ __('Er du sikker på, at du vil annullere denne forespørgsel?') }}');">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition">
                            {{ __('Annuller forespørgsel') }}
                        </button>
                    </form>
                @endif
                <a href="{{ route('client.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                    &larr; {{ __('Tilbage') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Flash messages -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Left: Request Details -->
            <div class="md:col-span-2 space-y-6">
                <!-- Location & Schedule Details -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">{{ __('Opgavedetaljer') }}</h2>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Lokation:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->location }}, {{ $staffRequest->postcode }} {{ $staffRequest->city }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Antal vikarer:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->workers_needed }} {{ __('person(er)') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Periode:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->start_date->format('d.m.Y') }} @if($staffRequest->end_date) - {{ $staffRequest->end_date->format('d.m.Y') }} @endif</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Mødetid:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->start_time ?? '-' }} {{ __('til') }} {{ $staffRequest->end_time ?? '-' }}</span>
                        </div>
                        @if($staffRequest->dress_code)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Dresscode / Påklædning:') }}</span>
                                <span class="font-semibold text-slate-800">{{ $staffRequest->dress_code }}</span>
                            </div>
                        @endif
                        @if($staffRequest->instructions)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Særlige instruktioner:') }}</span>
                                <span class="text-slate-700 leading-relaxed">{{ $staffRequest->instructions }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Assigned Workers & Shifts -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">{{ __('Tildelte Vikarer & Vagter') }}</h2>

                    @forelse($staffRequest->shifts as $shift)
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-3">
                            <div class="flex justify-between items-center text-xs">
                                <div>
                                    <span class="font-bold text-slate-900">{{ $shift->title }}</span>
                                    <span class="text-slate-500 block">{{ $shift->start_at->format('d. M Y, H:i') }} - {{ $shift->end_at->format('H:i') }} ({{ $shift->duration_hours }} {{ __('timer') }})</span>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-slate-200 text-slate-700">
                                    {{ $shift->status->label() }}
                                </span>
                            </div>

                            <!-- Workers on this shift -->
                            <div class="space-y-2 pt-2 border-t border-slate-200/60">
                                @forelse($shift->assignments as $asgn)
                                    <div class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-200 text-xs">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-xs">
                                                {{ substr($asgn->worker->user->name ?? 'V', 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900">{{ $asgn->worker->user->name ?? __('Vikar') }}</div>
                                                <div class="text-[11px] text-slate-500">{{ __('Tlf:') }} {{ $asgn->worker->user->phone ?? __('Ej oplyst') }} • ★ {{ $asgn->worker->rating_avg }} ({{ $asgn->worker->ratings_count }} {{ __('anm.') }})</div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <!-- Toggle Favourite Button -->
                                            <form method="POST" action="{{ route('client.workers.toggle-favourite', $asgn->worker) }}">
                                                @csrf
                                                <button type="submit" class="px-2.5 py-1 rounded-lg text-xs font-semibold border border-amber-300 bg-amber-50 text-amber-800 hover:bg-amber-100 transition">
                                                    ★ {{ __('Favorit') }}
                                                </button>
                                            </form>

                                            <!-- Rate worker modal button (if completed) -->
                                            <div x-data="{ openRate: false }">
                                                <button type="button" @click="openRate = true" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">
                                                    {{ __('Giv bedømmelse') }}
                                                </button>

                                                <!-- Rate Modal -->
                                                <div x-show="openRate" x-cloak class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
                                                    <div @click.away="openRate = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left shadow-2xl">
                                                        <h3 class="text-sm font-bold text-slate-900">{{ __('Bedøm') }} {{ $asgn->worker->user->name }}</h3>
                                                        <form method="POST" action="{{ route('client.ratings.store') }}" class="mt-4 space-y-3">
                                                            @csrf
                                                            <input type="hidden" name="worker_id" value="{{ $asgn->worker->id }}">
                                                            <input type="hidden" name="staff_request_id" value="{{ $staffRequest->id }}">
                                                            <input type="hidden" name="shift_id" value="{{ $shift->id }}">

                                                            <div>
                                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Samlet vurdering (1-5 stjerner)') }}</label>
                                                                <select name="rating" required class="w-full text-xs rounded-xl border-slate-300">
                                                                    <option value="5">★★★★★ (5 - {{ __('Fremragende') }})</option>
                                                                    <option value="4">★★★★☆ (4 - {{ __('Meget tilfreds') }})</option>
                                                                    <option value="3">★★★☆☆ (3 - {{ __('Tilfredsstillende') }})</option>
                                                                    <option value="2">★★☆☆☆ (2 - {{ __('Under forventning') }})</option>
                                                                    <option value="1">★☆☆☆☆ (1 - {{ __('Utilfredsstillende') }})</option>
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Kommentar') }}</label>
                                                                <textarea name="comment" rows="2" class="w-full text-xs rounded-xl border-slate-300" placeholder="{{ __('F.eks. Mødte til tiden, ydede fantastisk service...') }}"></textarea>
                                                            </div>

                                                            <div class="flex justify-end gap-2 pt-2">
                                                                <button type="button" @click="openRate = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                                                <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-indigo-600 text-white hover:bg-indigo-700">{{ __('Indsend') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-3 text-xs text-slate-400">
                                        {{ __('FreyaServices vagtkoordinator er ved at tildele vikarer til denne vagt.') }}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-xs text-slate-400">
                            {{ __('Ingen specifikke vagter oprettet endnu.') }}
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right: Shift Check-in QR Code Card -->
            <div class="space-y-6">
                @if($staffRequest->shifts->isNotEmpty())
                    @php $firstShift = $staffRequest->shifts->first(); @endphp
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm text-center">
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">{{ __('Tjek-ind QR-kode') }}</div>
                        <h3 class="text-sm font-bold text-slate-900 mb-3">{{ $firstShift->title }}</h3>

                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200 inline-block shadow-inner mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode(url('/worker/shifts/scan?shift=' . $firstShift->id . '&token=' . $firstShift->qr_secret_token)) }}" alt="Tjek-ind QR Kode" class="mx-auto rounded-lg">
                        </div>

                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ __('Placér denne kode ved jeres indgang. Tildelte vikarer scanner koden med mobilkameraet for at registrere fremmøde.') }}
                        </p>
                    </div>
                @endif

                <!-- Support Box -->
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-5 text-indigo-950 text-xs space-y-2">
                    <div class="font-bold text-indigo-900 flex items-center gap-1.5">
                        <span>📞</span>
                        <span>{{ __('FreyaService Døgnvagt') }}</span>
                    </div>
                    <p class="text-indigo-800 leading-relaxed">
                        {{ __('Har du brug for akutte ændringer eller ekstra mandskab på denne ordre?') }}
                    </p>
                    <div class="pt-2">
                        <a href="tel:+4570203040" class="inline-block font-bold text-indigo-700 hover:text-indigo-900">
                            {{ __('Ring direkte:') }} +45 70 20 30 40
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
