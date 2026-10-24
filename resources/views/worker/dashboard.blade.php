<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase
                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800 border border-emerald-200
                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800 border border-amber-200
                        @else bg-rose-100 text-rose-800 border border-rose-200 @endif">
                        {{ $worker->isApproved() ? __('✓ Godkendt Vikar') : __('⏳ Afventer administrationens godkendelse') }}
                    </span>
                    <a href="{{ route('worker.availability.index') }}" title="{{ __('Rediger rådighedskalender') }}" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 transition inline-flex items-center gap-1.5 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ __('Tilgængelig for vagter') }}</span>
                    </a>
                    <span class="text-xs font-semibold text-slate-500">★ {{ $worker->rating_avg }} ({{ $worker->ratings_count }} {{ __('anmeldelser') }})</span>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Velkommen') }}, {{ Auth::user()->name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('By') }}: {{ $worker->city }} • {{ __('Løn') }}: {{ number_format($worker->hourly_rate, 2, ',', '.') }} {{ __('DKK/t') }} • {{ __('Rådighed') }}: {{ $worker->availability_type }}</p>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('worker.offers.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-sm font-bold shadow-xs transition">
                    <span>📋 {{ __('Ledige vagter') }} ({{ $pendingOffers->count() + $openRequests->count() }})</span>
                </a>
                <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white text-sm font-bold shadow-sm transition">
                    <span>📷 {{ __('Scan QR Tjek-ind') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Flash messages -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-semibold">
                {{ session('warning') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <!-- Active Clock-In Live Banner (if worker is currently clocked in) -->
        @if($currentTimesheet)
            <div class="bg-forest-600 text-white rounded-2xl p-6 shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-forest-800 border border-forest-500 text-white text-xs font-bold mb-2 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                        {{ __('Aktiv vagt i gang') }}
                    </span>
                    <h2 class="text-xl font-bold">{{ $currentTimesheet->shift->title ?? __('Vikarvagt') }}</h2>
                    <p class="text-xs text-forest-100 mt-1">
                        {{ __('Kunde') }}: {{ $currentTimesheet->shift->staffRequest->client->company_name ?? '' }} • {{ __('Stemplet ind kl.') }} {{ $currentTimesheet->clock_in->format('H:i') }} ({{ __('Dato') }}: {{ $currentTimesheet->clock_in->format('d.m.Y') }})
                    </p>
                </div>

                <!-- Clock out button & modal -->
                <div x-data="{ openClockOut: false }">
                    <button type="button" @click="openClockOut = true" class="px-5 py-2.5 rounded-xl bg-white text-forest-800 hover:bg-forest-50 font-bold text-sm shadow transition">
                        {{ __('Stempel ud nu') }} &rarr;
                    </button>

                    <!-- Clock out modal -->
                    <div x-show="openClockOut" x-cloak class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
                        <div @click.away="openClockOut = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left text-slate-800 shadow-2xl">
                            <h3 class="text-base font-bold text-slate-900">{{ __('Afslut vagt & Stempel ud') }}</h3>
                            <p class="text-xs text-slate-500 mt-1">{{ __('Angiv eventuel pausetid, før timesedlen sendes til kundens godkendelse.') }}</p>

                            <form method="POST" action="{{ route('worker.shifts.clock-out', $currentTimesheet) }}" class="mt-4 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Afholdt pause (i minutter)') }}</label>
                                    <input type="number" name="break_minutes" min="0" max="240" value="30" required class="w-full text-xs rounded-xl border-slate-300">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Evt. bemærkninger til kunden') }}</label>
                                    <textarea name="notes" rows="2" class="w-full text-xs rounded-xl border-slate-300" placeholder="{{ __('F.eks. Arbejdede 30 min ekstra efter aftale med receptionen...') }}"></textarea>
                                </div>

                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" @click="openClockOut = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                    <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold bg-forest-600 text-white hover:bg-forest-700">{{ __('Bekræft & Stempel ud') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Earnings & Quick Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Optjent denne måned') }}</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ number_format($thisMonthEarnings, 2, ',', '.') }} kr.</span>
                <span class="text-[11px] text-slate-500 mt-1 block">{{ __('Udbetales til din bankkonto') }}</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Udførte timer') }}</span>
                <span class="text-2xl font-black text-brand-secondary mt-1 block">{{ number_format($totalCompletedHours, 1, ',', '.') }} {{ __('timer') }}</span>
                <span class="text-[11px] text-slate-500 mt-1 block">{{ __('Godkendt af kunder') }}</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Nye vagttilbud & ledige vagter') }}</span>
                <span class="text-2xl font-black text-brand-action mt-1 block">{{ $pendingOffers->count() + $openRequests->count() }} {{ __('vagter') }}</span>
                <span class="text-[11px] text-slate-500 mt-1 block"><a href="{{ route('worker.offers.index') }}" class="text-brand-action font-bold hover:underline">{{ __('Se og accepter vagter') }} &rarr;</a></span>
            </div>
        </div>

        <!-- Pending Offers Queue (Direct matches) -->
        @if($pendingOffers->isNotEmpty())
            <div class="bg-white rounded-2xl p-6 border border-action-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-brand-action animate-ping"></span>
                        <span>{{ __('Direkte vagttilbud til dig') }} ({{ $pendingOffers->count() }})</span>
                    </h2>
                    <a href="{{ route('worker.offers.index') }}" class="text-xs font-bold text-brand-secondary hover:text-brand-action transition">{{ __('Se alle') }}</a>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($pendingOffers as $offer)
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <h3 class="text-sm font-bold text-slate-900 capitalize">{{ $offer->staffRequest->role }}</h3>
                                    <span class="text-xs font-black text-emerald-600">{{ number_format($offer->worker_hourly_rate, 2, ',', '.') }} {{ __('kr/t') }}</span>
                                </div>
                                <div class="text-xs text-slate-600 mt-1">
                                    🏢 {{ $offer->staffRequest->client->company_name ?? __('Virksomhed') }}
                                </div>
                                <div class="text-xs text-slate-500 mt-1">
                                    📍 {{ $offer->staffRequest->location }}, {{ $offer->staffRequest->city }}
                                </div>
                                @if($offer->shift)
                                    <div class="text-xs text-indigo-700 font-medium mt-1">
                                        📅 {{ $offer->shift->start_at->format('d. M Y, H:i') }} - {{ $offer->shift->end_at->format('H:i') }}
                                    </div>
                                @endif
                            </div>

                            <div class="pt-2 border-t border-slate-200/60 flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2">
                                <form method="POST" action="{{ route('worker.offers.decline', $offer) }}" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200 transition text-center">
                                        {{ __('Afvis') }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('worker.offers.accept', $offer) }}" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs font-bold bg-brand-action hover:bg-brand-action-hover text-white shadow-sm transition text-center">
                                        {{ __('Accepter vagt') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Open Client Staff Requests Queue -->
        @if($openRequests->isNotEmpty())
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-3 border-b border-slate-100 gap-2">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>{{ __('Åbne vagter oprettet af kunder') }} ({{ $openRequests->count() }})</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Kunder søger vikarer til disse opgaver lige nu. Vælg og accepter en vagt med ét klik.') }}</p>
                    </div>
                    <a href="{{ route('worker.offers.index') }}" class="text-xs font-bold text-brand-secondary hover:text-brand-action transition">{{ __('Se alle ledige vagter') }} &rarr;</a>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($openRequests as $req)
                        @php
                            $isLocal = !empty($worker->city) && !empty($req->city) && (
                                str_contains(mb_strtolower($req->city), mb_strtolower($worker->city)) ||
                                str_contains(mb_strtolower($worker->city), mb_strtolower($req->city))
                            );
                            $openSpots = max(1, $req->workers_needed - ($req->accepted_count ?? 0));
                        @endphp
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 hover:bg-slate-50 hover:border-brand-action/40 transition flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="text-sm font-bold text-slate-900 capitalize">{{ $req->role }}</h3>
                                            @if($isLocal)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">📍 {{ __('I dit område') }}</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-200 text-slate-700">📍 {{ $req->city }}</span>
                                            @endif
                                            @if($req->is_urgent)
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200 uppercase">⚡ {{ __('Akut') }}</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-slate-600 mt-1">
                                            🏢 {{ $req->client->company_name ?? __('Virksomhed') }} &bull; 📍 {{ $req->location }}, {{ $req->city }}
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="text-xs font-black text-emerald-700 block">{{ number_format($req->hourly_rate_offered ?: 245.00, 2, ',', '.') }} {{ __('kr/t') }}</span>
                                        <span class="text-[10px] text-slate-500 font-semibold">{{ $openSpots }} {{ __('ledige pladser') }}</span>
                                    </div>
                                </div>

                                <div class="text-xs text-slate-500 mt-2 space-y-0.5">
                                    <div>
                                        📅 <strong>{{ __('Periode:') }}</strong> {{ $req->start_date->format('d.m.Y') }}@if($req->end_date && $req->end_date->ne($req->start_date)) - {{ $req->end_date->format('d.m.Y') }}@endif
                                        @if($req->start_time) &bull; ⏰ {{ substr($req->start_time, 0, 5) }} - {{ substr($req->end_time, 0, 5) }}@endif
                                    </div>
                                    @if($req->dress_code)
                                        <div class="text-[11px] text-slate-500">👔 {{ __('Dresscode:') }} {{ $req->dress_code }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between gap-2">
                                <span class="text-[11px] text-slate-500 italic">
                                    {{ $req->request_type->label() }}
                                </span>
                                <form method="POST" action="{{ route('worker.offers.claim', $req) }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-action hover:bg-brand-action-hover text-white shadow-sm transition text-center flex items-center gap-1.5">
                                        <span>{{ __('Accepter vagt') }}</span>
                                        <span>&rarr;</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif($pendingOffers->isEmpty())
            <div class="bg-white rounded-2xl p-6 border border-slate-200 text-center py-8 space-y-2">
                <span class="text-2xl block">🎉</span>
                <h3 class="text-sm font-bold text-slate-800">{{ __('Ingen ubesatte vagter lige nu') }}</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto">{{ __('Du har svaret på alle nuværende vagttilbud. Så snart en kunde opretter en ny bemandingsforespørgsel, dukker den op her!') }}</p>
                <div class="pt-2">
                    <a href="{{ route('worker.availability.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-brand-secondary hover:text-brand-action">
                        <span>{{ __('Opdater dine rådighedstider for at få flere matches') }}</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Active Assignments & Today's Schedule -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
            <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">{{ __('Dine accepterede opgaver og vagter') }}</h2>

            @forelse($activeAssignments as $asgn)
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                            <h3 class="text-sm font-bold text-slate-900">{{ $asgn->staffRequest->role }}</h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-200 text-slate-700">{{ $asgn->status->label() }}</span>
                        </div>
                        <div class="text-xs text-slate-600 mt-1">
                            🏢 {{ $asgn->staffRequest->client->company_name ?? __('Kunde') }} • 📍 {{ $asgn->staffRequest->location }}, {{ $asgn->staffRequest->city }}
                        </div>
                        <div class="text-xs text-slate-500 mt-1">
                            {{ __('Periode') }}: {{ $asgn->staffRequest->start_date->format('d.m.Y') }} @if($asgn->staffRequest->end_date) {{ __('til') }} {{ $asgn->staffRequest->end_date->format('d.m.Y') }} @endif
                            @if($asgn->staffRequest->start_time) • {{ __('Mødetid') }}: {{ $asgn->staffRequest->start_time }} @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto text-center px-4 py-2.5 rounded-xl text-xs font-bold bg-sand-100 text-brand-secondary hover:bg-sand-200 transition">
                            📷 {{ __('Tjek ind via QR') }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400 text-xs">
                    {{ __('Du har ingen aktive opgaver i øjeblikket. Tjek') }} <a href="{{ route('worker.offers.index') }}" class="text-brand-action font-bold hover:underline">{{ __('Ledige Vagter') }}</a> {{ __('for at finde nye opgaver.') }}
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
