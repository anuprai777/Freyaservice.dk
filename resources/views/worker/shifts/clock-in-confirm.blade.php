<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Bekræft Tjek-Ind') }}</h1>
    </x-slot>

    <div class="py-12 max-w-md mx-auto px-4 sm:px-6">
        <x-card padding="lg" class="text-center space-y-6 shadow-xl">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-3xl">
                ✓
            </div>

            <div>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">
                    {{ __('Korrekt QR-kode verificeret') }}
                </span>
                <h2 class="text-xl font-black text-slate-900 mt-2">{{ $shift->title }}</h2>
                <div class="text-xs text-slate-600 mt-1">
                    🏢 {{ $shift->staffRequest->client->company_name ?? __('Kunde') }}
                </div>
                <div class="text-xs text-slate-500 mt-1">
                    📍 {{ $shift->staffRequest->location }}, {{ $shift->staffRequest->city }}
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 text-left space-y-1">
                <div><strong>{{ __('Planlagt tid:') }}</strong> {{ $shift->start_at->format('H:i') }} {{ __('til') }} {{ $shift->end_at->format('H:i') }}</div>
                <div><strong>{{ __('Nuværende tid:') }}</strong> {{ now()->format('H:i:s') }}</div>
                <div><strong>{{ __('Dato:') }}</strong> {{ now()->format('d. F Y') }}</div>
            </div>

            <form method="POST" action="{{ route('worker.shifts.clock-in') }}">
                @csrf
                <input type="hidden" name="shift_id" value="{{ $shift->id }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <button type="submit" class="w-full py-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-base shadow-lg shadow-emerald-600/20 transition transform hover:-translate-y-0.5">
                    ⏱️ {{ __('Start Vagt & Stempel Ind Nu') }}
                </button>
            </form>

            <a href="{{ route('worker.dashboard') }}" class="block text-xs text-slate-400 hover:text-slate-600">
                {{ __('Annuller og vend tilbage') }}
            </a>
        </x-card>
    </div>
</x-app-layout>
