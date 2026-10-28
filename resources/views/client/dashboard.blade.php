<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $client->company_name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">CVR: {{ $client->cvr }} • {{ __('Kontakt') }}: {{ $client->contact_person }} ({{ $client->phone }})</p>
            </div>
            <div class="w-full sm:w-auto flex items-center gap-3">
                <a href="{{ route('client.requests.create') }}" class="w-full sm:w-auto justify-center inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white text-sm font-bold shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
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
            <div class="p-4 rounded-xl bg-forest-50 border border-forest-200 text-forest-800 text-sm font-semibold flex items-center gap-2">
                <span>✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-action-50 border border-action-200 text-action-800 text-sm font-semibold flex items-center gap-2">
                <span>⚠️</span>
                <span>{{ session('warning') }}</span>
            </div>
        @endif

        <!-- Action Banner: Active Shifts QR Code Generation for Clock-in -->
        @if($activeShifts->isNotEmpty())
            <x-card variant="navy" class="shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-forest-500/20 text-forest-100 text-xs font-bold mb-2">
                            <span class="w-2 h-2 rounded-full bg-forest-400 animate-ping"></span>
                            {{ __('Aktive vagter i dag') }}
                        </div>
                        <h2 class="text-lg sm:text-xl font-bold text-white">{{ __('QR-koder til medarbejder tjek-ind') }}</h2>
                        <p class="text-xs text-sand-200 mt-1 max-w-xl">
                            {{ __('Vis QR-koden på skærmen ved receptionen eller indgangen, så tilknyttede vikarer kan scanne og stemple ind med det samme.') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap w-full md:w-auto gap-2">
                        @foreach($activeShifts as $shift)
                            <button type="button"
                                @click="activeQrShift = '{{ $shift->id }}'; activeQrToken = '{{ $shift->qr_secret_token }}'; activeQrTitle = '{{ addslashes($shift->staffRequest->role) }} - {{ $shift->start_at->format('H:i') }} til {{ $shift->end_at->format('H:i') }}'"
                                class="w-full sm:w-auto justify-center px-4 py-2.5 rounded-xl bg-brand-action hover:bg-brand-action-hover text-xs font-bold text-white shadow-sm flex items-center gap-2 transition min-h-[40px]">
                                <span>📱 {{ __('Vis QR') }}: {{ $shift->staffRequest->role }} ({{ $shift->start_at->format('H:i') }})</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </x-card>
        @endif

        <!-- Timesheet Approval Queue -->
        @if($pendingTimesheets->isNotEmpty())
            <x-card class="border-amber-200/80">
                <x-slot:header>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                            <span>{{ __('Afventer din godkendelse') }} ({{ $pendingTimesheets->count() }} {{ __('timesedler') }})</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Godkend eller afvis udførte timer for dine vikarer.') }}</p>
                    </div>
                </x-slot:header>

                <!-- Mobile Card View for Timesheets (md:hidden) -->
                <div class="md:hidden divide-y divide-slate-100 mt-2">
                    @foreach($pendingTimesheets as $ts)
                        <div class="py-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <span class="font-bold text-slate-900 text-sm block">{{ $ts->worker->user->name ?? __('Vikar') }}</span>
                                    <span class="text-xs text-slate-500">{{ $ts->assignment->staffRequest->role ?? __('Vikaropgave') }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                    {{ __('Afventer') }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 text-xs bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <div>
                                    <span class="text-slate-400 text-[11px] block">{{ __('Dato') }}:</span>
                                    <span class="font-medium text-slate-700">{{ $ts->clock_in->format('d. M Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[11px] block">{{ __('Tidsrum') }}:</span>
                                    <span class="font-medium text-slate-700">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('Aktiv') }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 text-[11px] block">{{ __('Pause') }}:</span>
                                    <span class="font-medium text-slate-700">{{ $ts->break_minutes }} {{ __('min') }}</span>
                                </div>
                                <div>
                                    <span class="text-coolslate-500 text-[11px] block">{{ __('Total tid') }}:</span>
                                    <span class="font-bold text-brand-secondary">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 pt-1" x-data="{ openReject: false }">
                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('client.timesheets.approve', $ts) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition min-h-[44px]">
                                        ✓ {{ __('Godkend') }}
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <button type="button" @click="openReject = true" class="px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 font-semibold text-xs transition border border-rose-200 min-h-[44px]">
                                    {{ __('Afvis') }}
                                </button>

                                <!-- Rejection Modal -->
                                <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-slate-900/80 flex items-center justify-center p-4">
                                    <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                        <h3 class="text-base font-bold text-slate-900">{{ __('Afvis timeseddel') }}</h3>
                                        <p class="text-xs text-slate-500 mt-1">{{ __('Angiv venligst en begrundelse til vikaren og administrationen:') }}</p>

                                        <form method="POST" action="{{ route('client.timesheets.reject', $ts) }}" class="mt-4 space-y-3">
                                            @csrf
                                            <textarea name="rejection_reason" required rows="3" class="w-full text-xs rounded-xl border-slate-300 focus:border-rose-500 focus:ring-rose-500" placeholder="{{ __('F.eks.: Tidligere afsluttet end angivet, eller pausetid ikke fratrukket...') }}"></textarea>
                                            <div class="flex justify-end gap-2 pt-2">
                                                <button type="button" @click="openReject = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
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
                        <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                            <tr>
                                <th class="p-3">{{ __('Vikar') }}</th>
                                <th class="p-3">{{ __('Dato') }}</th>
                                <th class="p-3">{{ __('Tidsrum') }}</th>
                                <th class="p-3">{{ __('Pause') }}</th>
                                <th class="p-3">{{ __('Timer i alt') }}</th>
                                <th class="p-3 text-right">{{ __('Handlinger') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($pendingTimesheets as $ts)
                                <tr class="hover:bg-slate-50/50">
                                    <td class="p-3 font-semibold text-slate-900">
                                        {{ $ts->worker->user->name ?? __('Vikar') }}
                                        <span class="block text-[10px] text-slate-500 font-normal">{{ $ts->assignment->staffRequest->role ?? '' }}</span>
                                    </td>
                                    <td class="p-3 text-slate-700">{{ $ts->clock_in->format('d. M Y') }}</td>
                                    <td class="p-3 text-slate-700">{{ $ts->clock_in->format('H:i') }} - {{ $ts->clock_out ? $ts->clock_out->format('H:i') : __('Aktiv') }}</td>
                                    <td class="p-3 text-slate-700">{{ $ts->break_minutes }} {{ __('min') }}</td>
                                    <td class="p-3 font-bold text-brand-secondary">{{ number_format($ts->hours, 2, ',', '.') }} {{ __('timer') }}</td>
                                    <td class="p-3 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <!-- Approve Form -->
                                            <form method="POST" action="{{ route('client.timesheets.approve', $ts) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                                                    {{ __('Godkend') }}
                                                </button>
                                            </form>

                                            <!-- Reject Details Modal Button -->
                                            <div x-data="{ openReject: false }">
                                                <button type="button" @click="openReject = true" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 font-semibold text-xs transition border border-rose-200">
                                                    {{ __('Afvis') }}
                                                </button>

                                                <!-- Rejection Modal -->
                                                <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-slate-900/80 flex items-center justify-center p-4">
                                                    <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                                        <h3 class="text-base font-bold text-slate-900">{{ __('Afvis timeseddel') }}</h3>
                                                        <p class="text-xs text-slate-500 mt-1">{{ __('Angiv venligst en begrundelse til vikaren og administrationen:') }}</p>

                                                        <form method="POST" action="{{ route('client.timesheets.reject', $ts) }}" class="mt-4 space-y-3">
                                                            @csrf
                                                            <textarea name="rejection_reason" required rows="3" class="w-full text-xs rounded-xl border-slate-300 focus:border-rose-500 focus:ring-rose-500" placeholder="{{ __('F.eks.: Tidligere afsluttet end angivet, eller pausetid ikke fratrukket...') }}"></textarea>
                                                            <div class="flex justify-end gap-2 pt-2">
                                                                <button type="button" @click="openReject = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
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
        <x-card class="space-y-6">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-900">{{ __('Dine bemandingsforespørgsler') }}</h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ __('Overvåg status for aktuelle og afsluttede bestillinger.') }}</p>
                    </div>

                    <!-- Status Filter Tabs (horizontally scrollable on mobile) -->
                    <div class="w-full sm:w-auto overflow-x-auto scrollbar-none pb-1 sm:pb-0">
                        <div class="flex items-center gap-1.5 p-1 bg-sand-100 rounded-xl text-xs font-semibold text-charcoal-700 min-w-max">
                            <a href="{{ route('client.dashboard', ['status' => 'all']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'all' ? 'bg-white text-brand-secondary shadow-sm font-bold' : 'hover:text-charcoal-900' }}">
                                {{ __('Alle') }} ({{ $counts['all'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'new']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'new' ? 'bg-white text-brand-secondary shadow-sm font-bold' : 'hover:text-charcoal-900' }}">
                                {{ __('Nye') }} ({{ $counts['new'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'in_progress']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'in_progress' ? 'bg-white text-brand-secondary shadow-sm font-bold' : 'hover:text-charcoal-900' }}">
                                {{ __('Under match') }} ({{ $counts['in_progress'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'matched']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'matched' ? 'bg-white text-brand-secondary shadow-sm font-bold' : 'hover:text-charcoal-900' }}">
                                {{ __('Matchet') }} ({{ $counts['matched'] }})
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'active']) }}" class="px-3 py-1.5 rounded-lg transition {{ $status === 'active' ? 'bg-white text-brand-secondary shadow-sm font-bold' : 'hover:text-charcoal-900' }}">
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
                                    <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px] tracking-wide uppercase">
                                        ⚡ {{ __('Akut') }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-base font-bold text-slate-900">{{ $req->role }}</h3>
                            <div class="text-xs text-slate-600 mt-1 flex items-center gap-3">
                                <span>📍 {{ $req->location }}, {{ $req->city }}</span>
                                <span>👥 {{ $req->workers_needed }} {{ $req->workers_needed > 1 ? __('personer') : __('person') }}</span>
                            </div>

                            <div class="mt-3 text-xs text-slate-500 bg-white p-2.5 rounded-lg border border-slate-200/60">
                                <div><strong>{{ __('Periode') }}:</strong> {{ $req->start_date->format('d.m.Y') }} @if($req->end_date) {{ __('til') }} {{ $req->end_date->format('d.m.Y') }} @endif</div>
                                @if($req->start_time && $req->end_time)
                                    <div><strong>{{ __('Mødetid') }}:</strong> {{ $req->start_time }} - {{ $req->end_time }}</div>
                                @endif
                                <div><strong>{{ __('Type') }}:</strong> {{ $req->request_type->label() }}</div>
                            </div>

                            <!-- Assigned Workers Preview -->
                            @if($req->shifts->flatMap->assignments->isNotEmpty())
                                <div class="mt-3 pt-3 border-t border-slate-200">
                                    <div class="text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-2">{{ __('Tilknyttede vikarer:') }}</div>
                                    <div class="space-y-1.5">
                                        @foreach($req->shifts->flatMap->assignments as $asgn)
                                            <div class="flex items-center justify-between text-xs bg-white px-3 py-1.5 rounded-lg border border-slate-100">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                                    <span class="font-semibold text-slate-900">{{ $asgn->worker->user->name ?? __('Vikar') }}</span>
                                                    <span class="text-[10px] text-amber-600 font-bold">★ {{ $asgn->worker->rating_avg }}</span>
                                                </div>
                                                <span class="text-[11px] text-slate-500 uppercase">{{ $asgn->status->label() }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400">{{ __('Oprettet') }} {{ $req->created_at->diffForHumans() }}</span>
                            <a href="{{ route('client.requests.show', $req) }}" class="text-xs font-bold text-brand-secondary hover:text-brand-action transition flex items-center gap-1">
                                <span>{{ __('Se detaljer & QR') }}</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </x-card>
                @empty
                    <div class="md:col-span-2 text-center py-12 text-slate-400 text-sm">
                        {{ __('Ingen forespørgsler fundet med denne status.') }}
                        <div class="mt-3">
                            <a href="{{ route('client.requests.create') }}" class="text-brand-action font-bold hover:underline">{{ __('Opret en ny bemandingsforespørgsel') }}</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="pt-4">
                {{ $requests->links() }}
            </div>
        </x-card>

        <!-- QR Code Modal (Live shift scanning) -->
        <div x-show="activeQrShift !== null" x-cloak class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
            <div @click.away="activeQrShift = null" class="bg-white rounded-3xl max-w-sm w-full p-6 sm:p-8 text-center shadow-2xl relative border border-slate-200">
                <button type="button" @click="activeQrShift = null" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="w-12 h-12 rounded-2xl bg-action-50 text-brand-action flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>

                <h3 class="text-lg font-black text-slate-900">{{ __('Vikar Tjek-ind QR') }}</h3>
                <p class="text-xs text-slate-600 mt-1" x-text="activeQrTitle"></p>

                <!-- Dynamic QR preview via SimpleSoftwareIO or signed link -->
                <div class="my-5 p-3 sm:p-4 bg-slate-50 rounded-2xl border border-slate-200 inline-block shadow-inner max-w-full">
                    <img :src="'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' + encodeURIComponent('{{ url('/worker/shifts/scan') }}?shift=' + activeQrShift + '&token=' + activeQrToken)" alt="Vikar QR Kode" class="mx-auto rounded-lg max-w-[200px] sm:max-w-[220px] w-full h-auto">
                </div>

                <div class="text-[11px] text-slate-500 leading-relaxed">
                    {{ __('Bed vikaren om at åbne sit FreyaService-kamera og scanne denne kode for at stemple ind.') }}
                </div>

                <button type="button" @click="activeQrShift = null" class="mt-6 w-full py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition min-h-[44px]">
                    {{ __('Luk vindue') }}
                </button>
            </div>
        </div>

    </div>
</x-app-layout>
