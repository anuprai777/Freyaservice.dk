<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $staffRequest->status->badgeClasses() }}">
                        {{ $staffRequest->status->label() }}
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">
                            <x-heroicon-s-bolt class="w-3 h-3 text-rose-600" />
                            <span>{{ __('AKUT') }}</span>
                        </span>
                    @endif
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $staffRequest->role }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oprettet') }} {{ $staffRequest->created_at->format('d.m.Y H:i') }} &bull; {{ $staffRequest->request_type->label() }}</p>
            </div>
            <div class="flex items-center gap-3">
                @if(in_array($staffRequest->status->value, ['new', 'in_progress', 'matched']))
                    <form method="POST" action="{{ route('client.requests.cancel', $staffRequest) }}" data-confirm="{{ __('Er du sikker på, at du vil annullere denne forespørgsel?') }}" onsubmit="return confirm(this.dataset.confirm);">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 rounded-xl text-xs font-bold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition shadow-xs">
                            <x-heroicon-o-x-circle class="w-3.5 h-3.5" />
                            <span>{{ __('Annuller forespørgsel') }}</span>
                        </button>
                    </form>
                @endif
                <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                    <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                    <span>{{ __('Tilbage') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Flash messages -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Left: Request Details -->
            <div class="md:col-span-2 space-y-6">
                <!-- Location & Schedule Details -->
                <x-card class="space-y-4">
                    <x-slot:header>
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-[#7B1E3A]" />
                            <h2 class="text-base font-bold text-slate-900">{{ __('Opgavedetaljer') }}</h2>
                        </div>
                    </x-slot:header>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Lokation:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                <span>{{ $staffRequest->location }}, {{ $staffRequest->postcode }} {{ $staffRequest->city }}</span>
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Antal vikarer:') }}</span>
                            <span class="font-bold text-[#7B1E3A] flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-users class="w-3.5 h-3.5 text-[#7B1E3A] shrink-0" />
                                <span>{{ $staffRequest->workers_needed }} {{ __('person(er)') }}</span>
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Periode:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                <span>{{ $staffRequest->start_date->format('d.m.Y') }} @if($staffRequest->end_date) - {{ $staffRequest->end_date->format('d.m.Y') }} @endif</span>
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Mødetid:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-clock class="w-3.5 h-3.5 text-slate-400 shrink-0" />
                                <span>{{ $staffRequest->start_time ?? '-' }} {{ __('til') }} {{ $staffRequest->end_time ?? '-' }}</span>
                            </span>
                        </div>
                        @if($staffRequest->dress_code)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Dresscode / Påklædning:') }}</span>
                                <span class="font-semibold text-slate-800 mt-0.5 block">{{ $staffRequest->dress_code }}</span>
                            </div>
                        @endif
                        @if($staffRequest->instructions)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Særlige instruktioner:') }}</span>
                                <span class="text-slate-700 leading-relaxed mt-0.5 block">{{ $staffRequest->instructions }}</span>
                            </div>
                        @endif
                    </div>
                </x-card>

                <!-- Assigned Workers & Shifts -->
                <x-card class="space-y-4">
                    <x-slot:header>
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-user-group class="w-5 h-5 text-[#7B1E3A]" />
                            <h2 class="text-base font-bold text-slate-900">{{ __('Tildelte Vikarer & Vagter') }}</h2>
                        </div>
                    </x-slot:header>

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
                                            <div class="w-8 h-8 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-xs shrink-0">
                                                {{ strtoupper(substr($asgn->worker->user->name ?? 'V', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900">{{ $asgn->worker->user->name ?? __('Vikar') }}</div>
                                                <div class="text-[11px] text-slate-500 flex items-center gap-1">
                                                    <span>{{ __('Tlf:') }} {{ $asgn->worker->user->phone ?? __('Ej oplyst') }}</span>
                                                    <span>&bull;</span>
                                                    <span class="inline-flex items-center gap-0.5">
                                                        <x-heroicon-s-star class="w-3 h-3 text-amber-500" />
                                                        <span>{{ $asgn->worker->rating_avg }} ({{ $asgn->worker->ratings_count }} {{ __('anm.') }})</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <!-- Toggle Favourite Button -->
                                            <form method="POST" action="{{ route('client.workers.toggle-favourite', $asgn->worker) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold border border-amber-300 bg-amber-50 text-amber-800 hover:bg-amber-100 transition shadow-xs">
                                                    <x-heroicon-s-star class="w-3 h-3 text-amber-500" />
                                                    <span>{{ __('Favorit') }}</span>
                                                </button>
                                            </form>

                                            <!-- Rate worker modal button (if completed) -->
                                            <div x-data="{ openRate: false }">
                                                <button type="button" @click="openRate = true" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 transition shadow-xs">
                                                    <x-heroicon-s-star class="w-3 h-3 text-[#C9A24B]" />
                                                    <span>{{ __('Giv bedømmelse') }}</span>
                                                </button>

                                                <!-- Rate Modal -->
                                                <div x-show="openRate" x-cloak class="fixed inset-0 z-50 bg-slate-900/80 flex items-center justify-center p-4">
                                                    <div @click.away="openRate = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left shadow-2xl">
                                                        <h3 class="text-sm font-bold text-slate-900">{{ __('Bedøm') }} {{ $asgn->worker->user->name }}</h3>
                                                        <form method="POST" action="{{ route('client.ratings.store') }}" class="mt-4 space-y-3">
                                                            @csrf
                                                            <input type="hidden" name="worker_id" value="{{ $asgn->worker->id }}">
                                                            <input type="hidden" name="staff_request_id" value="{{ $staffRequest->id }}">
                                                            <input type="hidden" name="shift_id" value="{{ $shift->id }}">

                                                            <div>
                                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Samlet vurdering (1-5 stjerner)') }}</label>
                                                                <select name="rating" required class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                                                    <option value="5">★★★★★ (5 - {{ __('Fremragende') }})</option>
                                                                    <option value="4">★★★★☆ (4 - {{ __('Meget tilfreds') }})</option>
                                                                    <option value="3">★★★☆☆ (3 - {{ __('Tilfredsstillende') }})</option>
                                                                    <option value="2">★★☆☆☆ (2 - {{ __('Under forventning') }})</option>
                                                                    <option value="1">★☆☆☆☆ (1 - {{ __('Utilfredsstillende') }})</option>
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Kommentar') }}</label>
                                                                <textarea name="comment" rows="2" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('F.eks. Mødte til tiden, ydede fantastisk service...') }}"></textarea>
                                                            </div>

                                                            <div class="flex justify-end gap-2 pt-2">
                                                                <button type="button" @click="openRate = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                                                <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#7B1E3A] text-white hover:bg-[#5A1429] shadow-xs">{{ __('Indsend') }}</button>
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
                </x-card>
            </div>

            <!-- Right: Shift Check-in QR Code Card -->
            <div class="space-y-6">
                @if($staffRequest->shifts->isNotEmpty())
                    @php $firstShift = $staffRequest->shifts->first(); @endphp
                    <x-card class="text-center">
                        <div class="inline-flex items-center gap-1.5 text-xs font-bold text-[#7B1E3A] uppercase tracking-wider mb-2">
                            <x-heroicon-o-qr-code class="w-4 h-4 text-[#7B1E3A]" />
                            <span>{{ __('Tjek-ind QR-kode') }}</span>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 mb-3">{{ $firstShift->title }}</h3>

                        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-200 inline-block shadow-inner mb-4">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode(url('/worker/shifts/scan?shift=' . $firstShift->id . '&token=' . $firstShift->qr_secret_token)) }}" alt="Tjek-ind QR Kode" class="mx-auto rounded-lg">
                        </div>

                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ __('Placér denne kode ved jeres indgang. Tildelte vikarer scanner koden med mobilkameraet for at registrere fremmøde.') }}
                        </p>
                    </x-card>
                @endif

                <!-- Support Box -->
                <x-card class="bg-[#FAF5F2] border-[#7B1E3A]/20 space-y-2 text-xs">
                    <div class="font-bold text-[#7B1E3A] flex items-center gap-1.5">
                        <x-heroicon-o-phone class="w-4 h-4 text-[#7B1E3A]" />
                        <span>{{ __('FreyaService Døgnvagt') }}</span>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        {{ __('Har du brug for akutte ændringer eller ekstra mandskab på denne ordre?') }}
                    </p>
                    <div class="pt-2">
                        <a href="tel:+4528260926" class="inline-flex items-center gap-1.5 font-bold text-[#7B1E3A] hover:underline">
                            <x-heroicon-s-phone class="w-3.5 h-3.5" />
                            <span>{{ __('Ring direkte:') }} +45 28 26 09 26</span>
                        </a>
                    </div>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>