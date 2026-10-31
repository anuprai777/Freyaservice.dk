<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase
                        @if($worker->status === 'approved') bg-emerald-100 text-emerald-800
                        @elseif($worker->status === 'pending') bg-amber-100 text-amber-800
                        @else bg-rose-100 text-rose-800 @endif">
                        {{ __($worker->status) }}
                    </span>
                    <span class="text-xs font-semibold text-slate-500 inline-flex items-center gap-1">
                        <x-heroicon-s-star class="w-3.5 h-3.5 text-amber-500" />
                        <span>{{ $worker->rating_avg }} ({{ $worker->ratings_count }} {{ __('anmeldelser') }})</span>
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $worker->user->name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Tilmeldt') }} {{ $worker->created_at->format('d.m.Y') }} &bull; {{ __('E-mail:') }} {{ $worker->user->email }} &bull; {{ __('Tlf:') }} {{ $worker->user->phone }}</p>
            </div>
            <a href="{{ route('admin.workers.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til vikarer') }}</span>
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

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Left: Profile & Verification -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Documents Verification Section -->
                <x-card title="{{ __('Uploadede Dokumenter & Verifikation') }}">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-600 uppercase font-bold text-[11px] border-b border-slate-100">
                                <tr>
                                    <th class="p-3">{{ __('Type') }}</th>
                                    <th class="p-3">{{ __('Udløb') }}</th>
                                    <th class="p-3">{{ __('Status') }}</th>
                                    <th class="p-3">{{ __('Fil') }}</th>
                                    <th class="p-3 text-right">{{ __('Verifikation') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($worker->documents as $doc)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="p-3 font-bold text-slate-900">
                                            <div class="flex items-center gap-1.5">
                                                <x-heroicon-o-document-text class="w-3.5 h-3.5 text-slate-400" />
                                                <span>{{ $doc->type->label() }}</span>
                                            </div>
                                        </td>
                                        <td class="p-3 text-slate-600">{{ $doc->expiry_date ? $doc->expiry_date->format('d.m.Y') : __('Ingen udløb') }}</td>
                                        <td class="p-3">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase
                                                @if($doc->status->value === 'approved') bg-emerald-100 text-emerald-800
                                                @elseif($doc->status->value === 'rejected') bg-rose-100 text-rose-800
                                                @else bg-amber-100 text-amber-800 @endif">
                                                {{ $doc->status->label() }}
                                            </span>
                                            @if($doc->rejection_reason)
                                                <div class="text-[10px] text-rose-600 mt-0.5">{{ __('Afvist:') }} {{ $doc->rejection_reason }}</div>
                                            @endif
                                        </td>
                                        <td class="p-3">
                                            <a href="{{ route('worker.documents.download', $doc) }}" class="inline-flex items-center gap-1 text-[#7B1E3A] hover:underline font-semibold">
                                                <x-heroicon-o-arrow-down-tray class="w-3.5 h-3.5" />
                                                <span>{{ __('Download fil') }}</span>
                                            </a>
                                        </td>
                                        <td class="p-3 text-right">
                                            <div class="inline-flex items-center gap-1.5">
                                                <!-- Approve Form -->
                                                <form method="POST" action="{{ route('admin.documents.verify', $doc) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-emerald-600 text-white font-bold text-[11px] hover:bg-emerald-700 shadow-xs transition">
                                                        <x-heroicon-s-check class="w-3 h-3" />
                                                        <span>{{ __('Godkend') }}</span>
                                                    </button>
                                                </form>

                                                <!-- Reject Form Trigger -->
                                                <div x-data="{ openReject: false }">
                                                    <button type="button" @click="openReject = true" class="inline-flex items-center gap-1 px-2.5 py-1 rounded border border-rose-300 bg-rose-50 text-rose-700 font-semibold text-[11px] hover:bg-rose-100 transition">
                                                        <x-heroicon-s-x-mark class="w-3 h-3" />
                                                        <span>{{ __('Afvis') }}</span>
                                                    </button>

                                                    <div x-show="openReject" x-cloak class="fixed inset-0 z-50 bg-slate-900/80 flex items-center justify-center p-4">
                                                        <div @click.away="openReject = false" class="bg-white rounded-2xl max-w-sm w-full p-6 text-left shadow-2xl">
                                                            <h3 class="text-sm font-bold text-slate-900">{{ __('Afvis dokument') }}</h3>
                                                            <form method="POST" action="{{ route('admin.documents.verify', $doc) }}" class="mt-3 space-y-3">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="rejected">
                                                                <textarea name="rejection_reason" required rows="2" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('Begrundelse (f.eks. Utydeligt foto eller udløbet dato)...') }}"></textarea>
                                                                <div class="flex justify-end gap-2">
                                                                    <button type="button" @click="openReject = false" class="px-3 py-1 rounded-lg text-xs text-slate-500">{{ __('Luk') }}</button>
                                                                    <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-rose-600 text-white">{{ __('Bekræft afvisning') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-slate-400">{{ __('Ingen dokumenter uploadet endnu.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-card>

                <!-- Client Ratings & Reviews -->
                <x-card title="{{ __('Kundebedømmelser & Feedback') }}">
                    <div class="space-y-3">
                        @forelse($worker->ratings as $rating)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-xs space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-900 flex items-center gap-1.5">
                                        <x-heroicon-o-building-office-2 class="w-3.5 h-3.5 text-slate-400" />
                                        {{ $rating->client->company_name ?? __('Virksomhed') }}
                                    </span>
                                    <span class="text-amber-500 font-bold inline-flex items-center gap-1">
                                        <x-heroicon-s-star class="w-3.5 h-3.5 text-amber-500" />
                                        <span>{{ $rating->rating }} / 5</span>
                                    </span>
                                </div>
                                @if($rating->comment)
                                    <p class="text-slate-600 italic">"{{ $rating->comment }}"</p>
                                @endif
                                <div class="text-[10px] text-slate-400">{{ $rating->created_at->format('d.m.Y H:i') }}</div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">{{ __('Ingen anmeldelser modtaget endnu.') }}</div>
                        @endforelse
                    </div>
                </x-card>
            </div>

            <!-- Right: Status & Notes -->
            <div class="space-y-6">
                <!-- Status Changer -->
                <x-card title="{{ __('Vikarstatus & CRM Noter') }}">
                    <form method="POST" action="{{ route('admin.workers.update-status', $worker) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Status') }}</label>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                <option value="pending" {{ $worker->status === 'pending' ? 'selected' : '' }}>{{ __('Afventer godkendelse') }}</option>
                                <option value="approved" {{ $worker->status === 'approved' ? 'selected' : '' }}>{{ __('Godkendt (Aktiv vikar)') }}</option>
                                <option value="suspended" {{ $worker->status === 'suspended' ? 'selected' : '' }}>{{ __('Suspenderet') }}</option>
                                <option value="blocked" {{ $worker->status === 'blocked' ? 'selected' : '' }}>{{ __('Blokeret') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Interne noter') }}</label>
                            <textarea name="notes" rows="4" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('Skriv interne bemærkninger om vikaren her...') }}">{{ old('notes', $worker->notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs transition shadow-xs">
                            {{ __('Gem vikarstatus & noter') }}
                        </button>
                    </form>
                </x-card>

                <!-- Profile Overview Box -->
                <x-card title="{{ __('Kompetencer & Data') }}">
                    <div class="space-y-3 text-xs">
                        <div class="flex items-center gap-1.5">
                            <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400" />
                            <strong>{{ __('By:') }}</strong> {{ $worker->city }} ({{ $worker->postcode }})
                        </div>
                        <div class="flex items-center gap-1.5">
                            <x-heroicon-o-banknotes class="w-3.5 h-3.5 text-slate-400" />
                            <strong>{{ __('Løn:') }}</strong> {{ number_format($worker->hourly_rate, 2, ',', '.') }} DKK/time
                        </div>
                        <div class="flex items-center gap-1.5">
                            <x-heroicon-o-clock class="w-3.5 h-3.5 text-slate-400" />
                            <strong>{{ __('Rådighedstype:') }}</strong> {{ $worker->availability_type }}
                        </div>
                        <div class="flex items-center gap-1.5">
                            <x-heroicon-o-shield-check class="w-3.5 h-3.5 text-slate-400" />
                            <strong>{{ __('Bank:') }}</strong> {{ $worker->bank_reg_number ? __('Registreret (krypteret)') : __('Ej angivet') }}
                        </div>
                        <div class="pt-2">
                            <span class="block font-semibold text-slate-700 mb-1">{{ __('Færdigheder:') }}</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach((array)$worker->skills as $sk)
                                    <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[10px] border border-slate-200/60">{{ $sk }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>
