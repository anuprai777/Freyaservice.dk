<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-burgundy/10 text-burgundy border border-burgundy/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-burgundy"></span>
                        {{ __('Backoffice Portal') }}
                    </span>
                    <span class="text-xs text-ink/60 font-medium hidden sm:inline">• {{ __('Live overvågning') }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black text-navy tracking-tight">{{ __('Administration & Vagtstyring') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('FreyaService Backoffice • Live overvågning af kunder, vikarer og bemanding.') }}</p>
            </div>
            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <a href="{{ route('admin.requests.index') }}" class="w-full sm:w-auto justify-center inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white font-bold text-xs shadow-sm hover:shadow-md transition">
                    <x-heroicon-o-clipboard-document-list class="w-4 h-4 text-[#C9A24B]" />
                    <span>{{ __('Gennemgå forespørgsler') }}</span>
                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        <!-- KPI Metrics Grid (Desktop: 6 cols, Mobile: 2 cols responsive SaaS Stat-Cards) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
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
                sublabel="{{ __('Afventer godkendelse') }}"
                accent="burgundy"
                icon="clock"
                href="{{ route('admin.timesheets.index', ['status' => 'submitted']) }}"
            />
        </div>

        <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            <!-- Recent Staff Requests requiring matching -->
            <div class="lg:col-span-8 space-y-6">
                <x-card title="{{ __('Seneste bemandingsforespørgsler') }}" description="{{ __('Prioriterede opgaver fra virksomheder.') }}" variant="white">
                    <x-slot:iconSlot>
                        <div class="w-10 h-10 rounded-xl bg-burgundy/10 text-burgundy flex items-center justify-center">
                            <x-heroicon-o-inbox-stack class="w-5 h-5 text-burgundy" />
                        </div>
                    </x-slot:iconSlot>

                    <x-slot:action>
                        <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-burgundy hover:text-burgundy-dark transition">
                            <span>{{ __('Se alle') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </x-slot:action>

                    <div class="space-y-3">
                        @forelse($recentRequests as $req)
                            <div class="p-4 rounded-xl border border-mist bg-brand-surface/30 hover:bg-brand-surface/70 transition flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status->badgeClasses() }}">
                                            {{ $req->status->label() }}
                                        </span>
                                        @if($req->is_urgent)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold text-[10px]">
                                                <x-heroicon-s-bolt class="w-3 h-3 text-rose-600 shrink-0" />
                                                <span>{{ __('AKUT') }}</span>
                                            </span>
                                        @endif
                                        <h3 class="font-bold text-sm text-navy">{{ $req->role }}</h3>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-ink/75">
                                        <span class="inline-flex items-center gap-1">
                                            <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-ink/50 shrink-0" />
                                            <strong>{{ $req->client->company_name ?? __('Kunde') }}</strong>
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/50 shrink-0" />
                                            <span>{{ $req->city }}</span>
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <x-heroicon-o-users class="w-3.5 h-3.5 text-ink/50 shrink-0" />
                                            <span>{{ $req->workers_needed }} {{ __('vikar(er)') }}</span>
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-ink/60">
                                        <span class="inline-flex items-center gap-1">
                                            <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                            <span>{{ __('Start') }}: {{ $req->start_date->format('d.m.Y') }}</span>
                                        </span>
                                        <span>•</span>
                                        <span>{{ $req->request_type->label() }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                                    <a href="{{ route('admin.matching.show', $req) }}" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white font-bold text-xs shadow-xs transition">
                                        <x-heroicon-s-sparkles class="w-3.5 h-3.5 text-[#C9A24B]" />
                                        <span>{{ __('Match Vikarer') }}</span>
                                    </a>
                                    <a href="{{ route('admin.requests.show', $req) }}" class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl border border-mist bg-white text-ink/80 font-semibold text-xs hover:bg-sand transition">
                                        {{ __('Vis') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-xs text-ink/50 space-y-2">
                                <x-heroicon-o-check-circle class="w-8 h-8 text-emerald-500/50 mx-auto" />
                                <div>{{ __('Ingen aktive forespørgsler der afventer match.') }}</div>
                            </div>
                        @endforelse
                    </div>
                </x-card>

                <!-- Expiring Documents Alert Box -->
                @if($expiringDocuments->isNotEmpty())
                    <x-card variant="white" class="border-amber-300/80">
                        <div class="flex items-start gap-3 mb-4">
                            <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-amber-700" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-navy">{{ __('Udløbende dokumenter og arbejdstilladelser') }}</h3>
                                <p class="text-xs text-ink/70 mt-0.5">{{ __('Følgende dokumenter udløber inden for de næste 30 dage og kræver opfølgning:') }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($expiringDocuments as $expDoc)
                                <div class="p-3 bg-amber-50/50 rounded-xl border border-amber-200/70 flex justify-between items-center text-xs">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-lg bg-white border border-amber-200 flex items-center justify-center font-bold text-xs text-navy shrink-0">
                                            {{ strtoupper(substr($expDoc->workerProfile->user->name ?? 'V', 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-navy">{{ $expDoc->workerProfile->user->name ?? __('Vikar') }}</span>
                                            <span class="text-ink/60">({{ $expDoc->type->label() }})</span>
                                        </div>
                                    </div>
                                    <div class="text-rose-700 font-bold inline-flex items-center gap-1">
                                        <x-heroicon-o-clock class="w-3.5 h-3.5" />
                                        <span>{{ __('Udløber') }}: {{ $expDoc->expiry_date->format('d.m.Y') }} ({{ $expDoc->expiry_date->diffForHumans() }})</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-card>
                @endif
            </div>

            <!-- Right: Activity & Audit Trail -->
            <div class="lg:col-span-4 space-y-6">
                <x-card title="{{ __('Audit Log & Hændelser') }}" variant="white">
                    <x-slot:iconSlot>
                        <div class="w-10 h-10 rounded-xl bg-navy/10 text-navy flex items-center justify-center">
                            <x-heroicon-o-shield-check class="w-5 h-5 text-navy" />
                        </div>
                    </x-slot:iconSlot>

                    <x-slot:action>
                        <a href="{{ route('admin.audit.index') }}" class="inline-flex items-center gap-1 text-xs text-burgundy font-bold hover:text-burgundy-dark transition">
                            <span>{{ __('Se alle') }}</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </x-slot:action>

                    <div class="space-y-2.5">
                        @forelse($recentAuditLogs as $log)
                            <div class="text-xs p-3 rounded-xl bg-sand/60 border border-mist space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-navy">{{ $log->action }}</span>
                                    <span class="text-[10px] text-ink/50">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="text-ink/70 text-[11px] flex items-center gap-1">
                                    <x-heroicon-o-user class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                    <span>{{ __('Af') }}: <strong>{{ $log->user->name ?? __('System') }}</strong></span>
                                    <span class="text-ink/40">({{ $log->ip_address }})</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-xs text-ink/50">{{ __('Ingen nylige hændelser logget.') }}</div>
                        @endforelse
                    </div>
                </x-card>

                <!-- Quick Links -->
                <x-card variant="navy">
                    <div class="flex items-center gap-2 mb-3">
                        <x-heroicon-o-bolt class="w-4 h-4 text-[#C9A24B]" />
                        <h3 class="text-sm font-bold text-white">{{ __('Hurtige handlinger') }}</h3>
                    </div>
                    <div class="space-y-2 text-xs">
                        <a href="{{ route('admin.workers.index', ['status' => 'pending']) }}" class="flex items-center justify-between p-3 rounded-xl bg-navy-800 hover:bg-navy-700 border border-navy-700 transition group">
                            <span class="inline-flex items-center gap-2 text-white">
                                <x-heroicon-o-user-plus class="w-4 h-4 text-[#C9A24B] shrink-0" />
                                <span>{{ __('Godkend nye vikarregistreringer') }}</span>
                            </span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 text-sand-300 group-hover:translate-x-0.5 transition-transform" />
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-navy-800 hover:bg-navy-700 border border-navy-700 transition group">
                            <span class="inline-flex items-center gap-2 text-white">
                                <x-heroicon-o-banknotes class="w-4 h-4 text-[#C9A24B] shrink-0" />
                                <span>{{ __('Generer månedlige kundefakturaer') }}</span>
                            </span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 text-sand-300 group-hover:translate-x-0.5 transition-transform" />
                        </a>
                        <a href="{{ route('admin.timesheets.export') }}" class="flex items-center justify-between p-3 rounded-xl bg-navy-800 hover:bg-navy-700 border border-navy-700 transition group">
                            <span class="inline-flex items-center gap-2 text-white">
                                <x-heroicon-o-arrow-down-tray class="w-4 h-4 text-[#C9A24B] shrink-0" />
                                <span>{{ __('Eksporter timesedler til CSV / Løn') }}</span>
                            </span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 text-sand-300 group-hover:translate-x-0.5 transition-transform" />
                        </a>
                    </div>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>
