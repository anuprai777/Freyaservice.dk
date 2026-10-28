<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-navy tracking-tight">{{ __('Administration & Vagtstyring') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('FreyaService Backoffice • Live overvågning af kunder, vikarer og bemanding.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.requests.index') }}" class="btn-primary px-4 py-2 rounded-lg bg-burgundy hover:bg-burgundy-dark text-white font-bold text-xs shadow-xs transition">
                    {{ __('Gennemgå forespørgsler') }} &rarr;
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- KPI Metrics Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <x-stat-card
                label="{{ __('Nye ordrer') }}"
                value="{{ $newRequestsCount }}"
                sublabel="{{ __('Afventer match') }}"
                accent="burgundy"
                icon="sparkles"
                href="{{ route('admin.requests.index', ['status' => 'new']) }}"
            />

            <x-stat-card
                label="{{ __('Under behandling') }}"
                value="{{ $inProgressRequestsCount }}"
                sublabel="{{ __('Tilbud sendt') }}"
                accent="navy"
                icon="arrow-path"
                href="{{ route('admin.requests.index', ['status' => 'in_progress']) }}"
            />

            <x-stat-card
                label="{{ __('Aktive vagter') }}"
                value="{{ $activeShiftsCount }}"
                sublabel="{{ __('Besat / I gang') }}"
                accent="teal"
                icon="briefcase"
                href="{{ route('admin.requests.index', ['status' => 'active']) }}"
            />

            <x-stat-card
                label="{{ __('Nye vikarer') }}"
                value="{{ $pendingWorkersCount }}"
                sublabel="{{ __('Afventer godkendelse') }}"
                accent="navy"
                icon="user-group"
                href="{{ route('admin.workers.index', ['status' => 'pending']) }}"
            />

            <x-stat-card
                label="{{ __('Dokumenter') }}"
                value="{{ $pendingDocumentsCount }}"
                sublabel="{{ __('Klar til verifikation') }}"
                accent="navy"
                icon="document-check"
                href="{{ route('admin.workers.index') }}"
            />

            <x-stat-card
                label="{{ __('Timesedler') }}"
                value="{{ $unapprovedTimesheetsCount }}"
                sublabel="{{ __('Afventer kundegodkendelse') }}"
                accent="burgundy"
                icon="clock"
                href="{{ route('admin.timesheets.index', ['status' => 'submitted']) }}"
            />
        </div>

        <div class="grid lg:grid-cols-12 gap-8">

            <!-- Recent Staff Requests requiring matching -->
            <div class="lg:col-span-8 space-y-6">
                <x-card title="{{ __('Seneste bemandingsforespørgsler') }}" description="{{ __('Prioriterede opgaver fra virksomheder.') }}">
                    <x-slot:action>
                        <a href="{{ route('admin.requests.index') }}" class="text-xs font-bold text-brand-secondary hover:text-brand-action transition">{{ __('Se alle') }} &rarr;</a>
                    </x-slot:action>

                    <div class="space-y-3">
                        @forelse($recentRequests as $req)
                            <div class="p-4 rounded-xl border border-sand-300 bg-sand-50/50 hover:bg-sand-50 transition flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold border {{ $req->status->badgeClasses() }}">
                                            {{ $req->status->label() }}
                                        </span>
                                        @if($req->is_urgent)
                                            <span class="px-2 py-0.5 rounded bg-brick-100 text-brick-600 font-bold text-[10px]">⚡ {{ __('AKUT') }}</span>
                                        @endif
                                        <h3 class="font-bold text-sm text-charcoal-900">{{ $req->role }}</h3>
                                    </div>
                                    <div class="text-xs text-charcoal-700 mt-1">
                                        🏢 {{ $req->client->company_name ?? __('Kunde') }} &bull; 📍 {{ $req->city }} &bull; 👥 {{ $req->workers_needed }} {{ __('vikar(er)') }}
                                    </div>
                                    <div class="text-xs text-coolslate-500 mt-0.5">
                                        {{ __('Dato') }}: {{ $req->start_date->format('d.m.Y') }} &bull; {{ $req->request_type->label() }}
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.matching.show', $req) }}" class="px-3 py-1.5 rounded-lg bg-brand-action hover:bg-brand-action-hover text-white font-bold text-xs shadow-sm transition">
                                        🎯 {{ __('Match Vikarer') }}
                                    </a>
                                    <a href="{{ route('admin.requests.show', $req) }}" class="px-3 py-1.5 rounded-lg border border-sand-300 bg-white text-charcoal-700 font-semibold text-xs hover:bg-sand-50 transition">
                                        {{ __('Vis') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-coolslate-500">{{ __('Ingen aktive forespørgsler.') }}</div>
                        @endforelse
                    </div>
                </x-card>

                <!-- Expiring Documents Alert Box -->
                @if($expiringDocuments->isNotEmpty())
                    <x-card variant="sand" class="border-action-300">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-lg">⚠️</span>
                            <div>
                                <h3 class="text-sm font-bold text-action-900">{{ __('Udløbende dokumenter og arbejdstilladelser') }}</h3>
                                <p class="text-xs text-action-700">{{ __('Følgende dokumenter udløber inden for de næste 30 dage og kræver opfølgning:') }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($expiringDocuments as $expDoc)
                                <div class="p-3 bg-white rounded-xl border border-action-200 flex justify-between items-center text-xs">
                                    <div>
                                        <span class="font-bold text-charcoal-900">{{ $expDoc->workerProfile->user->name ?? __('Vikar') }}</span>
                                        <span class="text-coolslate-500">({{ $expDoc->type->label() }})</span>
                                    </div>
                                    <div class="text-brick-600 font-bold">
                                        {{ __('Udløber') }}: {{ $expDoc->expiry_date->format('d.m.Y') }} ({{ $expDoc->expiry_date->diffForHumans() }})
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-card>
                @endif
            </div>

            <!-- Right: Activity & Audit Trail -->
            <div class="lg:col-span-4 space-y-6">
                <x-card title="{{ __('Audit Log & Hændelser') }}">
                    <x-slot:action>
                        <a href="{{ route('admin.audit.index') }}" class="text-xs text-brand-secondary font-bold hover:text-brand-action transition">{{ __('Se alle') }}</a>
                    </x-slot:action>

                    <div class="space-y-3">
                        @forelse($recentAuditLogs as $log)
                            <div class="text-xs p-3 rounded-xl bg-sand-50 border border-sand-200 space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-charcoal-800">{{ $log->action }}</span>
                                    <span class="text-[10px] text-coolslate-500">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-coolslate-500 text-[11px]">
                                    {{ __('Af') }}: <strong>{{ $log->user->name ?? __('System') }}</strong> (IP: {{ $log->ip_address }})
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-coolslate-500">{{ __('Ingen nylige hændelser logget.') }}</div>
                        @endforelse
                    </div>
                </x-card>

                <!-- Quick Links -->
                <x-card variant="navy">
                    <h3 class="text-sm font-bold text-white mb-3">{{ __('Hurtige handlinger') }}</h3>
                    <div class="space-y-2 text-xs">
                        <a href="{{ route('admin.workers.index', ['status' => 'pending']) }}" class="block p-2.5 rounded-lg bg-navy-800 hover:bg-navy-700 border border-navy-700 transition">
                            👤 {{ __('Godkend nye vikarregistreringer') }} &rarr;
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="block p-2.5 rounded-lg bg-navy-800 hover:bg-navy-700 border border-navy-700 transition">
                            💰 {{ __('Generer månedlige kundefakturaer') }} &rarr;
                        </a>
                        <a href="{{ route('admin.timesheets.export') }}" class="block p-2.5 rounded-lg bg-navy-800 hover:bg-navy-700 border border-navy-700 transition">
                            📊 {{ __('Eksporter timesedler til CSV / Løn') }} &rarr;
                        </a>
                    </div>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>
