<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                        {{ __('Smart Match-Motor') }}
                    </span>
                    @if($staffRequest->is_urgent)
                        <span class="px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[10px]">⚡ {{ __('AKUT') }}</span>
                    @endif
                </div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Kandidater til:') }} {{ $staffRequest->role }} ({{ $staffRequest->client->company_name ?? '' }})</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Lokation:') }} {{ $staffRequest->city }} &bull; {{ __('Dato:') }} {{ $staffRequest->start_date->format('d.m.Y') }} &bull; {{ __('Behov:') }} {{ $staffRequest->workers_needed }} {{ __('vikar(er)') }}</p>
            </div>
            <a href="{{ route('admin.requests.show', $staffRequest) }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; {{ __('Tilbage til forespørgsel') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

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

        <!-- Scoring Criteria Legend -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">{{ __('FreyaService Scoringsmodel (Maks 100 point)') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-3 text-xs">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Fagkompetencer') }}</span>
                    <span class="text-indigo-600 font-bold">{{ __('Maks 35 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Afstand / By') }}</span>
                    <span class="text-indigo-600 font-bold">{{ __('Maks 25 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Rådighedsplan') }}</span>
                    <span class="text-indigo-600 font-bold">{{ __('Maks 20 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Kundebedømmelse') }}</span>
                    <span class="text-indigo-600 font-bold">{{ __('Maks 10 point') }}</span>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="font-bold text-slate-900 block">{{ __('Dokumenter/ID') }}</span>
                    <span class="text-indigo-600 font-bold">{{ __('Maks 10 point') }}</span>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200">
                    <span class="font-bold text-amber-900 block">{{ __('Kundens favorit') }}</span>
                    <span class="text-amber-700 font-bold">{{ __('+10 bonuspoint') }}</span>
                </div>
            </div>
        </div>

        <!-- Scored Candidates List -->
        <div class="space-y-4">
            <h2 class="text-base font-bold text-slate-900">{{ __('Bedst matchende godkendte vikarer') }} ({{ $candidates->count() }})</h2>

            @forelse($candidates as $candidate)
                @php
                    $worker = $candidate['worker'];
                    $score = $candidate['total_score'];
                    $bd = $candidate['breakdown'];
                    $isAlreadyOffered = in_array($worker->id, $assignedWorkerIds, true);
                @endphp

                <div class="bg-white rounded-2xl border {{ $score >= 70 ? 'border-indigo-200 ring-1 ring-indigo-100' : 'border-slate-200' }} shadow-sm p-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="space-y-3 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Overall Score Badge -->
                            <div class="w-12 h-12 rounded-2xl font-black text-base flex items-center justify-center shadow-sm
                                @if($score >= 80) bg-emerald-600 text-white
                                @elseif($score >= 60) bg-indigo-600 text-white
                                @else bg-slate-700 text-white @endif">
                                {{ $score }}%
                            </div>

                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-bold text-slate-900">{{ $worker->user->name }}</h3>
                                    @if($candidate['is_favourite'])
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            ★ {{ __('Kundens Favorit') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-500">
                                    📍 {{ $worker->city }} ({{ $worker->postcode }}) &bull; {{ __('Tlf:') }} {{ $worker->user->phone }} &bull; {{ __('Standard timeløn:') }} {{ number_format($worker->hourly_rate, 2, ',', '.') }} DKK
                                </div>
                            </div>
                        </div>

                        <!-- Score breakdown pills -->
                        <div class="flex flex-wrap gap-2 text-[11px]">
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Kompetencer:') }} <strong>{{ $bd['skill_score'] }}/35</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Afstand:') }} <strong>{{ $bd['distance_score'] }}/25</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Rådighed:') }} <strong>{{ $bd['availability_score'] }}/20</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Rating:') }} <strong>★ {{ $worker->rating_avg }} ({{ $bd['rating_score'] }}/10)</strong></span>
                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700">{{ __('Dokumenter:') }} <strong>{{ $bd['document_score'] }}/10</strong></span>
                        </div>

                        <!-- Worker Skills -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach((array)$worker->skills as $skill)
                                <span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 text-slate-600 font-medium">
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

                                <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md transition transform hover:-translate-y-0.5">
                                    🚀 {{ __('Send Tilbud i 1-Klik') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 text-slate-400 text-sm">
                    {{ __('Ingen godkendte vikarer fundet i systemet. Opret eller godkend vikarer under Vikarer CRM.') }}
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
