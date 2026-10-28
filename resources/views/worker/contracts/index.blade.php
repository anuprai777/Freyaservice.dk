<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ __('Ansættelseskontrakter') }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Dine juridiske kontrakter og vilkår for vikariater gennem FreyaService.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">
                &larr; {{ __('Tilbage') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <x-card padding="none">
            <x-slot:header>
                <h2 class="text-base font-bold text-slate-900">{{ __('Aktive og tidligere kontrakter') }}</h2>
            </x-slot:header>

            <div class="divide-y divide-slate-100">
                @forelse($contracts as $c)
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50/50">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-900 text-sm">{{ __('Kontrakt') }} #{{ $c->contract_number }}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">{{ __($c->status) }}</span>
                            </div>
                            <div class="text-xs text-slate-600 mt-1">
                                {{ __('Type:') }} {{ __($c->type) }} • {{ __('Timeløn:') }} {{ number_format($c->hourly_rate, 2, ',', '.') }} DKK
                            </div>
                            <div class="text-xs text-slate-400 mt-0.5">
                                {{ __('Periode:') }} {{ $c->start_date->format('d.m.Y') }} @if($c->end_date) {{ __('til') }} {{ $c->end_date->format('d.m.Y') }} @endif
                            </div>
                        </div>

                        <div>
                            <span class="text-xs text-slate-400 italic">{{ __('Digitalt underskrevet') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 text-xs">
                        {{ __('Ingen særskilte kontrakter udstedt endnu. Dine vilkår er reguleret af FreyaServices standard vikaraftale.') }}
                    </div>
                @endforelse
            </div>
        </x-card>
    </div>
</x-app-layout>
