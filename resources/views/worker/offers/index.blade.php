<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Ledige Vagter & Tilbud') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Vagter matchet til dine færdigheder og lokalområde.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('info'))
            <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-semibold">
                {{ session('info') }}
            </div>
        @endif

        <!-- Direct Offers Section -->
        <x-card class="space-y-4">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 w-full">
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span>{{ __('Direkte tildelte vagttilbud') }} ({{ $directOffers->count() }})</span>
                    </h2>
                    <span class="text-xs text-slate-500">{{ __('Ventende på din accept') }}</span>
                </div>
            </x-slot:header>

            <div class="space-y-4">
                @forelse($directOffers as $offer)
                    <x-card variant="sand" hover="true" class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-amber-100 text-amber-800">{{ __('Direkte tilbud') }}</span>
                                <h3 class="text-base font-bold text-slate-900">{{ $offer->staffRequest->role }}</h3>
                            </div>
                            <div class="text-xs text-slate-600">
                                🏢 {{ $offer->staffRequest->client->company_name ?? __('Virksomhed') }} &bull;
                                📍 {{ $offer->staffRequest->location }}, {{ $offer->staffRequest->city }}
                            </div>
                            @if($offer->shift)
                                <div class="text-xs text-indigo-700 font-semibold">
                                    📅 {{ $offer->shift->start_at->format('d. M Y, H:i') }} - {{ $offer->shift->end_at->format('H:i') }} ({{ $offer->shift->duration_hours }} {{ __('timer') }})
                                </div>
                            @endif
                            <div class="text-xs text-slate-500">
                                {{ __('Tilbudt timeløn:') }} <strong class="text-emerald-700 font-bold text-sm">{{ number_format($offer->worker_hourly_rate, 2, ',', '.') }} kr/t</strong>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto">
                            <form method="POST" action="{{ route('worker.offers.decline', $offer) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200 transition">
                                    {{ __('Afvis') }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('worker.offers.accept', $offer) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-700 text-white shadow-md transition">
                                    {{ __('Accepter Vagt') }} &rarr;
                                </button>
                            </form>
                        </div>
                    </x-card>
                @empty
                    <div class="text-center py-6 text-slate-400 text-xs">
                        {{ __('Du har ingen afventende direkte tilbud lige nu.') }}
                    </div>
                @endforelse
            </div>
        </x-card>

        <!-- Open Client Requests Section -->
        <x-card class="space-y-4">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 w-full">
                    <div>
                        <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>{{ __('Ledige vagter oprettet af kunder') }} ({{ $openRequests->count() }})</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Kunder søger vikarer til disse opgaver lige nu. Vælg og accepter en vagt for at reservere din plads med det samme.') }}</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 font-bold border border-emerald-200">
                            {{ __('By') }}: {{ $worker->city ?: __('Hele Danmark') }}
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
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-base font-bold text-slate-900 capitalize">{{ $req->role }}</h3>
                                @if($isLocal)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">📍 {{ __('I dit lokalområde') }}</span>
                                @else
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-200 text-slate-700">📍 {{ $req->city }}</span>
                                @endif
                                @if($req->is_urgent)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200 uppercase">⚡ {{ __('Akut') }}</span>
                                @endif
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $openSpots }} {{ __('ledige pladser ud af') }} {{ $req->workers_needed }}
                                </span>
                            </div>

                            <div class="text-xs text-slate-600">
                                🏢 <strong>{{ $req->client->company_name ?? __('Virksomhed') }}</strong> &bull;
                                📍 {{ $req->location }}, {{ $req->postcode }} {{ $req->city }}
                            </div>

                            <div class="text-xs text-indigo-700 font-semibold flex flex-wrap items-center gap-2">
                                <span>📅 {{ __('Dato:') }} {{ $req->start_date->format('d. M Y') }}@if($req->end_date && $req->end_date->ne($req->start_date)) - {{ $req->end_date->format('d. M Y') }}@endif</span>
                                @if($req->start_time)
                                    <span>&bull; ⏰ {{ substr($req->start_time, 0, 5) }} - {{ substr($req->end_time, 0, 5) }}</span>
                                @endif
                                <span>&bull; {{ $req->request_type->label() }}</span>
                            </div>

                            @if($req->instructions || $req->dress_code)
                                <div class="text-xs text-slate-500 bg-white p-2.5 rounded-lg border border-slate-200/80 space-y-1">
                                    @if($req->dress_code)
                                        <div>👔 <strong>{{ __('Dresscode:') }}</strong> {{ $req->dress_code }}</div>
                                    @endif
                                    @if($req->instructions)
                                        <div>📝 <strong>{{ __('Instruktioner:') }}</strong> {{ $req->instructions }}</div>
                                    @endif
                                </div>
                            @endif

                            <div class="text-xs text-slate-500">
                                {{ __('Tilbudt timeløn:') }} <strong class="text-emerald-700 font-bold text-sm">{{ number_format($req->hourly_rate_offered ?: 245.00, 2, ',', '.') }} kr/t</strong>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full md:w-auto shrink-0">
                            <form method="POST" action="{{ route('worker.offers.claim', $req) }}" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto text-center px-6 py-3 rounded-xl text-xs font-bold bg-brand-action hover:bg-brand-action-hover text-white shadow-md transition flex items-center justify-center gap-1.5">
                                    <span>{{ __('Accepter Vagt') }}</span>
                                    <span>&rarr;</span>
                                </button>
                            </form>
                        </div>
                    </x-card>
                @empty
                    <div class="text-center py-8 text-slate-400 text-xs space-y-2">
                        <span class="text-2xl block">🔍</span>
                        <div class="font-bold text-slate-600">{{ __('Ingen ledige vagter lige nu.') }}</div>
                        <div>{{ __('Så snart en virksomhed opretter en ny bemandingsforespørgsel, vil den fremgå her.') }}</div>
                    </div>
                @endforelse
            </div>
        </x-card>

    </div>
</x-app-layout>
