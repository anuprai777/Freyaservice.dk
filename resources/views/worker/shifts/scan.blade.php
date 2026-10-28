<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('QR Tjek-ind på Lokation') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Scan kundens QR-kode på arbejdspladsen for at starte din vagt.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; {{ __('Tilbage') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-md mx-auto px-4 sm:px-6 space-y-6">

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <x-card class="text-center space-y-6">
            <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto text-2xl shadow-inner">
                📷
            </div>

            <div>
                <h2 class="text-base font-bold text-slate-900">{{ __('Scan QR-kode hos kunden') }}</h2>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    {{ __('Når du ankommer til kundens lokation, beder du om at se deres FreyaService QR-kode og scanner den med dit kamera eller indtaster koden nedenfor.') }}
                </p>
            </div>

            <!-- Manual Token Form fallback -->
            <div class="pt-4 border-t border-slate-100 text-left">
                <form method="GET" action="{{ route('worker.shifts.scan') }}" class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Vagt-ID (fra kundens skærm)') }}</label>
                        <input type="number" name="shift" required class="w-full text-xs rounded-xl border-slate-300" placeholder="{{ __('Eks. 1') }}">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Sikkerhedstoken') }}</label>
                        <input type="text" name="token" required class="w-full text-xs rounded-xl border-slate-300" placeholder="{{ __('Indtast 40-tegns kode') }}">
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                        {{ __('Valider og Tjek Ind') }} &rarr;
                    </button>
                </form>
            </div>
        </x-card>

    </div>
</x-app-layout>
