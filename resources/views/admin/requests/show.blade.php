<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $staffRequest->status->badgeClasses() }}">
                        {{ $staffRequest->status->label() }}
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">
                            <x-heroicon-s-bolt class="w-3 h-3 text-rose-600" />
                            <span>{{ __('AKUT') }}</span>
                        </span>
                    @endif
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $staffRequest->role }} &bull; {{ $staffRequest->client->company_name ?? '' }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Oprettet') }} {{ $staffRequest->created_at->format('d.m.Y H:i') }} &bull; {{ __('CVR:') }} {{ $staffRequest->client->cvr ?? '' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.matching.show', $staffRequest) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                    <x-heroicon-s-sparkles class="w-3.5 h-3.5 text-[#C9A24B]" />
                    <span>{{ __('Kør Matchningsalgoritme') }}</span>
                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                </a>
                <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                    <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                    <span>{{ __('Tilbage') }}</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left: Request & Client Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Info Card -->
                <x-card title="{{ __('Ordredetaljer') }}">
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Virksomhed:') }}</span>
                            <span class="font-bold text-slate-900 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-slate-400" />
                                {{ $staffRequest->client->company_name ?? '' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Kontaktperson:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-user class="w-3.5 h-3.5 text-slate-400" />
                                {{ $staffRequest->client->contact_person ?? '' }} ({{ $staffRequest->client->phone ?? '' }})
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Lokation:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400" />
                                {{ $staffRequest->location }}, {{ $staffRequest->city }} ({{ $staffRequest->postcode }})
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Behov:') }}</span>
                            <span class="font-bold text-[#7B1E3A] flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-users class="w-3.5 h-3.5 text-[#7B1E3A]" />
                                {{ $staffRequest->workers_needed }} {{ __('vikar(er)') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Periode:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-slate-400" />
                                {{ $staffRequest->start_date->format('d.m.Y') }} @if($staffRequest->end_date) {{ __('til') }} {{ $staffRequest->end_date->format('d.m.Y') }} @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Mødetid:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-clock class="w-3.5 h-3.5 text-slate-400" />
                                {{ $staffRequest->start_time ?? '-' }} - {{ $staffRequest->end_time ?? '-' }}
                            </span>
                        </div>
                        @if($staffRequest->preferredWorker)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Kundens foretrukne vikar:') }}</span>
                                <span class="font-bold text-emerald-700 flex items-center gap-1 mt-0.5">
                                    <x-heroicon-s-star class="w-3.5 h-3.5 text-amber-500" />
                                    {{ $staffRequest->preferredWorker->user->name }}
                                </span>
                            </div>
                        @endif
                        @if($staffRequest->instructions)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Instruktioner fra kunde:') }}</span>
                                <span class="text-slate-700 mt-0.5 block">{{ $staffRequest->instructions }}</span>
                            </div>
                        @endif
                    </div>
                </x-card>

                <!-- Shifts & Assigned Workers -->
                <x-card>
                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-calendar class="w-5 h-5 text-[#7B1E3A]" />
                            <h2 class="text-base font-bold text-slate-900">{{ __('Vagter og tildelinger') }}</h2>
                        </div>

                        <!-- Add Shift Modal Toggle -->
                        <div x-data="{ openShift: false }">
                            <button type="button" @click="openShift = true" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 font-bold text-xs transition">
                                <x-heroicon-s-plus class="w-3.5 h-3.5" />
                                <span>{{ __('Opret ekstra vagt') }}</span>
                            </button>

                            <!-- Modal -->
                            <div x-show="openShift" x-cloak class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
                                <div @click.away="openShift = false" class="bg-white rounded-2xl max-w-md w-full p-6 text-left shadow-2xl">
                                    <h3 class="text-base font-bold text-slate-900">{{ __('Tilføj ny vagt') }}</h3>
                                    <form method="POST" action="{{ route('admin.requests.add-shift', $staffRequest) }}" class="mt-4 space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Vagttitel') }}</label>
                                            <input type="text" name="title" value="{{ $staffRequest->role }} {{ __('vagt') }}" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                        </div>
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Start (dato & tid)') }}</label>
                                                <input type="datetime-local" name="start_at" required class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Slut (dato & tid)') }}</label>
                                                <input type="datetime-local" name="end_at" required class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Antal personer') }}</label>
                                            <input type="number" name="workers_needed" min="1" value="1" required class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                        </div>
                                        <div class="flex justify-end gap-2 pt-2">
                                            <button type="button" @click="openShift = false" class="px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ __('Annuller') }}</button>
                                            <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#7B1E3A] text-white hover:bg-[#5A1429]">{{ __('Opret vagt') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-3">
                        @forelse($staffRequest->shifts as $shift)
                            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 space-y-3">
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
                                                <span class="text-slate-500 text-[11px] flex items-center gap-1 mt-0.5">
                                                    <span>{{ __('Løn:') }} {{ $asgn->worker_hourly_rate }} DKK/t</span>
                                                    <span>&bull;</span>
                                                    <span class="inline-flex items-center gap-0.5">
                                                        <x-heroicon-s-star class="w-3 h-3 text-amber-500" />
                                                        <span>{{ $asgn->worker->rating_avg }}</span>
                                                    </span>
                                                </span>
                                            </div>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-[#FAF5F2] text-[#7B1E3A] border border-[#7B1E3A]/20">{{ $asgn->status->label() }}</span>
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
                </x-card>
            </div>

            <!-- Right: Admin Status Management -->
            <div class="space-y-6">
                <x-card title="{{ __('Opdater ordrestatus') }}">
                    <form method="POST" action="{{ route('admin.requests.update-status', $staffRequest) }}" class="space-y-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                <option value="new" {{ $staffRequest->status->value === 'new' ? 'selected' : '' }}>{{ __('Ny') }}</option>
                                <option value="in_progress" {{ $staffRequest->status->value === 'in_progress' ? 'selected' : '' }}>{{ __('Under matchning') }}</option>
                                <option value="matched" {{ $staffRequest->status->value === 'matched' ? 'selected' : '' }}>{{ __('Vikar matchet') }}</option>
                                <option value="active" {{ $staffRequest->status->value === 'active' ? 'selected' : '' }}>{{ __('Aktiv på lokation') }}</option>
                                <option value="completed" {{ $staffRequest->status->value === 'completed' ? 'selected' : '' }}>{{ __('Afsluttet / Gennemført') }}</option>
                                <option value="cancelled" {{ $staffRequest->status->value === 'cancelled' ? 'selected' : '' }}>{{ __('Annulleret') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs transition shadow-xs">
                            {{ __('Gem statusændring') }}
                        </button>
                    </form>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>
