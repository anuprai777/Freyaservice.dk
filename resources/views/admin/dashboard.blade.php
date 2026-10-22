<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Administration & Vagtstyring') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('FreyaService Backoffice • Live overvågning af kunder, vikarer og bemanding.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.requests.index') }}" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                    {{ __('Gennemgå forespørgsler') }} &rarr;
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- KPI Metrics Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Nye ordrer') }}</span>
                <span class="text-2xl font-black text-amber-500 mt-1 block">{{ $newRequestsCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Afventer match') }}</span>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Under behandling') }}</span>
                <span class="text-2xl font-black text-indigo-600 mt-1 block">{{ $inProgressRequestsCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Tilbud sendt') }}</span>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Aktive vagter') }}</span>
                <span class="text-2xl font-black text-emerald-600 mt-1 block">{{ $activeShiftsCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Besat / I gang') }}</span>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Nye vikarer') }}</span>
                <span class="text-2xl font-black text-slate-900 mt-1 block">{{ $pendingWorkersCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Afventer godkendelse') }}</span>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Dokumenter') }}</span>
                <span class="text-2xl font-black text-purple-600 mt-1 block">{{ $pendingDocumentsCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Klar til verifikation') }}</span>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">{{ __('Timesedler') }}</span>
                <span class="text-2xl font-black text-blue-600 mt-1 block">{{ $unapprovedTimesheetsCount }}</span>
                <span class="text-[10px] text-slate-500 block">{{ __('Afventer kundegodkendelse') }}</span>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">

            <!-- Recent Staff Requests requiring matching -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <div>
                            <h2 class="text-base font-bold text-slate-900">{{ __('Seneste bemandingsforespørgsler') }}</h2>
                            <p class="text-xs text-slate-500 mt-0.5">{{ __('Prioriterede opgaver fra virksomheder.') }}</p>
                        </div>
                        <a href="{{ route('admin.requests.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">{{ __('Se alle') }} &rarr;</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentRequests as $req)
                            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 hover:bg-slate-50 transition flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $req->status->badgeClasses() }}">
                                            {{ $req->status->label() }}
                                        </span>
                                        @if($req->is_urgent)
                                            <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">⚡ {{ __('AKUT') }}</span>
                                        @endif
                                        <h3 class="font-bold text-sm text-slate-900">{{ $req->role }}</h3>
                                    </div>
                                    <div class="text-xs text-slate-600 mt-1">
                                        🏢 {{ $req->client->company_name ?? __('Kunde') }} &bull; 📍 {{ $req->city }} &bull; 👥 {{ $req->workers_needed }} {{ __('vikar(er)') }}
                                    </div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        {{ __('Dato') }}: {{ $req->start_date->format('d.m.Y') }} &bull; {{ $req->request_type->label() }}
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.matching.show', $req) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                                        🎯 {{ __('Match Vikarer') }}
                                    </a>
                                    <a href="{{ route('admin.requests.show', $req) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-700 font-semibold text-xs hover:bg-slate-50 transition">
                                        {{ __('Vis') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">{{ __('Ingen aktive forespørgsler.') }}</div>
                        @endforelse
                    </div>
                </div>

                <!-- Expiring Documents Alert Box -->
                @if($expiringDocuments->isNotEmpty())
                    <div class="bg-amber-50/60 rounded-2xl border border-amber-200 p-6 space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">⚠️</span>
                            <div>
                                <h3 class="text-sm font-bold text-amber-900">{{ __('Udløbende dokumenter og arbejdstilladelser') }}</h3>
                                <p class="text-xs text-amber-700">{{ __('Følgende dokumenter udløber inden for de næste 30 dage og kræver opfølgning:') }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($expiringDocuments as $expDoc)
                                <div class="p-3 bg-white rounded-xl border border-amber-200 flex justify-between items-center text-xs">
                                    <div>
                                        <span class="font-bold text-slate-900">{{ $expDoc->workerProfile->user->name ?? __('Vikar') }}</span>
                                        <span class="text-slate-500">({{ $expDoc->type->label() }})</span>
                                    </div>
                                    <div class="text-rose-600 font-bold">
                                        {{ __('Udløber') }}: {{ $expDoc->expiry_date->format('d.m.Y') }} ({{ $expDoc->expiry_date->diffForHumans() }})
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right: Activity & Audit Trail -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <h2 class="text-base font-bold text-slate-900">{{ __('Audit Log & Hændelser') }}</h2>
                        <a href="{{ route('admin.audit.index') }}" class="text-xs text-indigo-600 font-bold hover:underline">{{ __('Se alle') }}</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentAuditLogs as $log)
                            <div class="text-xs p-3 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-800">{{ $log->action }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-slate-500 text-[11px]">
                                    {{ __('Af') }}: <strong>{{ $log->user->name ?? __('System') }}</strong> (IP: {{ $log->ip_address }})
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-slate-400">{{ __('Ingen nylige hændelser logget.') }}</div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-indigo-900 text-white rounded-2xl p-6 space-y-4 shadow-md">
                    <h3 class="text-sm font-bold">{{ __('Hurtige handlinger') }}</h3>
                    <div class="space-y-2 text-xs">
                        <a href="{{ route('admin.workers.index', ['status' => 'pending']) }}" class="block p-2.5 rounded-lg bg-white/10 hover:bg-white/20 transition">
                            👤 {{ __('Godkend nye vikarregistreringer') }} &rarr;
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="block p-2.5 rounded-lg bg-white/10 hover:bg-white/20 transition">
                            💰 {{ __('Generer månedlige kundefakturaer') }} &rarr;
                        </a>
                        <a href="{{ route('admin.timesheets.export') }}" class="block p-2.5 rounded-lg bg-white/10 hover:bg-white/20 transition">
                            📊 {{ __('Eksporter timesedler til CSV / Løn') }} &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
