<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0 border border-burgundy/20 shadow-xs">
                    <x-heroicon-o-building-office-2 class="w-5 h-5 sm:w-6 sm:h-6 text-burgundy" />
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-[#C9A24B]/15 text-[#8C6C27] border border-[#C9A24B]/30">
                            {{ __('Virksomhedskunde') }}
                        </span>
                        <span class="text-xs text-ink/60 font-mono">CVR: {{ $client->cvr }}</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-black text-navy tracking-tight">{{ $client->company_name }}</h1>
                    <p class="text-xs text-ink/70 mt-0.5 flex items-center gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1">
                            <x-heroicon-o-user class="w-3.5 h-3.5 text-ink/40" />
                            <span>{{ $client->contact_person }}</span>
                        </span>
                        <span>•</span>
                        <span class="inline-flex items-center gap-1">
                            <x-heroicon-o-phone class="w-3.5 h-3.5 text-ink/40" />
                            <span>{{ $client->phone }}</span>
                        </span>
                    </p>
                </div>
            </div>
            <div class="w-full sm:w-auto flex items-center gap-3">
                <a href="{{ route('client.requests.create') }}" class="w-full sm:w-auto justify-center inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white text-sm font-bold shadow-sm hover:shadow-md transition">
                    <x-heroicon-s-plus class="w-4 h-4 text-[#C9A24B]" />
                    <span>{{ __('Bestil Vikar') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div x-data="{
        pollCount: 0,
        activeQrShift: null,
        activeQrToken: null,
        activeQrTitle: null,
        init() {
            // Auto-refresh every 30 seconds
            setInterval(() => {
                fetch('{{ route('client.dashboard.poll') }}')
                    .then(res => res.json())
                    .then(data => {
                        this.pollCount++;
                    });
            }, 30000);
        }
    }" class="py-6 sm:py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        <!-- Flash Messages -->
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

        <!-- Action Banner: Active Shifts QR Code Generation for Clock-in -->
        @if($activeShifts->isNotEmpty())
            <x-card variant="navy" class="shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-200 text-xs font-bold mb-2 border border-emerald-400/30">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ __('Aktive vagter i dag') }}
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-white">{{ __('QR-koder til medarbejder tjek-ind') }}</h2>
                        <p class="text-xs text-sand-200 mt-1 max-w-xl leading-relaxed">
                            {{ __('Vis QR-koden på skærmen ved receptionen eller indgangen, så tilknyttede vikarer kan scanne og stemple ind med det samme.') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap w-full md:w-auto gap-2">
                        @foreach($activeShifts as $shift)
                            <button type="button"
                                @click="activeQrShift = '{{ $shift->id }}'; activeQrToken = '{{ $shift->qr_secret_token }}'; activeQrTitle = '{{ addslashes($shift->staffRequest->role) }} - {{ $shift->start_at->format('H:i') }} til {{ $shift->end_at->format('H:i') }}'"
                                class="w-full sm:w-auto justify-center px-4 py-2.5 rounded-xl bg-burgundy hover:bg-burgundy-dark text-xs font-bold text-white shadow-sm flex items-center gap-2 transition min-h-[40px] border border-white/10">
                                <x-heroicon-o-qr-code class="w-4 h-4 text-[#C9A24B]" />
                                <span>{{ __('Vis QR') }}: {{ $shift->staffRequest->role }} ({{ $shift->start_at->format('H:i') }})</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </x-card>
        @endif

        <!-- Timesheet Approval Queue -->
        @if($pendingTimesheets->isNotEmpty())
            <x-card variant="white" class="border-amber-300/80">
                <x-slot:header>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0">
                            <x-heroicon-o-clock class="w-5 h-5 text-amber-700" />
                        </div>
                        <div>
                            <h2 class="text-base sm:text-lg font-bold text-navy flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                                <span>{{ __('Afventer din godkendelse') }} ({{ $pendingTimesheets->count() }} {{ __('timesedler') }})</span>
                            </h2>
                            <p class="text-xs text-ink/70 mt-0.5">{{ __('Godkend eller afvis udførte timer for dine vikarer.') }}</p>
                        </div>
                    </div>
                </x-slot:header>

                <!-- Mobile Card View for Timesheets (md:hidden) -->
                <div class="md:hidden divide-y divide-mist mt-2">
                    @foreach($pendingTimesheets as $ts)
                        <div class="py-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($ts->worker->user->name ?? 'V', 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-navy text-sm block">{{ $ts->worker->user->name ?? __('Vikar') }}</span>
                                        <span class="text-xs text-ink/60">{{ $ts->assignment->staffRequest->role ?? __('Vikaropgave') }}</span>
                                    </div>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    {{ __('Afventer') }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs bg-sand/60 p-3 rounded-xl border border-mist">
                                <div>
                                    <span class="text-ink/50 text-[11px] block">{{ __('Dato') }}:</span>
                                    <span class="font-medium text-navy">{{ $ts->clock_in->format('d. M Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-ink/50 text-[11px] block">{{ __('Tidsrum') }}:</span>
                                    <span class="font-medium text-navy">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('Aktiv') }}</span>
                                </div>
                                <div>
                                    <span class="text-ink/50 text-[11px] block">{{ __('Pause') }}:</span>
                                    <span class="font-medium text-navy">{{ $ts->break_minutes }} {{ __('min') }}</span>
                                </div>
                                <div>
                                    <span class="text-ink/50 text-[11px] block">{{ __('Total tid') }}:</span>
                                    <span class="font-bold text-burgundy">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 pt-1" x-data="{ openReject: false }">
                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('client.timesheets.approve', $ts) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition min-h-[44px]">
                                        <x-heroicon-s-check class="w-4 h-4" />
                                        <span>{{ __('Godkend') }}</span>
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <button type="button" @click="openReject = true" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 font-semibold text-xs transition border border-rose-200 min-h-[44px]">
                                    <x-heroicon-s-x-mark class="w-4 h-4" />
                                    <span>{{ __('Afvis') }}</span>
                                </button>

                                <!-- Rejection Modal -->
                                <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-navy-950/80 flex items-center justify-center p-4">
                                    <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                        <h3 class="text-base font-bold text-navy">{{ __('Afvis timeseddel') }}</h3>
                                        <p class="text-xs text-ink/70 mt-1">{{ __('Angiv venligst en begrundelse til vikaren og administrationen:') }}</p>

                                        <form method="POST" action="{{ route('client.timesheets.reject', $ts) }}" class="mt-4 space-y-3">
                                            @csrf
                                            <textarea name="rejection_reason" required rows="3" class="w-full text-xs rounded-xl border-mist focus:border-rose-500 focus:ring-rose-500" placeholder="{{ __('F.eks.: Tidligere afsluttet end angivet, eller pausetid ikke fratrukket...') }}"></textarea>
                                            <div class="flex justify-end gap-2 pt-2">
                                                <button type="button" @click="openReject = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-ink/60 hover:bg-sand">{{ __('Annuller') }}</button>
                                                <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white">{{ __('Bekræft afvisning') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Desktop Table View (hidden md:block) -->
                <div class="hidden md:block overflow-x-auto mt-4">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-sand/80 text-ink/70 uppercase font-bold text-[11px] border-b border-mist">
                            <tr>
                                <th class="p-3">{{ __('Vikar') }}</th>
                                <th class="p-3">{{ __('Dato') }}</th>
                                <th class="p-3">{{ __('Tidsrum') }}</th>
                                <th class="p-3">{{ __('Pause') }}</th>
                                <th class="p-3">{{ __('Timer i alt') }}</th>
                                <th class="p-3 text-right">{{ __('Handlinger') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-mist">
                            @foreach($pendingTimesheets as $ts)
                                <tr class="hover:bg-sand/40 transition">
                                    <td class="p-3 font-semibold text-navy">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center font-bold text-xs shrink-0">
                                                {{ strtoupper(substr($ts->worker->user->name ?? 'V', 0, 1)) }}
                                            </div>
                                            <div>
                                                <span>{{ $ts->worker->user->name ?? __('Vikar') }}</span>
                                                <span class="block text-[10px] text-ink/60 font-normal">{{ $ts->assignment->staffRequest->role ?? '' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 text-ink/80">{{ $ts->clock_in->format('d. M Y') }}</td>
                                    <td class="p-3 text-ink/80">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('Aktiv') }}</td>
                                    <td class="p-3 text-ink/80">{{ $ts->break_minutes }} {{ __('min') }}</td>
                                    <td class="p-3 font-bold text-burgundy text-sm">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</td>
                                    <td class="p-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <!-- Approve Form -->
                                            <form method="POST" action="{{ route('client.timesheets.approve', $ts) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs transition">
                                                    <x-heroicon-s-check class="w-3.5 h-3.5" />
                                                    <span>{{ __('Godkend') }}</span>
                                                </button>
                                            </form>

                                            <!-- Reject Details Modal Button -->
                                            <div x-data="{ openReject: false }">
                                                <button type="button" @click="openReject = true" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 font-semibold text-xs transition border border-rose-200">
                                                    <x-heroicon-s-x-mark class="w-3.5 h-3.5" />
                                                    <span>{{ __('Afvis') }}</span>
                                                </button>

                                                <!-- Rejection Modal -->
                                                <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-navy-950/80 flex items-center justify-center p-4">
                                                    <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                                        <h3 class="text-base font-bold text-navy">{{ __('Afvis timeseddel') }}</h3>
                                                        <p class="text-xs text-ink/70 mt-1">{{ __('Angiv venligst en begrundelse til vikaren og administrationen:') }}</p>

                                                        <form method="POST" action="{{ route('client.timesheets.reject', $ts) }}" class="mt-4 space-y-3">
                                                            @csrf
                                                            <textarea name="rejection_reason" required rows="3" class="w-full text-xs rounded-xl border-mist focus:border-rose-500 focus:ring-rose-500" placeholder="{{ __('F.eks.: Tidligere afsluttet end angivet, eller pausetid ikke fratrukket...') }}"></textarea>
                                                            <div class="flex justify-end gap-2 pt-2">
                                                                <button type="button" @click="openReject = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-ink/60 hover:bg-sand">{{ __('Annuller') }}</button>
                                                                <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white">{{ __('Bekræft afvisning') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        @endif

        <!-- Staff Requests Status Tabs & List -->
        <x-card variant="white" class="space-y-6">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-navy">{{ __('Dine bemandingsforespørgsler') }}</h2>
                        <p class="text-xs text-ink/70 mt-0.5">{{ __('Overvåg status for aktuelle og afsluttede bestillinger.') }}</p>
                    </div>

                    <!-- Status Filter Tabs (horizontally scrollable on mobile) -->
                    <div class="w-full sm:w-auto overflow-x-auto scrollbar-none pb-1 sm:pb-0">
                        <div class="flex items-center gap-1.5 p-1 bg-sand rounded-xl text-xs font-semibold text-ink/70 min-w-max border border-mist">
                            <a href="{{ route('client.dashboard', ['status' => 'all']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'all' ? 'bg-burgundy text-white shadow-xs font-bold' : 'hover:text-navy hover:bg-white/60' }}">
                                {{ __('Alle') }} ({{ $counts['all'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'new']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'new' ? 'bg-burgundy text-white shadow-xs font-bold' : 'hover:text-navy hover:bg-white/60' }}">
                                {{ __('Nye') }} ({{ $counts['new'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'in_progress']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'in_progress' ? 'bg-burgundy text-white shadow-xs font-bold' : 'hover:text-navy hover:bg-white/60' }}">
                                {{ __('Under match') }} ({{ $counts['in_progress'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'matched']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'matched' ? 'bg-burgundy text-white shadow-xs font-bold' : 'hover:text-navy hover:bg-white/60' }}">
                                {{ __('Matchet') }} ({{ $counts['matched'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'active']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'active' ? 'bg-burgundy text-white shadow-xs font-bold' : 'hover:text-navy hover:bg-white/60' }}">
                                {{ __('Aktive') }} ({{ $counts['active'] }})
                            </a>
                        </div>
                    </div>
                </div>
            </x-slot:header>

            <!-- Requests Grid -->
            <div class="grid md:grid-cols-2 gap-4">
                @forelse($requests as $req)
                    <x-card variant="sand" hover="true" class="flex flex-col justify-between space-y-4">
                        <div>
                            <div class="flex justify-between items-start gap-2 mb-2">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $req->status->badgeClasses() }}">
                                    {{ $req->status->label() }}
                                </span>
                                @if($req->is_urgent)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold text-[10px] tracking-wide uppercase border border-rose-200">
                                        <x-heroicon-s-bolt class="w-3 h-3 text-rose-600 shrink-0" />
                                        <span>{{ __('Akut') }}</span>
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-base font-bold text-navy">{{ $req->role }}</h3>
                            <div class="text-xs text-ink/75 mt-1.5 flex items-center gap-3 flex-wrap">
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-ink/50 shrink-0" />
                                    <span>{{ $req->location }}, {{ $req->city }}</span>
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <x-heroicon-o-users class="w-3.5 h-3.5 text-ink/50 shrink-0" />
                                    <span>{{ $req->workers_needed }} {{ $req->workers_needed > 1 ? __('personer') : __('person') }}</span>
                                </span>
                            </div>

                            <div class="mt-3 text-xs text-ink/70 bg-white p-3 rounded-xl border border-mist space-y-1">
                                <div><strong>{{ __('Periode') }}:</strong> {{ $req->start_date->format('d.m.Y') }} @if($req->end_date) {{ __('til') }} {{ $req->end_date->format('d.m.Y') }} @endif</div>
                                @if($req->start_time && $req->end_time)
                                    <div><strong>{{ __('Mødetid') }}:</strong> {{ $req->start_time }} - {{ $req->end_time }}</div>
                                @endif
                                <div><strong>{{ __('Type') }}:</strong> {{ $req->request_type->label() }}</div>
                            </div>

                            <!-- Assigned Workers Preview -->
                            @if($req->shifts->flatMap->assignments->isNotEmpty())
                                <div class="mt-3 pt-3 border-t border-mist">
                                    <div class="text-[11px] font-bold text-navy uppercase tracking-wider mb-2 flex items-center gap-1">
                                        <x-heroicon-o-check-badge class="w-3.5 h-3.5 text-emerald-600" />
                                        <span>{{ __('Tilknyttede vikarer:') }}</span>
                                    </div>
                                    <div class="space-y-1.5">
                                        @foreach($req->shifts->flatMap->assignments as $asgn)
                                            <div class="flex items-center justify-between text-xs bg-white px-3 py-1.5 rounded-lg border border-mist">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                    <span class="font-semibold text-navy">{{ $asgn->worker->user->name ?? __('Vikar') }}</span>
                                                    <span class="inline-flex items-center gap-0.5 text-[10px] text-amber-700 font-bold bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">
                                                        <x-heroicon-s-star class="w-3 h-3 text-amber-500" />
                                                        <span>{{ $asgn->worker->rating_avg }}</span>
                                                    </span>
                                                </div>
                                                <span class="text-[11px] text-ink/60 uppercase font-medium">{{ $asgn->status->label() }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-mist flex items-center justify-between">
                            <span class="text-[11px] text-ink/50">{{ __('Oprettet') }} {{ $req->created_at->diffForHumans() }}</span>
                            <a href="{{ route('client.requests.show', $req) }}" class="inline-flex items-center gap-1 text-xs font-bold text-burgundy hover:text-burgundy-dark transition group">
                                <span>{{ __('Se detaljer & QR') }}</span>
                                <x-heroicon-o-arrow-right class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" />
                            </a>
                        </div>
                    </x-card>
                @empty
                    <div class="md:col-span-2 text-center py-12 text-ink/50 text-sm space-y-3">
                        <x-heroicon-o-clipboard-document-list class="w-10 h-10 text-ink/30 mx-auto" />
                        <div>{{ __('Ingen forespørgsler fundet med denne status.') }}</div>
                        <div>
                            <a href="{{ route('client.requests.create') }}" class="inline-flex items-center gap-1.5 text-burgundy font-bold hover:underline">
                                <x-heroicon-s-plus class="w-4 h-4" />
                                <span>{{ __('Opret en ny bemandingsforespørgsel') }}</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="pt-4">
                {{ $requests->links() }}
            </div>
        </x-card>

        <!-- QR Code Modal (Live shift scanning) -->
        <div x-show="activeQrShift !== null" x-cloak class="fixed inset-0 z-50 bg-navy-950/80 flex items-center justify-center p-4">
            <div @click.away="activeQrShift = null" class="bg-white rounded-3xl max-w-sm w-full p-6 sm:p-8 text-center shadow-2xl relative border border-mist">
                <button type="button" @click="activeQrShift = null" class="absolute top-4 right-4 text-ink/40 hover:text-ink/80 p-2 cursor-pointer transition">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>

                <div class="w-14 h-14 rounded-2xl bg-burgundy/10 text-burgundy flex items-center justify-center mx-auto mb-3 border border-burgundy/20 shadow-xs">
                    <x-heroicon-o-qr-code class="w-7 h-7 text-burgundy" />
                </div>

                <h3 class="text-lg font-black text-navy">{{ __('Vikar Tjek-ind QR') }}</h3>
                <p class="text-xs text-ink/70 mt-1" x-text="activeQrTitle"></p>

                <!-- Dynamic QR preview via SimpleSoftwareIO or signed link -->
                <div class="my-5 p-3 sm:p-4 bg-sand/60 rounded-2xl border border-mist inline-block shadow-inner max-w-full">
                    <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' + encodeURIComponent('{{ url('/worker/shifts/scan') }}?shift=' + activeQrShift + '&token=' + activeQrToken)" alt="Vikar QR Kode" class="mx-auto rounded-lg max-w-[200px] sm:max-w-[220px] w-full h-auto">
                </div>

                <div class="text-[11px] text-ink/60 leading-relaxed">
                    {{ __('Bed vikaren om at åbne sit FreyaService-kamera og scanne denne kode for at stemple ind.') }}
                </div>

                <button type="button" @click="activeQrShift = null" class="mt-6 w-full py-2.5 rounded-xl bg-navy hover:bg-navy-900 text-white font-bold text-xs shadow-sm transition min-h-[44px] cursor-pointer">
                    {{ __('Luk vindue') }}
                </button>
            </div>
        </div>

    </div>
</x-app-layout>
