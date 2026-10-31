<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase
                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800 border border-emerald-200
                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800 border border-amber-200
                        @else bg-rose-100 text-rose-800 border border-rose-200 @endif">
                        @if($worker->isApproved())
                            <x-heroicon-s-check-badge class="w-3.5 h-3.5 text-emerald-600" />
                            <span>{{ __('Godkendt Vikar') }}</span>
                        @else
                            <x-heroicon-o-clock class="w-3.5 h-3.5 text-amber-600" />
                            <span>{{ __('Afventer administrationens godkendelse') }}</span>
                        @endif
                    </span>

                    <a href="{{ route('worker.availability.index') }}" title="{{ __('Rediger rådighedskalender') }}" class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 transition inline-flex items-center gap-1.5 shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ __('Tilgængelig for vagter') }}</span>
                    </a>

                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-ink/70 bg-sand px-2 py-0.5 rounded-md border border-mist">
                        <x-heroicon-s-star class="w-3.5 h-3.5 text-amber-500" />
                        <span>{{ $worker->rating_avg }} ({{ $worker->ratings_count }} {{ __('anmeldelser') }})</span>
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-black text-navy tracking-tight">{{ __('Velkommen') }}, {{ Auth::user()->name }}</h1>
                <p class="text-xs text-ink/70 mt-0.5 flex items-center gap-2 flex-wrap">
                    <span class="inline-flex items-center gap-1">
                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/40" />
                        <span>{{ __('By') }}: <strong>{{ $worker->city }}</strong></span>
                    </span>
                    <span>•</span>
                    <span class="inline-flex items-center gap-1">
                        <x-heroicon-o-banknotes class="w-3.5 h-3.5 text-ink/40" />
                        <span>{{ __('Standardløn') }}: <strong>{{ number_format($worker->hourly_rate, 2, ',', '.') }} {{ __('DKK/t') }}</strong></span>
                    </span>
                    <span>•</span>
                    <span>{{ __('Rådighed') }}: {{ $worker->availability_type }}</span>
                </p>
            </div>

            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <a href="{{ route('worker.offers.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-mist bg-white hover:bg-sand text-navy text-xs font-bold shadow-xs transition">
                    <x-heroicon-o-briefcase class="w-4 h-4 text-burgundy" />
                    <span>{{ __('Ledige vagter') }} ({{ $pendingOffers->count() + $openRequests->count() }})</span>
                </a>
                <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white text-xs font-bold shadow-sm hover:shadow-md transition">
                    <x-heroicon-o-qr-code class="w-4 h-4 text-[#C9A24B]" />
                    <span>{{ __('Scan QR Tjek-ind') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        <!-- Flash messages -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-amber-600 shrink-0" />
                <span>{{ session('warning') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-s-x-circle class="w-5 h-5 text-rose-600 shrink-0" />
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Active Clock-In Live Banner (if worker is currently clocked in) -->
        @if($currentTimesheet)
            <x-card class="bg-forest-600 border-forest-500 text-white shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
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
                        <button type="button" @click="openClockOut = true" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-forest-800 hover:bg-forest-50 font-bold text-sm shadow transition">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4 text-forest-800" />
                            <span>{{ __('Stempel ud nu') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </button>

                        <!-- Clock out modal -->
                        <div x-show="openClockOut" x-cloak class="fixed inset-0 z-50 bg-navy-950/80 flex items-center justify-center p-4">
                            <div @click.away="openClockOut = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left text-ink shadow-2xl">
                                <h3 class="text-base font-bold text-navy">{{ __('Afslut vagt & Stempel ud') }}</h3>
                                <p class="text-xs text-ink/70 mt-1">{{ __('Angiv eventuel pausetid, før timesedlen sendes til kundens godkendelse.') }}</p>

                                <form method="POST" action="{{ route('worker.shifts.clock-out', $currentTimesheet) }}" class="mt-4 space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-navy mb-1">{{ __('Afholdt pause (i minutter)') }}</label>
                                        <input type="number" name="break_minutes" min="0" max="240" value="30" required class="w-full text-xs rounded-xl border-mist">
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-navy mb-1">{{ __('Evt. bemærkninger til kunden') }}</label>
                                        <textarea name="notes" rows="2" class="w-full text-xs rounded-xl border-mist" placeholder="{{ __('F.eks. Arbejdede 30 min ekstra efter aftale med receptionen...') }}"></textarea>
                                    </div>

                                    <div class="flex justify-end gap-2 pt-2">
                                        <button type="button" @click="openClockOut = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-ink/60 hover:bg-sand">{{ __('Annuller') }}</button>
                                        <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold bg-forest-600 text-white hover:bg-forest-700">{{ __('Bekræft & Stempel ud') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        @endif

        <!-- Earnings & Quick Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <x-stat-card
                :label="__('Optjent denne måned')"
                :value="number_format($thisMonthEarnings, 2, ',', '.') . ' kr.'"
                :sublabel="__('Udbetales til din bankkonto')"
                icon="banknotes"
                accent="burgundy"
            />

            <x-stat-card
                :label="__('Udførte timer')"
                :value="number_format($totalCompletedHours, 1, ',', '.') . ' ' . __('timer')"
                :sublabel="__('Godkendt af kunder')"
                icon="clock"
                accent="navy"
            />

            <x-stat-card
                :label="__('Nye vagttilbud & ledige vagter')"
                :value="($pendingOffers->count() + $openRequests->count()) . ' ' . __('vagter')"
                :sublabel="__('Se og accepter vagter')"
                :href="route('worker.offers.index')"
                icon="briefcase"
                accent="teal"
            />
        </div>

        <!-- Pending Offers Queue (Direct matches) -->
        @if($pendingOffers->isNotEmpty())
            <x-card variant="white" class="border-burgundy/30 space-y-4">
                <x-slot:header>
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0">
                                <x-heroicon-s-sparkles class="w-4 h-4 text-burgundy" />
                            </div>
                            <h2 class="text-base font-bold text-navy flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-burgundy animate-ping"></span>
                                <span>{{ __('Direkte vagttilbud til dig') }} ({{ $pendingOffers->count() }})</span>
                            </h2>
                        </div>
                        <a href="{{ route('worker.offers.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-burgundy hover:text-burgundy-dark transition">
                            <span>{{ __('Se alle') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </x-slot:header>

                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($pendingOffers as $offer)
                        <x-card variant="sand" hover="true" class="flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <h3 class="text-sm font-bold text-navy capitalize">{{ $offer->staffRequest->role }}</h3>
                                    <span class="text-xs font-black text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">{{ number_format($offer->worker_hourly_rate, 2, ',', '.') }} {{ __('kr/t') }}</span>
                                </div>
                                <div class="text-xs text-ink/75 mt-1.5 space-y-1">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                        <span>{{ $offer->staffRequest->client->company_name ?? __('Virksomhed') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                        <span>{{ $offer->staffRequest->location }}, {{ $offer->staffRequest->city }}</span>
                                    </div>
                                </div>
                                @if($offer->shift)
                                    <div class="text-xs text-burgundy font-semibold mt-2 flex items-center gap-1.5 bg-white p-2 rounded-lg border border-mist">
                                        <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-burgundy shrink-0" />
                                        <span>{{ $offer->shift->start_at->format('d. M Y, H:i') }} - {{ $offer->shift->end_at->format('H:i') }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-2 border-t border-mist flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2">
                                <form method="POST" action="{{ route('worker.offers.decline', $offer) }}" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-xl text-xs font-semibold text-ink/60 hover:bg-white hover:text-navy transition text-center border border-transparent hover:border-mist cursor-pointer">
                                        {{ __('Afvis') }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('worker.offers.accept', $offer) }}" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl text-xs font-bold bg-burgundy hover:bg-burgundy-dark text-white shadow-xs transition text-center cursor-pointer">
                                        <x-heroicon-s-check class="w-3.5 h-3.5" />
                                        <span>{{ __('Accepter vagt') }}</span>
                                    </button>
                                </form>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            </x-card>
        @endif

        <!-- Open Client Staff Requests Queue -->
        @if($openRequests->isNotEmpty())
            <x-card variant="white" class="space-y-4">
                <x-slot:header>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 w-full">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                                <x-heroicon-o-sparkles class="w-4 h-4 text-emerald-700" />
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-navy flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>{{ __('Åbne vagter oprettet af kunder') }} ({{ $openRequests->count() }})</span>
                                </h2>
                                <p class="text-xs text-ink/60 mt-0.5">{{ __('Kunder søger vikarer til disse opgaver lige nu. Vælg og accepter en vagt med ét klik.') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('worker.offers.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-burgundy hover:text-burgundy-dark transition">
                            <span>{{ __('Se alle ledige vagter') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </x-slot:header>

                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($openRequests as $req)
                        @php
                            $isLocal = !empty($worker->city) && !empty($req->city) && (
                                str_contains(mb_strtolower($req->city), mb_strtolower($worker->city)) ||
                                str_contains(mb_strtolower($worker->city), mb_strtolower($req->city))
                            );
                            $openSpots = max(1, $req->workers_needed - ($req->accepted_count ?? 0));
                        @endphp
                        <x-card variant="sand" hover="true" class="flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h3 class="text-sm font-bold text-navy capitalize">{{ $req->role }}</h3>
                                            @if($isLocal)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    <x-heroicon-o-map-pin class="w-3 h-3 text-emerald-600" />
                                                    <span>{{ __('I dit område') }}</span>
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-sand text-ink/70 border border-mist">
                                                    <x-heroicon-o-map-pin class="w-3 h-3 text-ink/40" />
                                                    <span>{{ $req->city }}</span>
                                                </span>
                                            @endif
                                            @if($req->is_urgent)
                                                <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200 uppercase">
                                                    <x-heroicon-s-bolt class="w-3 h-3 text-rose-600" />
                                                    <span>{{ __('Akut') }}</span>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-ink/70 mt-1 flex items-center gap-1.5 flex-wrap">
                                            <span class="inline-flex items-center gap-1">
                                                <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-ink/40" />
                                                <span>{{ $req->client->company_name ?? __('Virksomhed') }}</span>
                                            </span>
                                            <span>•</span>
                                            <span>{{ $req->location }}, {{ $req->city }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="text-xs font-black text-emerald-700 block">{{ number_format($req->hourly_rate_offered ?: 245.00, 2, ',', '.') }} {{ __('kr/t') }}</span>
                                        <span class="text-[10px] text-ink/60 font-semibold">{{ $openSpots }} {{ __('ledige pladser') }}</span>
                                    </div>
                                </div>

                                <div class="text-xs text-ink/70 mt-2 bg-white p-2.5 rounded-xl border border-mist space-y-1">
                                    <div class="flex items-center gap-1.5">
                                        <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                        <span><strong>{{ __('Periode:') }}</strong> {{ $req->start_date->format('d.m.Y') }}@if($req->end_date && $req->end_date->ne($req->start_date)) - {{ $req->end_date->format('d.m.Y') }}@endif</span>
                                    </div>
                                    @if($req->start_time)
                                        <div class="flex items-center gap-1.5">
                                            <x-heroicon-o-clock class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                            <span>{{ substr($req->start_time, 0, 5) }} - {{ substr($req->end_time, 0, 5) }}</span>
                                        </div>
                                    @endif
                                    @if($req->dress_code)
                                        <div class="text-[11px] text-ink/60 flex items-center gap-1 pt-0.5">
                                            <x-heroicon-o-sparkles class="w-3 h-3 text-[#C9A24B]" />
                                            <span>{{ __('Dresscode:') }} {{ $req->dress_code }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-2 border-t border-mist flex items-center justify-between gap-2">
                                <span class="text-[11px] text-ink/60 italic">
                                    {{ $req->request_type->label() }}
                                </span>
                                <form method="POST" action="{{ route('worker.offers.claim', $req) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 rounded-xl text-xs font-bold bg-burgundy hover:bg-burgundy-dark text-white shadow-xs transition text-center cursor-pointer">
                                        <span>{{ __('Accepter vagt') }}</span>
                                        <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                                    </button>
                                </form>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            </x-card>
        @elseif($pendingOffers->isEmpty())
            <x-card variant="white" class="text-center py-10 space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-burgundy/10 text-burgundy flex items-center justify-center mx-auto border border-burgundy/20">
                    <x-heroicon-o-check-badge class="w-6 h-6 text-burgundy" />
                </div>
                <h3 class="text-sm font-bold text-navy">{{ __('Ingen ubesatte vagter lige nu') }}</h3>
                <p class="text-xs text-ink/70 max-w-md mx-auto leading-relaxed">{{ __('Du har svaret på alle nuværende vagttilbud. Så snart en kunde opretter en ny bemandingsforespørgsel, dukker den op her!') }}</p>
                <div class="pt-2">
                    <a href="{{ route('worker.availability.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-burgundy hover:text-burgundy-dark transition">
                        <span>{{ __('Opdater dine rådighedstider for at få flere matches') }}</span>
                        <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                    </a>
                </div>
            </x-card>
        @endif

        <!-- Active Assignments & Today's Schedule -->
        <x-card variant="white" class="space-y-4">
            <x-slot:header>
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-navy/10 text-navy flex items-center justify-center shrink-0">
                        <x-heroicon-o-calendar-days class="w-4 h-4 text-navy" />
                    </div>
                    <h2 class="text-base font-bold text-navy">{{ __('Dine accepterede opgaver og vagter') }}</h2>
                </div>
            </x-slot:header>

            @forelse($activeAssignments as $asgn)
                <div class="p-4 rounded-xl border border-mist bg-brand-surface/30 hover:bg-brand-surface/70 transition flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                            <h3 class="text-sm font-bold text-navy">{{ $asgn->staffRequest->role }}</h3>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-sand text-ink/70 border border-mist">{{ $asgn->status->label() }}</span>
                        </div>
                        <div class="text-xs text-ink/70 flex items-center gap-2 flex-wrap">
                            <span class="inline-flex items-center gap-1">
                                <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-ink/40" />
                                <strong>{{ $asgn->staffRequest->client->company_name ?? __('Kunde') }}</strong>
                            </span>
                            <span>•</span>
                            <span class="inline-flex items-center gap-1">
                                <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/40" />
                                <span>{{ $asgn->staffRequest->location }}, {{ $asgn->staffRequest->city }}</span>
                            </span>
                        </div>
                        <div class="text-xs text-ink/60 flex items-center gap-2">
                            <span class="inline-flex items-center gap-1">
                                <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-ink/40" />
                                <span>{{ __('Periode') }}: {{ $asgn->staffRequest->start_date->format('d.m.Y') }} @if($asgn->staffRequest->end_date) {{ __('til') }} {{ $asgn->staffRequest->end_date->format('d.m.Y') }} @endif</span>
                            </span>
                            @if($asgn->staffRequest->start_time)
                                <span>•</span>
                                <span>{{ __('Mødetid') }}: {{ $asgn->staffRequest->start_time }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold bg-burgundy hover:bg-burgundy-dark text-white shadow-xs transition">
                            <x-heroicon-o-qr-code class="w-4 h-4 text-[#C9A24B]" />
                            <span>{{ __('Tjek ind via QR') }}</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-ink/50 text-xs space-y-1">
                    <div>{{ __('Du har ingen aktive opgaver i øjeblikket.') }}</div>
                    <div>
                        <a href="{{ route('worker.offers.index') }}" class="text-burgundy font-bold hover:underline inline-flex items-center gap-1">
                            <span>{{ __('Tjek Ledige Vagter for at finde nye opgaver') }}</span>
                            <x-heroicon-o-arrow-right class="w-3 h-3" />
                        </a>
                    </div>
                </div>
            @endforelse
        </x-card>

    </div>
</x-app-layout>
