<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-burgundy/10 text-burgundy border border-burgundy/20">
                        {{ __('Vagtbørs') }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-navy tracking-tight">{{ __('Ledige Vagter & Tilbud') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('Vagter matchet til dine færdigheder og lokalområde.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-mist bg-white text-xs font-bold text-ink/70 hover:text-navy hover:bg-sand shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="p-4 rounded-xl bg-sand border border-mist text-ink text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-o-information-circle class="w-5 h-5 text-burgundy shrink-0" />
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Direct Offers Section -->
        <x-card variant="white" class="space-y-4">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 w-full">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0">
                            <x-heroicon-s-sparkles class="w-4 h-4 text-burgundy" />
                        </div>
                        <h2 class="text-base font-bold text-navy flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-burgundy animate-pulse"></span>
                            <span>{{ __('Direkte tildelte vagttilbud') }} ({{ $directOffers->count() }})</span>
                        </h2>
                    </div>
                    <span class="text-xs text-ink/60">{{ __('Ventende på din accept') }}</span>
                </div>
            </x-slot:header>

            <div class="space-y-4">
                @forelse($directOffers as $offer)
                    <x-card variant="sand" hover="true" class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-1.5 flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-burgundy/10 text-burgundy border border-burgundy/20">{{ __('Direkte tilbud') }}</span>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#C9A24B]/15 text-[#8C6C27] border border-[#C9A24B]/30">
                                    <x-heroicon-s-check-badge class="w-3.5 h-3.5 text-[#C9A24B]" />
                                    <span>{{ $offer->staffRequest->client->company_name ?? __('Registreret virksomhed') }}</span>
                                </span>
                                <h3 class="text-base font-bold text-navy">{{ $offer->staffRequest->role }}</h3>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-ink/75 flex-wrap">
                                <span class="inline-flex items-center gap-1 font-semibold text-navy">
                                    <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-burgundy shrink-0" />
                                    <span>{{ $offer->staffRequest->client->company_name ?? __('Virksomhed') }}</span>
                                </span>
                                <span>•</span>
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                    <span>{{ $offer->staffRequest->location }}, {{ $offer->staffRequest->city }}</span>
                                </span>
                            </div>
                            @if($offer->shift)
                                <div class="text-xs text-navy font-semibold flex items-center gap-1.5 bg-white p-2 rounded-lg border border-mist">
                                    <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-burgundy shrink-0" />
                                    <span>{{ $offer->shift->start_at->format('d. M Y, H:i') }} - {{ $offer->shift->end_at->format('H:i') }} ({{ $offer->shift->duration_hours }} {{ __('timer') }})</span>
                                </div>
                            @endif
                            <div class="text-xs text-ink/70">
                                {{ __('Tilbudt timeløn:') }} <strong class="text-emerald-700 font-bold text-sm">{{ number_format($offer->worker_hourly_rate, 2, ',', '.') }} kr/t</strong>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto shrink-0">
                            <form method="POST" action="{{ route('worker.offers.decline', $offer) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-4 py-2 rounded-xl text-xs font-semibold text-ink/60 hover:bg-white hover:text-navy transition border border-transparent hover:border-mist cursor-pointer">
                                    {{ __('Afvis') }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('worker.offers.accept', $offer) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-5 py-2.5 rounded-xl text-xs font-bold bg-burgundy hover:bg-burgundy-dark text-white shadow-xs transition cursor-pointer">
                                    <x-heroicon-s-check class="w-3.5 h-3.5" />
                                    <span>{{ __('Accepter Vagt') }}</span>
                                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                                </button>
                            </form>
                        </div>
                    </x-card>
                @empty
                    <div class="text-center py-8 text-ink/50 text-xs">
                        {{ __('Du har ingen afventende direkte tilbud lige nu.') }}
                    </div>
                @endforelse
            </div>
        </x-card>

        <!-- Open Client Requests Section -->
        @php
            $uniqueCompanies = $openRequests->map(fn($r) => $r->client->company_name ?? null)->filter()->unique()->values();
        @endphp
        <x-card variant="white" class="space-y-4">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 w-full">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0">
                            <x-heroicon-o-building-office-2 class="w-4 h-4 text-emerald-700" />
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                @if($uniqueCompanies->count() === 1)
                                    <span>{{ __('Ledige vagter fra') }} {{ $uniqueCompanies->first() }} ({{ $openRequests->count() }})</span>
                                @else
                                    <span>{{ __('Ledige vagter fra registrerede virksomheder') }} ({{ $openRequests->count() }})</span>
                                @endif
                            </h2>
                            <p class="text-xs text-ink/60 mt-0.5">
                                @if($uniqueCompanies->count() === 1)
                                    {{ __('Registreret virksomhed:') }} <strong class="text-navy">{{ $uniqueCompanies->first() }}</strong>. {{ __('Søger vikarer til disse opgaver lige nu. Vælg og accepter en vagt for at reservere din plads med det samme.') }}
                                @else
                                    {{ __('Registrerede virksomheder søger personale til disse opgaver lige nu. Vælg og accepter en vagt for at reservere din plads med det samme.') }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-sand text-ink/70 font-bold border border-mist">
                            <x-heroicon-o-map-pin class="w-3 h-3 text-ink/40" />
                            <span>{{ __('By') }}: {{ $worker->city ?: __('Hele Danmark') }}</span>
                        </span>
                    </div>
                </div>
            </x-slot:header>

            <div class="space-y-4">
                @forelse($openRequests as $req)
                    @php
                        $isLocal = !empty($worker->city) && !empty($req->city) && (
                            str_contains(mb_strtolower($req->city), mb_strtolower($worker->city)) ||
                            str_contains(mb_strtolower($worker->city), mb_strtolower($req->city))
                        );
                        $openSpots = max(1, $req->workers_needed - ($req->accepted_count ?? 0));
                    @endphp
                    <x-card variant="sand" hover="true" class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-2 flex-1">
                            <!-- Prominent Registered Company Badge -->
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-burgundy/10 text-burgundy border border-burgundy/20">
                                    <x-heroicon-s-check-badge class="w-3.5 h-3.5 text-[#C9A24B]" />
                                    <span>{{ __('Registreret virksomhed:') }} <strong>{{ $req->client->company_name ?? __('Registreret virksomhed') }}</strong></span>
                                </span>
                                @if(!empty($req->client->cvr))
                                    <span class="text-[10px] text-ink/60 font-semibold bg-white px-2 py-0.5 rounded border border-mist">
                                        CVR: {{ $req->client->cvr }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-base font-bold text-navy capitalize">{{ $req->role }}</h3>
                                @if($isLocal)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <x-heroicon-o-map-pin class="w-3 h-3 text-emerald-600" />
                                        <span>{{ __('I dit lokalområde') }}</span>
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
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-white text-navy border border-mist">
                                    {{ $openSpots }} {{ __('ledige pladser ud af') }} {{ $req->workers_needed }}
                                </span>
                            </div>

                            <div class="text-xs text-ink/75 flex items-center gap-2 flex-wrap">
                                <span class="inline-flex items-center gap-1 font-semibold text-navy">
                                    <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-burgundy shrink-0" />
                                    <span>{{ $req->client->company_name ?? __('Virksomhed') }}</span>
                                </span>
                                <span>•</span>
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                    <span>{{ $req->location }}, {{ $req->postcode }} {{ $req->city }}</span>
                                </span>
                            </div>

                            <div class="text-xs text-navy font-medium flex flex-wrap items-center gap-2">
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-burgundy shrink-0" />
                                    <span>{{ $req->start_date->format('d. M Y') }}@if($req->end_date && $req->end_date->ne($req->start_date)) - {{ $req->end_date->format('d. M Y') }}@endif</span>
                                </span>
                                @if($req->start_time)
                                    <span>•</span>
                                    <span>{{ substr($req->start_time, 0, 5) }} - {{ substr($req->end_time, 0, 5) }}</span>
                                @endif
                                <span>•</span>
                                <span class="text-ink/60">{{ $req->request_type->label() }}</span>
                            </div>

                            @if($req->instructions || $req->dress_code)
                                <div class="text-xs text-ink/70 bg-white p-2.5 rounded-xl border border-mist space-y-1">
                                    @if($req->dress_code)
                                        <div class="flex items-center gap-1">
                                            <x-heroicon-o-sparkles class="w-3 h-3 text-[#C9A24B]" />
                                            <span><strong>{{ __('Dresscode:') }}</strong> {{ $req->dress_code }}</span>
                                        </div>
                                    @endif
                                    @if($req->instructions)
                                        <div class="flex items-start gap-1">
                                            <x-heroicon-o-document-text class="w-3 h-3 text-ink/40 mt-0.5 shrink-0" />
                                            <span><strong>{{ __('Instruktioner:') }}</strong> {{ $req->instructions }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="text-xs text-ink/70">
                                {{ __('Tilbudt timeløn:') }} <strong class="text-emerald-700 font-bold text-sm">{{ number_format($req->hourly_rate_offered ?: 245.00, 2, ',', '.') }} kr/t</strong>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto shrink-0 border-t md:border-t-0 pt-3 md:pt-0 border-mist">
                            <form method="POST" action="{{ route('worker.offers.claim', $req) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-6 py-3 rounded-xl text-xs font-bold bg-burgundy hover:bg-burgundy-dark text-white shadow-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                                    <span>{{ __('Accepter Vagt') }}</span>
                                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                                </button>
                            </form>
                        </div>
                    </x-card>
                @empty
                    <div class="text-center py-10 text-ink/50 text-xs space-y-2">
                        <div class="w-10 h-10 rounded-xl bg-sand flex items-center justify-center mx-auto text-ink/40 border border-mist">
                            <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                        </div>
                        <div class="font-bold text-navy">{{ __('Ingen ledige vagter lige nu.') }}</div>
                        <div>{{ __('Så snart en virksomhed opretter en ny bemandingsforespørgsel, vil den fremgå her.') }}</div>
                    </div>
                @endforelse
            </div>
        </x-card>

    </div>
</x-app-layout>
