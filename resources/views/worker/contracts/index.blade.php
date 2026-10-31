<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Ansættelseskontrakter') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Dine juridiske kontrakter og vilkår for vikariater gennem FreyaService.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <x-card padding="none">
            <x-slot:header>
                <div class="flex items-center gap-2">
                    <x-heroicon-o-document-text class="w-5 h-5 text-[#7B1E3A]" />
                    <h2 class="text-base font-bold text-slate-900">{{ __('Aktive og tidligere kontrakter') }}</h2>
                </div>
            </x-slot:header>

            <div class="divide-y divide-slate-100">
                @forelse($contracts as $c)
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] flex items-center justify-center shrink-0 mt-0.5">
                                <x-heroicon-o-document-check class="w-5 h-5 text-[#7B1E3A]" />
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-slate-900 text-sm">{{ __('Kontrakt') }} #{{ $c->contract_number }}</span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">{{ __($c->status) }}</span>
                                </div>
                                <div class="text-xs text-slate-600 mt-1 flex flex-wrap items-center gap-2">
                                    <span>{{ __('Type:') }} {{ __($c->type) }}</span>
                                    <span>&bull;</span>
                                    <span class="font-semibold text-slate-800">{{ __('Timeløn:') }} {{ number_format($c->hourly_rate, 2, ',', '.') }} DKK</span>
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                                    <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-slate-400" />
                                    <span>{{ __('Periode:') }} {{ $c->start_date->format('d.m.Y') }} @if($c->end_date) {{ __('til') }} {{ $c->end_date->format('d.m.Y') }} @endif</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">
                                <x-heroicon-s-check-badge class="w-4 h-4 text-emerald-600" />
                                <span>{{ __('Digitalt underskrevet') }}</span>
                            </span>
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