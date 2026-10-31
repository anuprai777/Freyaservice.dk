<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Dokumenter & Certifikater') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Upload og administrer dine arbejdstilladelser, hygiejnebeviser, ID og kontrakter.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Upload New Document Form -->
            <div class="md:col-span-1">
                <x-card class="space-y-4">
                    <x-slot:header>
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-arrow-up-tray class="w-5 h-5 text-[#7B1E3A]" />
                            <h2 class="text-base font-bold text-slate-900">{{ __('Upload nyt dokument') }}</h2>
                        </div>
                    </x-slot:header>

                    <form method="POST" action="{{ route('worker.documents.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="type" :value="__('Dokumenttype')" />
                            <select id="type" name="type" required class="mt-1 block w-full rounded-xl border-slate-300 text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                <option value="work_permit">{{ __('Arbejdstilladelse') }}</option>
                                <option value="certificate">{{ __('Certifikat / Hygiejnebevis / Kørekort') }}</option>
                                <option value="id">{{ __('Legitimation / Pas / Opholdskort') }}</option>
                                <option value="contract">{{ __('Underskrevet kontrakt') }}</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="document_file" :value="__('Vælg fil (PDF, JPG, PNG - maks. 10MB)')" />
                            <input id="document_file" type="file" name="document_file" required class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#FAF5F2] file:text-[#7B1E3A] hover:file:bg-[#F3E3E6] cursor-pointer">
                            <x-input-error :messages="$errors->get('document_file')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="expiry_date" :value="__('Udløbsdato (hvis relevant)')" />
                            <x-text-input id="expiry_date" type="date" name="expiry_date" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" />
                            <x-input-error :messages="$errors->get('expiry_date')" class="mt-1" />
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs shadow-xs transition">
                                <x-heroicon-s-lock-closed class="w-3.5 h-3.5 text-[#C9A24B]" />
                                <span>{{ __('Upload dokument sikkert') }}</span>
                            </button>
                        </div>
                    </form>
                </x-card>
            </div>

            <!-- Documents Container -->
            <div class="md:col-span-2">
                <x-card padding="none">
                    <x-slot:header>
                        <div class="flex justify-between items-center w-full">
                            <div class="flex items-center gap-2">
                                <x-heroicon-o-folder class="w-5 h-5 text-[#7B1E3A]" />
                                <h2 class="text-sm sm:text-base font-bold text-slate-900">{{ __('Dine uploadede dokumenter') }}</h2>
                            </div>
                            <span class="text-xs text-slate-500">{{ $documents->count() }} {{ __('filer') }}</span>
                        </div>
                    </x-slot:header>

                    <!-- Mobile Stacked Card List (screens < md) -->
                    <div class="md:hidden divide-y divide-slate-100">
                        @forelse($documents as $doc)
                            <div class="p-4 space-y-2.5 hover:bg-slate-50/50 transition">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-sm text-slate-900">{{ $doc->type->label() }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        @if($doc->status->value === 'approved') bg-emerald-100 text-emerald-800
                                        @elseif($doc->status->value === 'rejected') bg-rose-100 text-rose-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ $doc->status->label() }}
                                    </span>
                                </div>

                                <div class="text-xs text-slate-600 truncate flex items-center gap-1.5">
                                    <x-heroicon-o-document class="w-4 h-4 text-slate-400 shrink-0" />
                                    <span class="truncate">{{ $doc->original_filename }}</span>
                                </div>

                                <div class="text-xs text-slate-500 flex items-center justify-between pt-1">
                                    <div>
                                        @if($doc->expiry_date)
                                            <span class="{{ $doc->isExpired() ? 'text-rose-600 font-bold' : ($doc->isExpiringSoon() ? 'text-amber-600 font-bold' : 'text-slate-600') }}">
                                                {{ __('Udløber:') }} {{ $doc->expiry_date->format('d.m.Y') }}
                                                @if($doc->isExpired()) ({{ __('Udløbet!') }})
                                                @elseif($doc->isExpiringSoon()) ({{ __('Snart') }}) @endif
                                            </span>
                                        @else
                                            <span class="text-slate-400">{{ __('Ingen udløbsdato') }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('worker.documents.download', $doc) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#FAF5F2] text-[#7B1E3A] font-bold text-xs hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 transition shadow-xs">
                                        <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                        <span>{{ __('Hent') }}</span>
                                    </a>
                                </div>

                                @if($doc->rejection_reason)
                                    <div class="text-[11px] text-rose-600 bg-rose-50 p-2 rounded-lg border border-rose-100 mt-1">
                                        <strong>{{ __('Årsag:') }}</strong> {{ $doc->rejection_reason }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-xs">
                                {{ __('Du har ikke uploadet nogen dokumenter endnu. Upload dit ID og eventuelle certifikater for hurtigere godkendelse.') }}
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop Full Table (screens >= md) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                                <tr>
                                    <th class="p-4">{{ __('Type') }}</th>
                                    <th class="p-4">{{ __('Filnavn') }}</th>
                                    <th class="p-4">{{ __('Udløber') }}</th>
                                    <th class="p-4">{{ __('Status') }}</th>
                                    <th class="p-4 text-right">{{ __('Handling') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($documents as $doc)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-4 font-bold text-slate-900">
                                            <div class="flex items-center gap-1.5">
                                                <x-heroicon-o-document-text class="w-3.5 h-3.5 text-slate-400" />
                                                <span>{{ $doc->type->label() }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-slate-600">{{ $doc->original_filename }}</td>
                                        <td class="p-4">
                                            @if($doc->expiry_date)
                                                <span class="{{ $doc->isExpired() ? 'text-rose-600 font-bold' : ($doc->isExpiringSoon() ? 'text-amber-600 font-bold' : 'text-slate-600') }}">
                                                    {{ $doc->expiry_date->format('d.m.Y') }}
                                                    @if($doc->isExpired()) ({{ __('Udløbet!') }})
                                                    @elseif($doc->isExpiringSoon()) ({{ __('Udløber snart') }}) @endif
                                                </span>
                                            @else
                                                <span class="text-slate-400">{{ __('Ingen udløbsdato') }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase
                                                @if($doc->status->value === 'approved') bg-emerald-100 text-emerald-800
                                                @elseif($doc->status->value === 'rejected') bg-rose-100 text-rose-800
                                                @else bg-amber-100 text-amber-800 @endif">
                                                {{ $doc->status->label() }}
                                            </span>
                                            @if($doc->rejection_reason)
                                                <div class="text-[10px] text-rose-600 mt-1">{{ __('Årsag:') }} {{ $doc->rejection_reason }}</div>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right">
                                            <a href="{{ route('worker.documents.download', $doc) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#FAF5F2] text-[#7B1E3A] hover:bg-[#F3E3E6] border border-[#7B1E3A]/20 font-bold text-xs transition shadow-xs">
                                                <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                                <span>{{ __('Hent fil') }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-slate-400">
                                            {{ __('Du har ikke uploadet nogen dokumenter endnu. Upload dit ID og eventuelle certifikater for hurtigere godkendelse.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>