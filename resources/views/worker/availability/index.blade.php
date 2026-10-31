<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-burgundy/10 text-burgundy border border-burgundy/20">
                        {{ __('Vagtplan') }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-navy tracking-tight">{{ __('Rådighedskalender & Arbejdstider') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('Angiv hvilke dage og tidsrum du er til rådighed for vikardækning.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-mist bg-white text-xs font-bold text-ink/70 hover:text-navy hover:bg-sand shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2.5 shadow-xs">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <x-card padding="lg" variant="white">
            <form method="POST" action="{{ route('worker.availability.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="border-b border-mist pb-3 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0">
                            <x-heroicon-o-calendar-days class="w-5 h-5 text-burgundy" />
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-navy">{{ __('Ugentlig tilbagevendende rådighed') }}</h2>
                            <p class="text-xs text-ink/70 mt-0.5">{{ __('Vores matchningsalgoritme foreslår kun vagter, der passer til dine åbningstider.') }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs text-emerald-700 font-bold bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/70">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ __('Auto-matching aktiv') }}</span>
                    </span>
                </div>

                <div class="space-y-3">
                    @foreach($days as $dayKey => $dayName)
                        @php $av = $availabilities->get($dayKey); @endphp
                        <div x-data="{ enabled: {{ ($av && $av->is_available) || ! $av ? 'true' : 'false' }} }"
                            class="p-4 rounded-xl border border-mist bg-brand-surface/30 hover:bg-brand-surface/60 transition flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">

                            <div class="flex items-center gap-3 w-full sm:w-48">
                                <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                    <input type="checkbox" name="days[{{ $dayKey }}][is_available]" value="1" x-model="enabled" class="sr-only peer">
                                    <div class="w-10 h-5 bg-sand-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-mist after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-burgundy"></div>
                                </label>
                                <span class="font-bold text-sm text-navy">{{ __($dayName) }}</span>
                            </div>

                            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 sm:gap-3 w-full sm:w-auto" x-show="enabled">
                                <div class="flex items-center gap-1.5 text-xs text-ink/80 flex-1 sm:flex-initial">
                                    <x-heroicon-o-clock class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                    <span>{{ __('Fra:') }}</span>
                                    <input type="time" name="days[{{ $dayKey }}][start_time]" value="{{ $av ? substr($av->start_time, 0, 5) : '08:00' }}" class="text-xs rounded-lg border-mist py-1.5 px-2 w-full sm:w-auto bg-white">
                                </div>
                                <div class="flex items-center gap-1.5 text-xs text-ink/80 flex-1 sm:flex-initial">
                                    <x-heroicon-o-clock class="w-3.5 h-3.5 text-ink/40 shrink-0" />
                                    <span>{{ __('Til:') }}</span>
                                    <input type="time" name="days[{{ $dayKey }}][end_time]" value="{{ $av ? substr($av->end_time, 0, 5) : '16:00' }}" class="text-xs rounded-lg border-mist py-1.5 px-2 w-full sm:w-auto bg-white">
                                </div>
                            </div>

                            <div x-show="!enabled" class="text-xs text-ink/50 italic">
                                {{ __('Ikke til rådighed på denne ugedag') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-mist flex justify-end">
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white font-bold text-sm shadow-xs transition text-center cursor-pointer">
                        <x-heroicon-s-check class="w-4 h-4" />
                        <span>{{ __('Gem rådighedsplan') }}</span>
                    </button>
                </div>
            </form>
        </x-card>

    </div>
</x-app-layout>
