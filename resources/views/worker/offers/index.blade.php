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
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-6 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 pb-3 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    <span>{{ __('Direkte tildelte vagttilbud') }} ({{ $directOffers->count() }})</span>
                </h2>
                <span class="text-xs text-slate-500">{{ __('Ventende på din accept') }}</span>
            </div>

            <div class="space-y-4">
                @forelse($directOffers as $offer)
                    <div class="p-4 sm:p-5 rounded-xl border border-slate-200 bg-slate-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
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
                    </div>
                @empty
                    <div class="text-center py-6 text-slate-400 text-xs">
                        {{ __('Du har ingen afventende direkte tilbud lige nu.') }}
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Open Opportunities in City -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
            <div class="pb-3 border-b border-slate-100">
                <h2 class="text-base font-bold text-slate-900">{{ __('Åbne forespørgsler i') }} {{ $worker->city ?: __('dit område') }}</h2>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Kunder der søger personale inden for dine fagområder.') }}</p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                @forelse($openRequests as $req)
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="text-sm font-bold text-slate-900">{{ $req->role }}</h3>
                                @if($req->is_urgent)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-800 uppercase">⚡ {{ __('Akut') }}</span>
                                @endif
                            </div>
                            <div class="text-xs text-slate-600 mt-1">
                                🏢 {{ $req->client->company_name ?? '' }} • 📍 {{ $req->city }}
                            </div>
                            <div class="text-xs text-slate-500 mt-1">
                                {{ __('Start:') }} {{ $req->start_date->format('d.m.Y') }} • {{ $req->request_type->label() }}
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-200 text-right">
                            <span class="text-xs text-slate-400 italic">{{ __('Administrationen koordinerer tildeling') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 text-center py-6 text-slate-400 text-xs">
                        {{ __('Ingen andre åbne forespørgsler i området i dag.') }}
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
