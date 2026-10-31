<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-burgundy/10 text-burgundy border border-burgundy/20">
                        {{ __('Ny Rekvisition') }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-navy tracking-tight">{{ __('Bestil Vikar / Personale') }}</h1>
                <p class="text-xs text-ink/70 mt-0.5">{{ __('Udfyld formularen herunder for at rekvirere personale fra FreyaService.') }}</p>
            </div>
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-mist bg-white text-xs font-bold text-ink/70 hover:text-navy hover:bg-sand shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage til dashboard') }}</span>
            </a>
        </div>
    </x-slot>

    <div x-data="{
        type: '{{ old('request_type', $selectedType) }}',
        isUrgent: {{ old('is_urgent') ? 'true' : 'false' }}
    }" class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-card padding="lg" variant="white">
            <form method="POST" action="{{ route('client.requests.store') }}" class="space-y-6 sm:space-y-8">
                @csrf

            <!-- 1. Request Type Selector -->
            <div>
                <label class="block text-sm font-bold text-navy mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center text-xs font-bold">1</span>
                    <span>{{ __('Vælg type af bemanding') }}</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Temporary -->
                    <label @click="type = 'temporary_cover'"
                        :class="type === 'temporary_cover' ? 'border-burgundy bg-burgundy/5 ring-2 ring-burgundy/20 shadow-xs' : 'border-mist bg-sand hover:border-burgundy/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-3">
                            <input type="radio" name="request_type" value="temporary_cover" x-model="type" class="text-burgundy focus:ring-burgundy">
                            <div class="w-8 h-8 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center shrink-0">
                                <x-heroicon-o-clock class="w-4 h-4 text-burgundy" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-navy text-sm">{{ __('Akut / Midlertidig Vikar') }}</div>
                            <div class="text-[11px] text-ink/70 mt-1 leading-normal">{{ __('Tilkaldevikarer til timer, enkelte dage eller uger ved sygdom eller spidsbelastning.') }}</div>
                        </div>
                    </label>

                    <!-- Part-time -->
                    <label @click="type = 'part_time'"
                        :class="type === 'part_time' ? 'border-burgundy bg-burgundy/5 ring-2 ring-burgundy/20 shadow-xs' : 'border-mist bg-sand hover:border-burgundy/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-3">
                            <input type="radio" name="request_type" value="part_time" x-model="type" class="text-burgundy focus:ring-burgundy">
                            <div class="w-8 h-8 rounded-lg bg-[#C9A24B]/15 text-[#8C6C27] flex items-center justify-center shrink-0">
                                <x-heroicon-o-calendar-days class="w-4 h-4 text-[#8C6C27]" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-navy text-sm">{{ __('Fast Deltidspersonale') }}</div>
                            <div class="text-[11px] text-ink/70 mt-1 leading-normal">{{ __('Faste ugentlige vagter eller weekender på en løbende aftale.') }}</div>
                        </div>
                    </label>

                    <!-- Full-time -->
                    <label @click="type = 'full_time'"
                        :class="type === 'full_time' ? 'border-burgundy bg-burgundy/5 ring-2 ring-burgundy/20 shadow-xs' : 'border-mist bg-sand hover:border-burgundy/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-3">
                            <input type="radio" name="request_type" value="full_time" x-model="type" class="text-burgundy focus:ring-burgundy">
                            <div class="w-8 h-8 rounded-lg bg-navy/10 text-navy flex items-center justify-center shrink-0">
                                <x-heroicon-o-user-group class="w-4 h-4 text-navy" />
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-navy text-sm">{{ __('Fuldtid / Rekruttering') }}</div>
                            <div class="text-[11px] text-ink/70 mt-1 leading-normal">{{ __('Langtidsplacering eller Try & Hire med henblik på fastansættelse.') }}</div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('request_type')" class="mt-2" />
            </div>

            <!-- 2. Role, Workers Needed & Reason -->
            <div class="pt-6 border-t border-mist space-y-4">
                <label class="block text-sm font-bold text-navy flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center text-xs font-bold">2</span>
                    <span>{{ __('Stillingsbetegnelse og antal') }}</span>
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <x-input-label for="role" :value="__('Stilling / Fagområde')" />
                        <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" placeholder="{{ __('F.eks. Tjener, Opvasker, Rengøringsassistent, Lagermedarbejder') }}" required />
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="workers_needed" :value="__('Antal personer')" />
                        <x-text-input id="workers_needed" class="block mt-1 w-full" type="number" min="1" max="50" name="workers_needed" :value="old('workers_needed', 1)" required />
                        <x-input-error :messages="$errors->get('workers_needed')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="reason" :value="__('Årsag til forespørgsel')" />
                    <select id="reason" name="reason" class="mt-1 block w-full rounded-xl border-mist bg-white shadow-xs focus:border-burgundy focus:ring-burgundy text-sm text-ink">
                        <option value="absence" {{ old('reason') === 'absence' ? 'selected' : '' }}>{{ __('Sygdom / Ferie blandt egne medarbejdere') }}</option>
                        <option value="peak" {{ old('reason') === 'peak' ? 'selected' : '' }}>{{ __('Spidsbelastning / Sæsonpeak / Stort arrangement') }}</option>
                        <option value="permanent_need" {{ old('reason') === 'permanent_need' ? 'selected' : '' }}>{{ __('Permanent behov / Afprøvning forud for fastansættelse') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                </div>
            </div>

            <!-- 3. Work Location -->
            <div class="pt-6 border-t border-mist space-y-4">
                <label class="block text-sm font-bold text-navy flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center text-xs font-bold">3</span>
                    <span>{{ __('Arbejdslokation') }}</span>
                </label>

                <div>
                    <x-input-label for="location" :value="__('Adresse / Afdeling')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $client->address)" placeholder="{{ __('Adresse hvor arbejdet udføres') }}" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postcode" :value="__('Postnummer')" />
                        <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode', $client->postcode)" required />
                        <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="city" :value="__('By')" />
                        <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $client->city)" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- 4. Schedule & Dates -->
            <div class="pt-6 border-t border-mist space-y-4">
                <label class="block text-sm font-bold text-navy flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center text-xs font-bold">4</span>
                    <span>{{ __('Tidsplan og arbejdstider') }}</span>
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="start_date" :value="__('Startdato')" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', now()->addDay()->toDateString())" required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="end_date" :value="__('Slutdato (valgfri ved deltid/fuldtid)')" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="start_time" :value="__('Mødetid (hh:mm)')" />
                        <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time', '08:00')" />
                    </div>
                    <div>
                        <x-input-label for="end_time" :value="__('Sluttid (hh:mm)')" />
                        <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time', '16:00')" />
                    </div>
                </div>

                <!-- Part-time or Full-time extra schedule -->
                <div x-show="type === 'part_time' || type === 'full_time'" x-cloak class="space-y-4 pt-2">
                    <div>
                        <x-input-label for="hours_per_week" :value="__('Forventet antal timer om ugen')" />
                        <x-text-input id="hours_per_week" class="block mt-1 w-full" type="number" step="0.5" name="hours_per_week" :value="old('hours_per_week', 20)" placeholder="{{ __('F.eks. 15-37 timer') }}" />
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-navy mb-2 uppercase">{{ __('Faste ugedage') }}</span>
                        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-xs">
                            @foreach([1=>__('Man'), 2=>__('Tir'), 3=>__('Ons'), 4=>__('Tor'), 5=>__('Fre'), 6=>__('Lør'), 0=>__('Søn')] as $dayKey => $dayName)
                                <label class="p-2.5 rounded-xl border border-mist bg-sand text-center cursor-pointer hover:bg-white transition flex flex-col items-center gap-1">
                                    <input type="checkbox" name="recurring_days[]" value="{{ $dayKey }}" class="rounded border-mist text-burgundy focus:ring-burgundy">
                                    <span class="font-medium text-navy">{{ $dayName }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Uniform, Instructions, and Preferred Worker -->
            <div class="pt-6 border-t border-mist space-y-4">
                <label class="block text-sm font-bold text-navy flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-burgundy/10 text-burgundy flex items-center justify-center text-xs font-bold">5</span>
                    <span>{{ __('Yderligere detaljer og instruktioner') }}</span>
                </label>

                <div>
                    <x-input-label for="dress_code" :value="__('Dresscode / Arbejdstøj')" />
                    <x-text-input id="dress_code" class="block mt-1 w-full" type="text" name="dress_code" :value="old('dress_code')" placeholder="{{ __('F.eks. Sorte bukser og hvid skjorte / Sikkerhedssko påkrævet') }}" />
                </div>

                <div>
                    <x-input-label for="instructions" :value="__('Særlige instrukser eller adgangsforhold')" />
                    <textarea id="instructions" name="instructions" rows="3" class="w-full text-sm rounded-xl border-mist bg-white text-ink focus:border-burgundy focus:ring-burgundy placeholder:text-ink/40" placeholder="{{ __('F.eks. Henvendelse i vareindleveringen bag bygningen, kontakt Thomas ved ankomst...') }}">{{ old('instructions') }}</textarea>
                </div>

                <!-- Favourite Worker Selector -->
                <div>
                    <x-input-label for="preferred_worker_id" :value="__('Foretrukken vikar (valgfrit)')" />
                    <select id="preferred_worker_id" name="preferred_worker_id" class="mt-1 block w-full rounded-xl border-mist bg-white shadow-xs focus:border-burgundy focus:ring-burgundy text-sm text-ink">
                        <option value="">{{ __('Ingen specifik vikar (FreyaService finder bedste match)') }}</option>
                        @foreach($favouriteWorkers as $fav)
                            <option value="{{ $fav->id }}" {{ old('preferred_worker_id') == $fav->id ? 'selected' : '' }}>
                                ★ {{ $fav->user->name }} ({{ __('Rating:') }} {{ $fav->rating_avg }} - {{ implode(', ', array_map(fn($s) => __($s), array_slice((array)($fav->skills ?? []), 0, 3))) }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 6. Urgent Flag -->
            <div class="pt-6 border-t border-mist">
                <label class="flex items-start gap-3 p-4 rounded-xl border border-rose-200 bg-rose-50/70 hover:bg-rose-50 transition cursor-pointer">
                    <input type="checkbox" name="is_urgent" value="1" x-model="isUrgent" class="mt-1 rounded border-rose-300 text-burgundy focus:ring-burgundy">
                    <div>
                        <span class="text-sm font-bold text-navy flex items-center gap-1.5">
                            <x-heroicon-s-bolt class="w-4 h-4 text-burgundy" />
                            <span>{{ __('Akut behov (Udrykning inden for få timer)') }}</span>
                        </span>
                        <p class="text-xs text-ink/70 mt-0.5 leading-relaxed">
                            {{ __('Aktiver dette hvis du har brug for øjeblikkelig vikardækning. FreyaServices vagttelefon og vagtkoordinator prioriterer din ordre med højeste hastighed.') }}
                        </p>
                    </div>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-mist flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('client.dashboard') }}" class="w-full sm:w-auto text-center px-5 py-3 rounded-xl text-sm font-semibold text-ink/60 hover:text-navy hover:bg-sand transition min-h-[44px] flex items-center justify-center">
                    {{ __('Annuller') }}
                </a>
                <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl bg-burgundy hover:bg-burgundy-dark text-white font-extrabold text-sm shadow-md transition transform hover:-translate-y-0.5 min-h-[44px] flex items-center justify-center cursor-pointer gap-2">
                    <span>{{ __('Send Forespørgsel') }}</span>
                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                </button>
            </div>
        </form>
    </x-card>

</div>
</x-app-layout>
