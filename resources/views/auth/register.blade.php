<x-guest-layout>
    <div x-data="{ role: '{{ old('role', 'client') }}' }" class="w-full">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-black text-brand-primary tracking-tight">{{ __('Opret profil hos FreyaService') }}</h2>
            <p class="text-xs text-brand-muted mt-1">{{ __('Vælg venligst din profiltype herunder') }}</p>

            <!-- Role Selector Toggle -->
            <div class="grid grid-cols-2 gap-3 p-1.5 mt-4 bg-brand-bg rounded-xl max-w-sm mx-auto border border-brand-border">
                <button type="button" @click="role = 'client'"
                    :class="role === 'client' ? 'bg-brand-secondary text-white shadow-sm font-bold' : 'text-brand-muted hover:text-brand-secondary font-semibold'"
                    class="py-2.5 px-4 rounded-lg text-xs tracking-wide transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <x-heroicon-o-building-office-2 class="w-4 h-4" />
                    <span>{{ __('Virksomhed (Kunde)') }}</span>
                </button>
                <button type="button" @click="role = 'worker'"
                    :class="role === 'worker' ? 'bg-brand-secondary text-white shadow-sm font-bold' : 'text-brand-muted hover:text-brand-secondary font-semibold'"
                    class="py-2.5 px-4 rounded-lg text-xs tracking-wide transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <x-heroicon-o-user class="w-4 h-4" />
                    <span>{{ __('Vikar (Arbejdssøgende)') }}</span>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="role" :value="role">

            <!-- Common: Name -->
            <div>
                <x-input-label for="name" :value="__('Fulde Navn / Kontaktperson')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Common: Email -->
            <div>
                <x-input-label for="email" :value="__('E-mailadresse')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Common: Phone -->
            <div>
                <x-input-label for="phone" :value="__('Telefonnummer (dansk format)')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" placeholder="+45 12 34 56 78" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Client-only Fields -->
            <div x-show="role === 'client'" x-cloak class="space-y-4 pt-2 border-t border-brand-border">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="company_name" :value="__('Virksomhedsnavn')" />
                        <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" placeholder="Eks. Hotel Nordic A/S" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="cvr" :value="__('CVR-nummer (8 cifre)')" />
                        <x-text-input id="cvr" class="block mt-1 w-full" type="text" maxlength="8" name="cvr" :value="old('cvr')" placeholder="12345678" />
                        <x-input-error :messages="$errors->get('cvr')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="address" :value="__('Adresse')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" placeholder="Gadenavn og nummer" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postcode_client" :value="__('Postnummer')" />
                        <x-text-input id="postcode_client" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 1620" />
                    </div>
                    <div>
                        <x-input-label for="city_client" :value="__('By')" />
                        <x-text-input id="city_client" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København V" />
                    </div>
                </div>
            </div>

            <!-- Worker-only Fields -->
            <div x-show="role === 'worker'" x-cloak class="space-y-4 pt-2 border-t border-brand-border">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postcode_worker" :value="__('Dit Postnummer')" />
                        <x-text-input id="postcode_worker" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 2100" />
                    </div>
                    <div>
                        <x-input-label for="city_worker" :value="__('Din By')" />
                        <x-text-input id="city_worker" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København Ø" />
                    </div>
                </div>

                <div>
                    <x-input-label for="availability_type" :value="__('Ønsket ansættelsesform')" />
                    <select id="availability_type" name="availability_type" class="mt-1 block w-full rounded-xl border-brand-border bg-brand-surface shadow-sm focus:border-brand-secondary focus:ring-brand-secondary text-sm text-brand-body">
                        <option value="any">{{ __('Alle vagttyper (fleksibel)') }}</option>
                        <option value="temporary">{{ __('Tilkaldevikar (akut dækning / timer)') }}</option>
                        <option value="part_time">{{ __('Deltid (faste dage / weekender)') }}</option>
                        <option value="full_time">{{ __('Fuldtid / Fastansættelse') }}</option>
                    </select>
                </div>

                <div>
                    <span class="block font-semibold text-xs text-brand-secondary uppercase mb-2">{{ __('Vælg dine kompetencer') }}</span>
                    <div class="grid grid-cols-2 gap-2 text-xs text-brand-body bg-brand-bg p-3 rounded-xl border border-brand-border">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Tjener" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Tjener / Bartender') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Opvasker" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Opvasker / Køkkenhjælp') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Rengøring" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Erhvervsrengøring') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Lager" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Lager & Pakkeri') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Kontor" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Kontor / Reception') }}</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="skills[]" value="Chauffør" class="rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                            <span>{{ __('Bud / Chauffør (B-kørekort)') }}</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="password" :value="__('Adgangskode')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Bekræft adgangskode')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- GDPR Consent -->
            <div class="pt-3 border-t border-brand-border">
                <label class="inline-flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" name="gdpr_consent" value="1" required class="mt-1 rounded border-brand-border text-brand-secondary shadow-sm focus:ring-brand-secondary">
                    <span class="text-xs text-brand-muted leading-normal">
                        Jeg giver samtykke til, at FreyaService behandler mine oplysninger i henhold til <a href="#" class="underline text-brand-secondary hover:text-brand-action">persondatapolitikken (GDPR)</a>. FreyaService indsamler <strong>ikke</strong> CPR-numre, og bankoplysninger opbevares altid krypteret.
                    </span>
                </label>
                <x-input-error :messages="$errors->get('gdpr_consent')" class="mt-1" />
            </div>

            <div class="flex items-center justify-between pt-4">
                <a class="underline text-xs text-brand-muted hover:text-brand-secondary transition" href="{{ route('login') }}">
                    {{ __('Har du allerede en konto? Log ind') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Opret Profil') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
