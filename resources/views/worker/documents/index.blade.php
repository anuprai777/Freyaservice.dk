<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Dokumenter & Certifikater</h1>
                <p class="text-xs text-slate-500 mt-0.5">Upload og administrer dine arbejdstilladelser, hygiejnebeviser, ID og kontrakter.</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>Tilbage</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 sm:space-y-8">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Upload New Document Form -->
            <div class="md:col-span-1">
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                    <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Upload nyt dokument</h2>

                    <form method="POST" action="{{ route('worker.documents.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <x-input-label for="type" :value="__('Dokumenttype')" />
                            <select id="type" name="type" required class="mt-1 block w-full rounded-xl border-slate-300 text-xs focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="work_permit">Arbejdstilladelse</option>
                                <option value="certificate">Certifikat / Hygiejnebevis / Kørekort</option>
                                <option value="id">Legitimation / Pas / Opholdskort</option>
                                <option value="contract">Underskrevet kontrakt</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="document_file" :value="__('Vælg fil (PDF, JPG, PNG - maks. 10MB)')" />
                            <input id="document_file" type="file" name="document_file" required class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                            <x-input-error :messages="$errors->get('document_file')" class="mt-1" />
                        </div>

                        <div>
                            <x-input-label for="expiry_date" :value="__('Udløbsdato (hvis relevant)')" />
                            <x-text-input id="expiry_date" type="date" name="expiry_date" class="block mt-1 w-full text-xs" />
                            <x-input-error :messages="$errors->get('expiry_date')" class="mt-1" />
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                                Upload dokument sikkert
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Documents Container -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-4 sm:p-6 border-b border-slate-100 flex justify-between items-center">
                        <h2 class="text-sm sm:text-base font-bold text-slate-900">Dine uploadede dokumenter</h2>
                        <span class="text-xs text-slate-500">{{ $documents->count() }} filer</span>
                    </div>

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
                                                Udløber: {{ $doc->expiry_date->format('d.m.Y') }}
                                                @if($doc->isExpired()) (Udløbet!)
                                                @elseif($doc->isExpiringSoon()) (Snart) @endif
                                            </span>
                                        @else
                                            <span class="text-slate-400">Ingen udløbsdato</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('worker.documents.download', $doc) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-xs hover:bg-indigo-100 transition">
                                        <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                        <span>Hent</span>
                                    </a>
                                </div>

                                @if($doc->rejection_reason)
                                    <div class="text-[11px] text-rose-600 bg-rose-50 p-2 rounded-lg border border-rose-100 mt-1">
                                        <strong>Årsag:</strong> {{ $doc->rejection_reason }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-400 text-xs">
                                Du har ikke uploadet nogen dokumenter endnu. Upload dit ID og eventuelle certifikater for hurtigere godkendelse.
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop Full Table (screens >= md) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px]">
                                <tr>
                                    <th class="p-4">Type</th>
                                    <th class="p-4">Filnavn</th>
                                    <th class="p-4">Udløber</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-right">Handling</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($documents as $doc)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="p-4 font-bold text-slate-900">{{ $doc->type->label() }}</td>
                                        <td class="p-4 text-slate-600">{{ $doc->original_filename }}</td>
                                        <td class="p-4">
                                            @if($doc->expiry_date)
                                                <span class="{{ $doc->isExpired() ? 'text-rose-600 font-bold' : ($doc->isExpiringSoon() ? 'text-amber-600 font-bold' : 'text-slate-600') }}">
                                                    {{ $doc->expiry_date->format('d.m.Y') }}
                                                    @if($doc->isExpired()) (Udløbet!)
                                                    @elseif($doc->isExpiringSoon()) (Udløber snart) @endif
                                                </span>
                                            @else
                                                <span class="text-slate-400">Ingen udløbsdato</span>
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
                                                <div class="text-[10px] text-rose-600 mt-1">Årsag: {{ $doc->rejection_reason }}</div>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right">
                                            <a href="{{ route('worker.documents.download', $doc) }}" class="text-xs font-bold text-indigo-600 hover:underline">
                                                Hent fil
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-slate-400">
                                            Du har ikke uploadet nogen dokumenter endnu. Upload dit ID og eventuelle certifikater for hurtigere godkendelse.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>

