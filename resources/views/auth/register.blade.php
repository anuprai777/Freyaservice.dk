<x-guest-layout max-width="sm:max-w-xl">
    <x-slot name="title">{{ __('Opret profil') }}</x-slot>

    <div x-data="{ role: '{{ old('role', request('role', 'client')) }}', showGdprModal: false }" class="w-full">
        <!-- Header -->
        <div class="mb-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-bg border border-brand-border text-xs font-semibold text-brand-secondary mb-3">
                <span class="w-2 h-2 rounded-full bg-brand-action"></span>
                <span>{{ __('FreyaService Portal') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-brand-primary tracking-tight">{{ __('Opret profil hos FreyaService') }}</h2>
            <p class="text-xs sm:text-sm text-brand-muted mt-1.5">{{ __('Vælg venligst din profiltype herunder for at komme i gang') }}</p>

            <!-- Role Selector Toggle -->
            <div class="grid grid-cols-2 gap-2 p-1.5 mt-5 bg-brand-bg rounded-2xl max-w-md mx-auto border border-brand-border shadow-xs">
                <button type="button" @click="role = 'client'"
                    :class="role === 'client' ? 'bg-brand-primary text-white shadow-md font-bold' : 'text-brand-muted hover:text-brand-secondary font-semibold hover:bg-brand-surface/60'"
                    class="py-2.5 px-3 sm:px-4 rounded-xl text-xs sm:text-sm tracking-wide transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <x-heroicon-o-building-office-2 class="w-4 h-4 text-brand-action" />
                    <span>{{ __('Virksomhed (Kunde)') }}</span>
                </button>
                <button type="button" @click="role = 'worker'"
                    :class="role === 'worker' ? 'bg-brand-primary text-white shadow-md font-bold' : 'text-brand-muted hover:text-brand-secondary font-semibold hover:bg-brand-surface/60'"
                    class="py-2.5 px-3 sm:px-4 rounded-xl text-xs sm:text-sm tracking-wide transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <x-heroicon-o-user class="w-4 h-4 text-brand-action" />
                    <span>{{ __('Vikar (Arbejdstager)') }}</span>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="role" :value="role">

            <!-- Common: Name -->
            <div>
                <x-input-label for="name" :value="__('Fulde Navn / Kontaktperson')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Indtast fulde navn') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Common: Email & Phone Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="email" :value="__('E-mailadresse')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="navn@virksomhed.dk" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="phone" :value="__('Telefonnummer (dansk format)')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" placeholder="+45 12 34 56 78" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            <!-- Client-only Fields (Virksomhed) -->
            <div x-show="role === 'client'" x-cloak class="space-y-4 pt-3 border-t border-brand-border">
                <div class="flex items-center gap-2 text-xs font-bold text-brand-action uppercase tracking-wider">
                    <x-heroicon-o-building-office class="w-4 h-4 text-brand-action shrink-0" />
                    <span>{{ __('Virksomhedsoplysninger') }}</span>
                </div>

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
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" placeholder="Gadenavn og nummer" autocomplete="street-address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postcode_client" :value="__('Postnummer')" />
                        <x-text-input id="postcode_client" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 1620" autocomplete="postal-code" />
                    </div>
                    <div>
                        <x-input-label for="city_client" :value="__('By')" />
                        <x-text-input id="city_client" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København V" autocomplete="address-level2" />
                    </div>
                </div>
            </div>

            <!-- Worker-only Fields (Vikar) -->
            <div x-show="role === 'worker'" x-cloak class="space-y-4 pt-3 border-t border-brand-border">
                <div class="flex items-center gap-2 text-xs font-bold text-brand-action uppercase tracking-wider">
                    <x-heroicon-o-identification class="w-4 h-4 text-brand-action shrink-0" />
                    <span>{{ __('Vikarprofil & Kompetencer') }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="postcode_worker" :value="__('Dit Postnummer')" />
                        <x-text-input id="postcode_worker" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 2100" autocomplete="postal-code" />
                    </div>
                    <div>
                        <x-input-label for="city_worker" :value="__('Din By')" />
                        <x-text-input id="city_worker" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København Ø" autocomplete="address-level2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="availability_type" :value="__('Ønsket ansættelsesform')" />
                    <select id="availability_type" name="availability_type" class="mt-1 block w-full rounded-xl border-brand-border bg-brand-surface shadow-xs focus:border-brand-secondary focus:ring-brand-secondary text-sm text-brand-body">
                        <option value="any">{{ __('Alle vagttyper (fleksibel)') }}</option>
                        <option value="temporary">{{ __('Tilkaldevikar (akut dækning / timer)') }}</option>
                        <option value="part_time">{{ __('Deltid (faste dage / weekender)') }}</option>
                        <option value="full_time">{{ __('Fuldtid / Fastansættelse') }}</option>
                    </select>
                </div>

                <div>
                    <span class="block font-semibold text-xs text-brand-secondary uppercase mb-2">{{ __('Vælg dine kompetencer') }}</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-brand-body bg-brand-bg p-3.5 rounded-xl border border-brand-border">
                        @foreach([
                            'Tjener' => __('Tjener / Bartender'),
                            'Opvasker' => __('Opvasker / Køkkenhjælp'),
                            'Rengøring' => __('Erhvervsrengøring'),
                            'Lager' => __('Lager & Pakkeri'),
                            'Kontor' => __('Kontor / Reception'),
                            'Chauffør' => __('Bud / Chauffør (B-kørekort)')
                        ] as $skillKey => $skillLabel)
                            <label class="flex items-center gap-2.5 p-2 rounded-lg bg-brand-surface border border-brand-border hover:border-brand-secondary/40 transition cursor-pointer">
                                <input type="checkbox" name="skills[]" value="{{ $skillKey }}" class="rounded border-brand-border text-brand-action shadow-xs focus:ring-brand-action">
                                <span class="font-medium text-brand-secondary">{{ $skillLabel }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-brand-border">
                <div>
                    <x-input-label for="password" :value="__('Adgangskode')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password_confirmation" :value="__('Bekræft adgangskode')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- GDPR Consent -->
            <div class="pt-3 border-t border-brand-border">
                <label class="inline-flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" name="gdpr_consent" value="1" required class="mt-1 rounded border-brand-border text-brand-action shadow-xs focus:ring-brand-action">
                    <span class="text-xs text-brand-muted leading-relaxed">
                        {{ __('Jeg giver samtykke til, at FreyaService behandler mine oplysninger i henhold til') }} 
                        <button type="button" @click.prevent="showGdprModal = true" class="underline text-brand-action hover:text-brand-action-hover font-bold cursor-pointer">{{ __('persondatapolitikken (GDPR)') }}</button>. 
                        {{ __('FreyaService indsamler') }} <strong class="text-brand-secondary">{{ __('ikke') }}</strong> {{ __('CPR-numre, og bankoplysninger opbevares altid krypteret.') }}
                    </span>
                </label>
                <x-input-error :messages="$errors->get('gdpr_consent')" class="mt-1" />
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-3 pt-4 border-t border-brand-border">
                <a class="text-xs text-brand-muted hover:text-brand-secondary transition underline text-center sm:text-left" href="{{ route('login') }}">
                    {{ __('Har du allerede en konto? Log ind') }}
                </a>

                <x-primary-button class="w-full sm:w-auto px-7 py-3 text-sm">
                    {{ __('Opret Profil') }} &rarr;
                </x-primary-button>
            </div>
        </form>

        <!-- GDPR Information Modal -->
        <div x-show="showGdprModal" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto bg-navy-950/70 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.away="showGdprModal = false"
                 class="bg-brand-surface rounded-2xl max-w-lg w-full p-6 sm:p-8 border border-brand-border shadow-2xl relative text-left">
                <button type="button" @click="showGdprModal = false" class="absolute top-4 right-4 text-brand-muted hover:text-brand-secondary p-1 rounded-lg hover:bg-brand-bg transition" aria-label="Luk">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-forest-50 text-forest flex items-center justify-center shrink-0">
                        <x-heroicon-s-shield-check class="w-6 h-6" />
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-brand-secondary">{{ __('Persondatapolitik & GDPR') }}</h3>
                        <p class="text-xs text-brand-muted">FreyaService • CVR 44556677</p>
                    </div>
                </div>
                <div class="space-y-3 text-xs text-brand-body leading-relaxed max-h-72 overflow-y-auto pr-1">
                    <p><strong>1. {{ __('Dataminimering') }}:</strong> {{ __('FreyaService indsamler og opbevarer aldrig CPR-numre i sit digitale system.') }}</p>
                    <p><strong>2. {{ __('Sikkerhed') }}:</strong> {{ __('Alle bankoplysninger og personfølsomme data krypteres med AES-256 for optimal datasikkerhed.') }}</p>
                    <p><strong>3. {{ __('Formål') }}:</strong> {{ __('Oplysningerne anvendes udelukkende til administration af vikariater, vagtplanlægning, QR-tidsregistrering og lovpligtig afregning.') }}</p>
                    <p><strong>4. {{ __('Dine rettigheder') }}:</strong> {{ __('Du har til enhver tid ret til indsigt i dine personoplysninger, dataeksport samt sletning ("retten til at blive glemt") jf. gældende EU GDPR-lovgivning.') }}</p>
                    <p><strong>5. {{ __('Spørgsmål') }}:</strong> {{ __('Kontakt os på') }} <a href="mailto:info@freyaservice.dk" class="text-brand-action underline font-semibold">info@freyaservice.dk</a> {{ __('eller på akuttelefon') }} <a href="tel:+4528260926" class="text-brand-action underline font-semibold">+45 28 26 09 26</a>.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-brand-border flex items-center justify-end">
                    <button type="button" @click="showGdprModal = false" class="px-5 py-2.5 rounded-xl bg-brand-secondary hover:bg-navy-800 text-white font-bold text-xs transition cursor-pointer">
                        {{ __('Forstået og luk') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
