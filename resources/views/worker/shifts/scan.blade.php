<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-navy tracking-tight">{{ __('QR Tjek-ind på Lokation') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('Scan kundens QR-kode på arbejdspladsen for at starte din vagt.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-mist bg-white text-xs font-bold text-ink/70 hover:text-navy hover:bg-sand shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-md mx-auto px-4 sm:px-6 space-y-6">

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
                <x-heroicon-s-x-circle class="w-4 h-4 text-rose-600 shrink-0" />
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <x-card variant="white" class="text-center space-y-6">
            <div class="w-16 h-16 rounded-2xl bg-burgundy/10 text-burgundy flex items-center justify-center mx-auto shadow-inner border border-burgundy/20">
                <x-heroicon-o-qr-code class="w-8 h-8 text-burgundy" />
            </div>

            <div>
                <h2 class="text-base font-bold text-navy">{{ __('Scan QR-kode hos kunden') }}</h2>
                <p class="text-xs text-ink/70 mt-1 leading-relaxed">
                    {{ __('Når du ankommer til kundens lokation, beder du om at se deres FreyaService QR-kode og scanner den med dit kamera eller indtaster koden nedenfor.') }}
                </p>
            </div>

            <!-- Manual Token Form fallback -->
            <div class="pt-4 border-t border-mist text-left">
                <form method="GET" action="{{ route('worker.shifts.scan') }}" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-navy mb-1">{{ __('Vagt-ID (fra kundens skærm)') }}</label>
                        <input type="number" name="shift" required class="w-full text-xs rounded-xl border-mist" placeholder="{{ __('Eks. 1') }}">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-navy mb-1">{{ __('Sikkerhedstoken') }}</label>
                        <input type="text" name="token" required class="w-full text-xs rounded-xl border-mist" placeholder="{{ __('Indtast 40-tegns kode') }}">
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white font-bold text-xs shadow-xs transition cursor-pointer flex items-center justify-center gap-1.5">
                        <x-heroicon-s-check class="w-4 h-4" />
                        <span>{{ __('Valider og Tjek Ind') }}</span>
                    </button>
                </form>
            </div>
        </x-card>

    </div>
</x-app-layout>
