<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ $client->company_name }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('CVR:') }} {{ $client->cvr }} &bull; {{ __('Tilmeldt') }} {{ $client->created_at->format('d.m.Y') }}</p>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til virksomheder') }}</span>
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

            <!-- Left: Info & Staff Requests History -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Company info card -->
                <x-card title="{{ __('Virksomhedsoplysninger') }}">
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Kontaktperson:') }}</span>
                            <span class="font-bold text-slate-900 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-user class="w-3.5 h-3.5 text-slate-400" />
                                {{ $client->contact_person }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Telefon:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-phone class="w-3.5 h-3.5 text-slate-400" />
                                {{ $client->phone }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('E-mail:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-envelope class="w-3.5 h-3.5 text-slate-400" />
                                {{ $client->user->email ?? 'N/A' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">{{ __('Faktura E-mail:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-document-text class="w-3.5 h-3.5 text-slate-400" />
                                {{ $client->billing_email ?? $client->user->email }}
                            </span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-slate-400 block font-medium">{{ __('Adresse:') }}</span>
                            <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                <x-heroicon-o-map-pin class="w-3.5 h-3.5 text-slate-400" />
                                {{ $client->address }}, {{ $client->postcode }} {{ $client->city }}
                            </span>
                        </div>
                        @if($client->industry)
                            <div class="col-span-2">
                                <span class="text-slate-400 block font-medium">{{ __('Branche:') }}</span>
                                <span class="font-semibold text-slate-800 flex items-center gap-1.5 mt-0.5">
                                    <x-heroicon-o-briefcase class="w-3.5 h-3.5 text-slate-400" />
                                    {{ $client->industry }}
                                </span>
                            </div>
                        @endif
                    </div>
                </x-card>

                <!-- Staff Requests History -->
                <x-card title="{{ __('Historiske bemandingsforespørgsler') }}">
                    <div class="space-y-3">
                        @forelse($client->staffRequests as $req)
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex justify-between items-center text-xs hover:bg-slate-50/80 transition">
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $req->role }}</div>
                                    <div class="text-slate-500 flex items-center gap-2 mt-0.5">
                                        <span class="inline-flex items-center gap-1">
                                            <x-heroicon-o-calendar-days class="w-3.5 h-3.5 text-slate-400" />
                                            {{ __('Start:') }} {{ $req->start_date->format('d.m.Y') }}
                                        </span>
                                        <span>&bull;</span>
                                        <span class="inline-flex items-center gap-1 font-semibold text-slate-700">
                                            <x-heroicon-o-users class="w-3.5 h-3.5 text-slate-400" />
                                            {{ $req->workers_needed }} {{ __('vikar(er)') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $req->status->badgeClasses() }}">{{ $req->status->label() }}</span>
                                    <a href="{{ route('admin.requests.show', $req) }}" class="inline-flex items-center gap-1 text-[#7B1E3A] font-bold hover:underline">
                                        <span>{{ __('Vis') }}</span>
                                        <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-400 text-xs">{{ __('Ingen ordrer oprettet af denne virksomhed endnu.') }}</div>
                        @endforelse
                    </div>
                </x-card>
            </div>

            <!-- Right: Status Changer -->
            <div class="space-y-6">
                <x-card title="{{ __('Administrer status') }}">
                    <form method="POST" action="{{ route('admin.clients.update-status', $client) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Status') }}</label>
                            <select name="status" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                                <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>{{ __('Aktiv') }}</option>
                                <option value="pending" {{ $client->status === 'pending' ? 'selected' : '' }}>{{ __('Afventer godkendelse') }}</option>
                                <option value="suspended" {{ $client->status === 'suspended' ? 'selected' : '' }}>{{ __('Suspenderet') }}</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('Interne noter') }}</label>
                            <textarea name="notes" rows="4" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('Noter om virksomheden...') }}">{{ old('notes', $client->notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-xs transition shadow-xs">
                            {{ __('Gem virksomhedsstatus') }}
                        </button>
                    </form>
                </x-card>
            </div>

        </div>

    </div>
</x-app-layout>
