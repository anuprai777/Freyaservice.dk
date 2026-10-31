<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#FAF5F2] text-[#7B1E3A] border border-[#7B1E3A]/20">
                        <x-heroicon-s-sparkles class="w-3.5 h-3.5 text-[#C9A24B]" />
                        <span>{{ __('Smart Match-Motor') }}</span>
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">
                            <x-heroicon-s-bolt class="w-3 h-3 text-rose-600" />
                            <span>{{ __('AKUT') }}</span>
                        </span>
                    @endif
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Kandidater til:') }} {{ $staffRequest->role }} ({{ $staffRequest->client->company_name ?? '' }})</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Lokation:') }} {{ $staffRequest->city }} &bull; {{ __('Dato:') }} {{ $staffRequest->start_date->format('d.m.Y') }} &bull; {{ __('Behov:') }} {{ $staffRequest->workers_needed }} {{ __('vikar(er)') }}</p>
            </div>
            <a href="{{ route('admin.requests.show', $staffRequest) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til forespørgsel') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-amber-600 shrink-0" />
                <span>{{ session('warning') }}</span>
            </div>
        @endif

        <!-- Scoring Criteria Legend -->
        <x-card>
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('FreyaService Scoringsmodel (Maks 100 point)') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-3 text-xs">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Fagkompetencer') }}</span>
                    <span class="text-[#7B1E3A] font-bold">{{ __('Maks 35 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Afstand / By') }}</span>
                    <span class="text-[#7B1E3A] font-bold">{{ __('Maks 25 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Rådighedsplan') }}</span>
                    <span class="text-[#7B1E3A] font-bold">{{ __('Maks 20 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Kundebedømmelse') }}</span>
                    <span class="text-[#7B1E3A] font-bold">{{ __('Maks 10 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Dokumenter/ID') }}</span>
                    <span class="text-[#7B1E3A] font-bold">{{ __('Maks 10 point') }}</span>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                    <span class="font-bold text-amber-900 block">{{ __('Kundens favorit') }}</span>
                    <span class="text-amber-700 font-bold">{{ __('+10 bonuspoint') }}</span>
                </div>
            </div>
        </x-card>

        <!-- Scored Candidates List -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <x-heroicon-o-user-group class="w-5 h-5 text-[#7B1E3A]" />
                    <span>{{ __('Bedst matchende godkendte vikarer') }} ({{ $candidates->count() }})</span>
                </h2>
            </div>

            @forelse($candidates as $candidate)
                @php
                    $worker = $candidate['worker'];
                    $score = $candidate['total_score'];
                    $bd = $candidate['breakdown'];
                    $isAlreadyOffered = in_array($worker->id, $assignedWorkerIds, true);
                @endphp

                <x-card hover="true" class="{{ $score >= 70 ? 'ring-1 ring-[#7B1E3A]/20 border-[#7B1E3A]/30' : '' }} flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="space-y-3 flex-1">
                        <div class="flex flex-wrap items-center gap-3">
                            <!-- Overall Score Badge -->
                            <div class="w-12 h-12 rounded-2xl font-black text-base flex items-center justify-center shadow-xs shrink-0
                                @if($score >= 80) bg-emerald-600 text-white
                                @elseif($score >= 60) bg-[#7B1E3A] text-white
                                @else bg-slate-700 text-white @endif">
                                {{ $score }}%
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold text-slate-900">{{ $worker->user->name }}</h3>
                                    @if($candidate['is_favourite'])
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            <x-heroicon-s-star class="w-3 h-3 text-amber-500" />
                                            <span>{{ __('Kundens Favorit') }}</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-500 flex flex-wrap items-center gap-x-2 gap-y-1 mt-0.5">
                                    <span class="inline-flex items-center gap-1">
                                        <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400" />
                                        {{ $worker->city }} ({{ $worker->postcode }})
                                    </span>
                                    <span>&bull;</span>
                                    <span class="inline-flex items-center gap-1">
                                        <x-heroicon-o-phone class="w-3.5 h-3.5 text-slate-400" />
                                        {{ $worker->user->phone }}
                                    </span>
                                    <span>&bull;</span>
                                    <span class="inline-flex items-center gap-1">
                                        <x-heroicon-o-banknotes class="w-3.5 h-3.5 text-slate-400" />
                                        {{ number_format($worker->hourly_rate, 2, ',', '.') }} DKK/t
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Score breakdown pills -->
                        <div class="flex flex-wrap gap-2 text-[11px]">
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Kompetencer:') }} <strong>{{ $bd['skill_score'] }}/35</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Afstand:') }} <strong>{{ $bd['distance_score'] }}/25</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Rådighed:') }} <strong>{{ $bd['availability_score'] }}/20</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700 inline-flex items-center gap-1">
                                <span>{{ __('Rating:') }}</span>
                                <x-heroicon-s-star class="w-3 h-3 text-amber-500 inline" />
                                <strong>{{ $worker->rating_avg }} ({{ $bd['rating_score'] }}/10)</strong>
                            </span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Dokumenter:') }} <strong>{{ $bd['document_score'] }}/10</strong></span>
                        </div>

                        <!-- Worker Skills -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach((array)$worker->skills as $skill)
                                <span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 text-slate-600 font-medium border border-slate-200/60">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Dispatch Form -->
                    <div class="w-full lg:w-auto pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100 flex items-center justify-end">
                        @if($isAlreadyOffered)
                            <span class="px-4 py-2 rounded-xl bg-slate-100 text-slate-500 font-bold text-xs uppercase tracking-wide">
                                {{ __('Allerede tildelt / Tilbudt') }}
                            </span>
                        @else
                            <form method="POST" action="{{ route('admin.matching.dispatch', $staffRequest) }}">
                                @csrf
                                <input type="hidden" name="worker_id" value="{{ $worker->id }}">
                                @if($staffRequest->shifts->isNotEmpty())
                                    <input type="hidden" name="shift_id" value="{{ $staffRequest->shifts->first()->id }}">
                                @endif

                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-md transition transform hover:-translate-y-0.5">
                                    <x-heroicon-s-paper-airplane class="w-4 h-4 text-[#C9A24B]" />
                                    <span>{{ __('Send Tilbud i 1-Klik') }}</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </x-card>
            @empty
                <x-card class="text-center py-12 text-slate-400 text-sm">
                    {{ __('Ingen godkendte vikarer fundet i systemet. Opret eller godkend vikarer under Vikarer CRM.') }}
                </x-card>
            @endforelse
        </div>

    </div>
</x-app-layout>
