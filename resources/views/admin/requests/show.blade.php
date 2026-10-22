<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $staffRequest->status->badgeClasses() }}">
                        {{ $staffRequest->status->label() }}
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">⚡ {{ __('AKUT') }}</span>
                    @endif
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $staffRequest->role }} &bull; {{ $staffRequest->client->company_name ?? '' }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oprettet') }} {{ $staffRequest->created_at->format('d.m.Y H:i') }} &bull; {{ __('CVR:') }} {{ $staffRequest->client->cvr ?? '' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.matching.show', $staffRequest) }}" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                    🎯 {{ __('Kør Matchningsalgoritme') }} &rarr;
                </a>
                <a href="{{ route('admin.requests.index') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                    &larr; {{ __('Tilbage') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left: Request & Client Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info Card -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">{{ __('Ordredetaljer') }}</h2>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Virksomhed:') }}</span>
                            <span class="font-bold text-slate-900">{{ $staffRequest->client->company_name ?? '' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Kontaktperson:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->client->contact_person ?? '' }} ({{ $staffRequest->client->phone ?? '' }})</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Lokation:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->location }}, {{ $staffRequest->city }} ({{ $staffRequest->postcode }})</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Behov:') }}</span>
                            <span class="font-bold text-indigo-700">{{ $staffRequest->workers_needed }} {{ __('vikar(er)') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Periode:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->start_date->format('d.m.Y') }} @if($staffRequest->end_date) {{ __('til') }} {{ $staffRequest->end_date->format('d.m.Y') }} @endif</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Mødetid:') }}</span>
                            <span class="font-semibold text-slate-800">{{ $staffRequest->start_time ?? '-' }} - {{ $staffRequest->end_time ?? '-' }}</span>
                        </div>
                        @if($staffRequest->preferredWorker)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Kundens foretrukne vikar:') }}</span>
                                <span class="font-bold text-emerald-700">★ {{ $staffRequest->preferredWorker->user->name }}</span>
                            </div>
                        @endif
                        @if($staffRequest->instructions)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Instruktioner fra kunde:') }}</span>
                                <span class="text-slate-700">{{ $staffRequest->instructions }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Shifts & Assigned Workers -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <h2 class="text-base font-bold text-slate-900">{{ __('Vagter og tildelinger') }}</h2>

                        <!-- Add Shift Modal Toggle -->
                        <div x-data="{ openShift: false }">
                            <button type="button" @click="openShift = true" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-bold text-xs transition">
                                + {{ __('Opret ekstra vagt') }}
                            </button>

                            <!-- Modal -->
                            <div x-show="openShift" x-cloak class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
                                <div @click.away="openShift = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                    <h3 class="text-base font-bold text-slate-900">{{ __('Tilføj ny vagt') }}</h3>
                                    <form method="POST" action="{{ route('admin.requests.add-shift', $staffRequest) }}" class="mt-4 space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Vagttitel') }}</label>
                                            <input type="text" name="title" value="{{ $staffRequest->role }} {{ __('vagt') }}" class="w-full text-xs rounded-xl border-slate-300">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Start (dato & tid)') }}</label>
                                                <input type="datetime-local" name="start_at" required class="w-full text-xs rounded-xl border-slate-300">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Slut (dato & tid)') }}</label>
                                                <input type="datetime-local" name="end_at" required class="w-full text-xs rounded-xl border-slate-300">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Antal personer') }}</label>
                                            <input type="number" name="workers_needed" min="1" value="1" required class="w-full text-xs rounded-xl border-slate-300">
                                        </div>
                                        <div class="flex justify-end gap-2 pt-2">
                                            <button type="button" @click="openShift = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                            <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-indigo-600 text-white hover:bg-indigo-700">{{ __('Opret vagt') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse($staffRequest->shifts as $shift)
                            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-3">
                                <div class="flex justify-between items-center text-xs">
                                    <div>
                                        <span class="font-bold text-slate-900">{{ $shift->title }}</span>
                                        <span class="text-slate-500 block">{{ $shift->start_at->format('d.m.Y H:i') }} - {{ $shift->end_at->format('H:i') }}</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-200 text-slate-700">{{ $shift->status->label() }}</span>
                                </div>

                                <div class="space-y-1.5 pt-2 border-t border-slate-200/60">
                                    @forelse($shift->assignments as $asgn)
                                        <div class="p-2.5 bg-white rounded-lg border border-slate-200 flex justify-between items-center text-xs">
                                            <div>
                                                <span class="font-bold text-slate-900">{{ $asgn->worker->user->name ?? __('Vikar') }}</span>
                                                <span class="text-slate-500 text-[11px] block">{{ __('Løn:') }} {{ $asgn->worker_hourly_rate }} DKK/t &bull; {{ __('Rating:') }} ★ {{ $asgn->worker->rating_avg }}</span>
                                            </div>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-indigo-50 text-indigo-700">{{ $asgn->status->label() }}</span>
                                        </div>
                                    @empty
                                        <div class="text-xs text-slate-400 italic">{{ __('Ingen vikarer tildelt endnu. Klik på "Match Vikarer" foroven.') }}</div>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">{{ __('Ingen vagter oprettet endnu.') }}</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right: Admin Status Management -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">{{ __('Opdater ordrestatus') }}</h2>

                    <form method="POST" action="{{ route('admin.requests.update-status', $staffRequest) }}" class="space-y-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300">
                                <option value="new" {{ $staffRequest->status->value === 'new' ? 'selected' : '' }}>{{ __('Ny') }}</option>
                                <option value="in_progress" {{ $staffRequest->status->value === 'in_progress' ? 'selected' : '' }}>{{ __('Under matchning') }}</option>
                                <option value="matched" {{ $staffRequest->status->value === 'matched' ? 'selected' : '' }}>{{ __('Vikar matchet') }}</option>
                                <option value="active" {{ $staffRequest->status->value === 'active' ? 'selected' : '' }}>{{ __('Aktiv på lokation') }}</option>
                                <option value="completed" {{ $staffRequest->status->value === 'completed' ? 'selected' : '' }}>{{ __('Afsluttet / Gennemført') }}</option>
                                <option value="cancelled" {{ $staffRequest->status->value === 'cancelled' ? 'selected' : '' }}>{{ __('Annulleret') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            {{ __('Gem statusændring') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
