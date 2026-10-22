<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase
                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800 border border-emerald-200
                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800 border border-amber-200
                        @else bg-rose-100 text-rose-800 border border-rose-200 @endif">
                        {{ $worker->isApproved() ? __('✓ Godkendt Vikar') : __('⏳ Afventer administrationens godkendelse') }}
                    </span>
                    <span class="text-xs font-semibold text-slate-500">★ {{ $worker->rating_avg }} ({{ $worker->ratings_count }} {{ __('anmeldelser') }})</span>
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Velkommen') }}, {{ Auth::user()->name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('By') }}: {{ $worker->city }} • {{ __('Løn') }}: {{ number_format($worker->hourly_rate, 2, ',', '.') }} {{ __('DKK/t') }} • {{ __('Rådighed') }}: {{ $worker->availability_type }}</p>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-sm transition">
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
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white rounded-2xl p-6 shadow-xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/20 text-white text-xs font-bold mb-2">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                        {{ __('Aktiv vagt i gang') }}
                    </span>
                    <h2 class="text-xl font-bold">{{ $currentTimesheet->shift->title ?? __('Vikarvagt') }}</h2>
                    <p class="text-xs text-emerald-100 mt-1">
                        {{ __('Kunde') }}: {{ $currentTimesheet->shift->staffRequest->client->company_name ?? '' }} • {{ __('Stemplet ind kl.') }} {{ $currentTimesheet->clock_in->format('H:i') }} ({{ __('Dato') }}: {{ $currentTimesheet->clock_in->format('d.m.Y') }})
                    </p>
                </div>

                <!-- Clock out button & modal -->
                <div x-data="{ openClockOut: false }">
                    <button type="button" @click="openClockOut = true" class="px-5 py-2.5 rounded-xl bg-white text-emerald-800 hover:bg-emerald-50 font-bold text-sm shadow transition">
                        {{ __('Stempel ud nu') }} &rarr;
                    </button>

                    <!-- Clock out modal -->
                    <div x-show="openClockOut" x-cloak class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
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
                                    <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold bg-emerald-600 text-white hover:bg-emerald-700">{{ __('Bekræft & Stempel ud') }}</button>
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
                <span class="text-2xl font-black text-indigo-600 mt-1 block">{{ number_format($totalCompletedHours, 1, ',', '.') }} {{ __('timer') }}</span>
                <span class="text-[11px] text-slate-500 mt-1 block">{{ __('Godkendt af kunder') }}</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ __('Nye vagttilbud') }}</span>
                <span class="text-2xl font-black text-amber-500 mt-1 block">{{ $pendingOffers->count() }} {{ __('tilbud') }}</span>
                <span class="text-[11px] text-slate-500 mt-1 block"><a href="{{ route('worker.offers.index') }}" class="text-indigo-600 font-bold hover:underline">{{ __('Se og accepter vagter') }} &rarr;</a></span>
            </div>
        </div>

        <!-- Pending Offers Queue -->
        @if($pendingOffers->isNotEmpty())
            <div class="bg-white rounded-2xl p-6 border border-amber-200 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping"></span>
                        <span>{{ __('Vagttilbud til dig') }} ({{ $pendingOffers->count() }})</span>
                    </h2>
                    <a href="{{ route('worker.offers.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">{{ __('Se alle') }}</a>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($pendingOffers as $offer)
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <h3 class="text-sm font-bold text-slate-900">{{ $offer->staffRequest->role }}</h3>
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
                                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm transition text-center">
                                        {{ __('Accepter vagt') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
                        <a href="{{ route('worker.shifts.scan') }}" class="w-full sm:w-auto text-center px-4 py-2.5 rounded-xl text-xs font-bold bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">
                            📷 {{ __('Tjek ind via QR') }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400 text-xs">
                    {{ __('Du har ingen aktive opgaver i øjeblikket. Tjek') }} <a href="{{ route('worker.offers.index') }}" class="text-indigo-600 font-bold hover:underline">{{ __('Ledige Vagter') }}</a> {{ __('for at finde nye opgaver.') }}
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
