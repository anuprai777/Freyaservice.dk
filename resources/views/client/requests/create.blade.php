<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-brand-secondary tracking-tight">{{ __('Bestil Vikar / Personale') }}</h1>
                <p class="text-xs text-brand-muted mt-0.5">{{ __('Udfyld formularen herunder for at rekvirere personale fra FreyaService.') }}</p>
            </div>
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center text-xs font-bold text-brand-muted hover:text-brand-secondary gap-1 transition">
                <span>&larr; {{ __('Tilbage til dashboard') }}</span>
            </a>
        </div>
    </x-slot>

    <div x-data="{
        type: '{{ old('request_type', $selectedType) }}',
        isUrgent: {{ old('is_urgent') ? 'true' : 'false' }}
    }" class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-card padding="lg">
            <form method="POST" action="{{ route('client.requests.store') }}" class="space-y-6 sm:space-y-8">
                @csrf

            <!-- 1. Request Type Selector -->
            <div>
                <label class="block text-sm font-bold text-brand-secondary mb-3">{{ __('1. Vælg type af bemanding') }}</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Temporary -->
                    <label @click="type = 'temporary_cover'"
                        :class="type === 'temporary_cover' ? 'border-brand-action bg-action-50/60 ring-2 ring-brand-action/20 shadow-xs' : 'border-brand-border bg-brand-surface hover:border-brand-secondary/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <input type="radio" name="request_type" value="temporary_cover" x-model="type" class="text-brand-action focus:ring-brand-action">
                            <span class="text-lg">⏱️</span>
                        </div>
                        <div>
                            <div class="font-bold text-brand-secondary text-sm">{{ __('Akut / Midlertidig Vikar') }}</div>
                            <div class="text-[11px] text-brand-muted mt-1 leading-normal">{{ __('Tilkaldevikarer til timer, enkelte dage eller uger ved sygdom eller spidsbelastning.') }}</div>
                        </div>
                    </label>

                    <!-- Part-time -->
                    <label @click="type = 'part_time'"
                        :class="type === 'part_time' ? 'border-brand-action bg-action-50/60 ring-2 ring-brand-action/20 shadow-xs' : 'border-brand-border bg-brand-surface hover:border-brand-secondary/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <input type="radio" name="request_type" value="part_time" x-model="type" class="text-brand-action focus:ring-brand-action">
                            <span class="text-lg">📅</span>
                        </div>
                        <div>
                            <div class="font-bold text-brand-secondary text-sm">{{ __('Fast Deltidspersonale') }}</div>
                            <div class="text-[11px] text-brand-muted mt-1 leading-normal">{{ __('Faste ugentlige vagter eller weekender på en løbende aftale.') }}</div>
                        </div>
                    </label>

                    <!-- Full-time -->
                    <label @click="type = 'full_time'"
                        :class="type === 'full_time' ? 'border-brand-action bg-action-50/60 ring-2 ring-brand-action/20 shadow-xs' : 'border-brand-border bg-brand-surface hover:border-brand-secondary/40'"
                        class="p-4 rounded-xl border cursor-pointer transition flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <input type="radio" name="request_type" value="full_time" x-model="type" class="text-brand-action focus:ring-brand-action">
                            <span class="text-lg">🤝</span>
                        </div>
                        <div>
                            <div class="font-bold text-brand-secondary text-sm">{{ __('Fuldtid / Rekruttering') }}</div>
                            <div class="text-[11px] text-brand-muted mt-1 leading-normal">{{ __('Langtidsplacering eller Try & Hire med henblik på fastansættelse.') }}</div>
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('request_type')" class="mt-2" />
            </div>

            <!-- 2. Role, Workers Needed & Reason -->
            <div class="pt-6 border-t border-brand-border space-y-4">
                <label class="block text-sm font-bold text-brand-secondary">{{ __('2. Stillingsbetegnelse og antal') }}</label>

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
                    <select id="reason" name="reason" class="mt-1 block w-full rounded-xl border-brand-border bg-brand-surface shadow-xs focus:border-brand-secondary focus:ring-brand-secondary text-sm text-brand-body">
                        <option value="absence" {{ old('reason') === 'absence' ? 'selected' : '' }}>{{ __('Sygdom / Ferie blandt egne medarbejdere') }}</option>
                        <option value="peak" {{ old('reason') === 'peak' ? 'selected' : '' }}>{{ __('Spidsbelastning / Sæsonpeak / Stort arrangement') }}</option>
                        <option value="permanent_need" {{ old('reason') === 'permanent_need' ? 'selected' : '' }}>{{ __('Permanent behov / Afprøvning forud for fastansættelse') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                </div>
            </div>

            <!-- 3. Work Location -->
            <div class="pt-6 border-t border-brand-border space-y-4">
                <label class="block text-sm font-bold text-brand-secondary">{{ __('3. Arbejdslokation') }}</label>

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
            <div class="pt-6 border-t border-brand-border space-y-4">
                <label class="block text-sm font-bold text-brand-secondary">{{ __('4. Tidsplan og arbejdstider') }}</label>

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
                        <span class="block text-xs font-semibold text-brand-secondary mb-2 uppercase">{{ __('Faste ugedage') }}</span>
                        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2 text-xs">
                            @foreach([1=>__('Man'), 2=>__('Tir'), 3=>__('Ons'), 4=>__('Tor'), 5=>__('Fre'), 6=>__('Lør'), 0=>__('Søn')] as $dayKey => $dayName)
                                <label class="p-2.5 rounded-xl border border-brand-border bg-brand-surface text-center cursor-pointer hover:bg-brand-bg transition flex flex-col items-center gap-1">
                                    <input type="checkbox" name="recurring_days[]" value="{{ $dayKey }}" class="rounded border-brand-border text-brand-action focus:ring-brand-action">
                                    <span class="font-medium text-brand-secondary">{{ $dayName }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Uniform, Instructions, and Preferred Worker -->
            <div class="pt-6 border-t border-brand-border space-y-4">
                <label class="block text-sm font-bold text-brand-secondary">{{ __('5. Yderligere detaljer og instruktioner') }}</label>

                <div>
                    <x-input-label for="dress_code" :value="__('Dresscode / Arbejdstøj')" />
                    <x-text-input id="dress_code" class="block mt-1 w-full" type="text" name="dress_code" :value="old('dress_code')" placeholder="{{ __('F.eks. Sorte bukser og hvid skjorte / Sikkerhedssko påkrævet') }}" />
                </div>

                <div>
                    <x-input-label for="instructions" :value="__('Særlige instrukser eller adgangsforhold')" />
                    <textarea id="instructions" name="instructions" rows="3" class="w-full text-sm rounded-xl border-brand-border bg-brand-surface text-brand-body focus:border-brand-secondary focus:ring-brand-secondary placeholder:text-brand-muted" placeholder="{{ __('F.eks. Henvendelse i vareindleveringen bag bygningen, kontakt Thomas ved ankomst...') }}">{{ old('instructions') }}</textarea>
                </div>

                <!-- Favourite Worker Selector -->
                <div>
                    <x-input-label for="preferred_worker_id" :value="__('Foretrukken vikar (valgfrit)')" />
                    <select id="preferred_worker_id" name="preferred_worker_id" class="mt-1 block w-full rounded-xl border-brand-border bg-brand-surface shadow-xs focus:border-brand-secondary focus:ring-brand-secondary text-sm text-brand-body">
                        <option value="">{{ __('Ingen specifik vikar (FreyaService finder bedste match)') }}</option>
                        @foreach($favouriteWorkers as $fav)
                            <option value="{{ $fav->id }}" {{ old('preferred_worker_id') == $fav->id ? 'selected' : '' }}>
                                ★ {{ $fav->user->name }} ({{ __('Rating:') }} {{ $fav->rating_avg }} - {{ implode(', ', array_slice($fav->skills ?? [], 0, 3)) }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 6. Urgent Flag -->
            <div class="pt-6 border-t border-brand-border">
                <label class="flex items-start gap-3 p-4 rounded-xl border border-brick-200 bg-brick-50/60 hover:bg-brick-50 transition cursor-pointer">
                    <input type="checkbox" name="is_urgent" value="1" x-model="isUrgent" class="mt-1 rounded border-brick-300 text-brick-600 focus:ring-brick-500">
                    <div>
                        <span class="text-sm font-bold text-brand-secondary flex items-center gap-1.5">
                            <span class="text-brick-600">⚡</span>
                            <span>{{ __('Akut behov (Udrykning inden for få timer)') }}</span>
                        </span>
                        <p class="text-xs text-brick-700/90 mt-0.5 leading-relaxed">
                            {{ __('Aktiver dette hvis du har brug for øjeblikkelig vikardækning. FreyaServices vagttelefon og vagtkoordinator prioriterer din ordre med højeste hastighed.') }}
                        </p>
                    </div>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="pt-6 border-t border-brand-border flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('client.dashboard') }}" class="w-full sm:w-auto text-center px-5 py-3 rounded-xl text-sm font-semibold text-brand-muted hover:text-brand-secondary hover:bg-brand-bg transition min-h-[44px] flex items-center justify-center">
                    {{ __('Annuller') }}
                </a>
                <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl bg-brand-action hover:bg-brand-action-hover text-white font-extrabold text-sm shadow-lg shadow-brand-action/30 transition transform hover:-translate-y-0.5 min-h-[44px] flex items-center justify-center cursor-pointer">
                    {{ __('Send Forespørgsel') }} &rarr;
                </button>
            </div>
        </form>
    </x-card>

</div>
</x-app-layout>
