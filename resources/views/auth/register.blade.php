@php
    $role = old('role', request('role', 'client'));
    if (!in_array($role, ['client', 'worker'], true)) {
        $role = 'client';
    }
    $isClient = $role === 'client';
@endphp

<x-guest-layout max-width="sm:max-w-xl">
    <x-slot name="title">{{ $isClient ? __('Opret virksomhedskonto') : __('Opret vikarprofil') }}</x-slot>

    <div x-data="{ showGdprModal: false }" class="w-full">
        <!-- Header: Dedicated to {{ $isClient ? 'Company' : 'Worker' }} Account -->
        <div class="mb-6 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full {{ $isClient ? 'bg-[#C9A24B]/15 text-[#8C6C27] border border-[#C9A24B]/30' : 'bg-burgundy/10 text-burgundy border border-burgundy/20' }} text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full {{ $isClient ? 'bg-[#C9A24B]' : 'bg-burgundy' }}"></span>
                <span>{{ $isClient ? __('Virksomhedskonto') : __('Vikarprofil') }}</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-navy tracking-tight">
                {{ $isClient ? __('Opret virksomhedskonto') : __('Opret vikarprofil') }}
            </h2>
            <p class="text-xs sm:text-sm text-ink/70 mt-1.5 max-w-md mx-auto">
                {{ $isClient ? __('Bestil kvalificerede vikarer og styr bemandingen digitalt') : __('Tilmeld dig som vikar og få adgang til ledige vagter') }}
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="role" value="{{ $role }}">

            <!-- Common: Name -->
            <div>
                <x-input-label for="name" :value="$isClient ? __('Kontaktpersonens fulde navn') : __('Fulde Navn')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Indtast fulde navn') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Common: Email & Phone Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="email" :value="__('E-mailadresse')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="{{ $isClient ? 'kontakt@virksomhed.dk' : 'din.email@gmail.com' }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="phone" :value="__('Telefonnummer (dansk format)')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" placeholder="+45 12 34 56 78" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            @if($isClient)
                <!-- Client-only Fields (Virksomhed) -->
                <div class="space-y-4 pt-3 border-t border-mist">
                    <div class="flex items-center gap-2 text-xs font-bold text-navy uppercase tracking-wider">
                        <x-heroicon-o-building-office class="w-4 h-4 text-teal shrink-0" />
                        <span>{{ __('Virksomhedsoplysninger') }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="company_name" :value="__('Virksomhedsnavn')" />
                            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" placeholder="Eks. Hotel Nordic A/S" required />
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="cvr" :value="__('CVR-nummer (8 cifre)')" />
                            <x-text-input id="cvr" class="block mt-1 w-full" type="text" maxlength="8" name="cvr" :value="old('cvr')" placeholder="12345678" required />
                            <x-input-error :messages="$errors->get('cvr')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Adresse')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" placeholder="Gadenavn og nummer" autocomplete="street-address" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="postcode_client" :value="__('Postnummer')" />
                            <x-text-input id="postcode_client" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 1620" autocomplete="postal-code" required />
                            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="city_client" :value="__('By')" />
                            <x-text-input id="city_client" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København V" autocomplete="address-level2" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @else
                <!-- Worker-only Fields (Vikar) -->
                <div class="space-y-4 pt-3 border-t border-mist">
                    <div class="flex items-center gap-2 text-xs font-bold text-navy uppercase tracking-wider">
                        <x-heroicon-o-identification class="w-4 h-4 text-teal shrink-0" />
                        <span>{{ __('Vikarprofil & Kompetencer') }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="postcode_worker" :value="__('Dit Postnummer')" />
                            <x-text-input id="postcode_worker" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" placeholder="Eks. 2100" autocomplete="postal-code" required />
                            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="city_worker" :value="__('Din By')" />
                            <x-text-input id="city_worker" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Eks. København Ø" autocomplete="address-level2" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="availability_type" :value="__('Ønsket ansættelsesform')" />
                        <select id="availability_type" name="availability_type" required class="mt-1 block w-full rounded-lg border-mist bg-white shadow-xs focus:border-burgundy focus:ring-2 focus:ring-burgundy text-sm text-ink">
                            <option value="any">{{ __('Alle vagttyper (fleksibel)') }}</option>
                            <option value="temporary">{{ __('Tilkaldevikar (akut dækning / timer)') }}</option>
                            <option value="part_time">{{ __('Deltid (faste dage / weekender)') }}</option>
                            <option value="full_time">{{ __('Fuldtid / Fastansættelse') }}</option>
                        </select>
                    </div>

                    <div>
                        <span class="block font-bold text-xs text-navy uppercase mb-2">{{ __('Vælg dine kompetencer') }}</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-ink bg-sand p-3.5 rounded-xl border border-mist">
                            @foreach([
                                'Tjener' => __('Tjener / Bartender'),
                                'Opvasker' => __('Opvasker / Køkkenhjælp'),
                                'Rengøring' => __('Erhvervsrengøring'),
                                'Lager' => __('Lager & Pakkeri'),
                                'Kontor' => __('Kontor / Reception'),
                                'Chauffør' => __('Bud / Chauffør (B-kørekort)')
                            ] as $skillKey => $skillLabel)
                                <label class="flex items-center gap-2.5 p-2 rounded-lg bg-white border border-mist hover:border-teal/40 transition cursor-pointer">
                                    <input type="checkbox" name="skills[]" value="{{ $skillKey }}" class="rounded border-mist text-teal shadow-xs focus:ring-teal">
                                    <span class="font-medium text-navy">{{ $skillLabel }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-mist">
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
            <div class="pt-3 border-t border-mist">
                <label class="inline-flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" name="gdpr_consent" value="1" required class="mt-1 rounded border-mist text-burgundy shadow-xs focus:ring-burgundy">
                    <span class="text-xs text-ink/70 leading-relaxed">
                        {{ __('Jeg giver samtykke til, at FreyaService behandler mine oplysninger i henhold til') }} 
                        <button type="button" @click.prevent="showGdprModal = true" class="underline text-burgundy hover:text-burgundy-dark font-bold cursor-pointer">{{ __('persondatapolitikken (GDPR)') }}</button>. 
                        {{ __('FreyaService indsamler') }} <strong class="text-navy">{{ __('ikke') }}</strong> {{ __('CPR-numre, og bankoplysninger opbevares altid krypteret.') }}
                    </span>
                </label>
                <x-input-error :messages="$errors->get('gdpr_consent')" class="mt-1" />
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-3 pt-4 border-t border-mist">
                <a class="text-xs text-ink/70 hover:text-burgundy transition underline text-center sm:text-left" href="{{ route('login') }}">
                    {{ __('Har du allerede en konto? Log ind') }}
                </a>

                <x-primary-button class="w-full sm:w-auto px-7 py-3 text-sm">
                    <span>{{ $isClient ? __('Opret virksomhedskonto') : __('Opret vikarprofil') }} &rarr;</span>
                </x-primary-button>
            </div>

            <!-- Switch to opposite role link (clean, subtle text link without distracting toggle) -->
            <div class="mt-6 pt-4 border-t border-mist/70 text-center text-xs text-ink/65">
                @if($isClient)
                    <span>{{ __('Er du vikar og leder efter vagter?') }}</span>
                    <a href="{{ route('register', ['role' => 'worker']) }}" class="font-bold text-burgundy hover:underline ml-1">
                        {{ __('Opret vikarprofil her') }} &rarr;
                    </a>
                @else
                    <span>{{ __('Repræsenterer du en virksomhed?') }}</span>
                    <a href="{{ route('register', ['role' => 'client']) }}" class="font-bold text-burgundy hover:underline ml-1">
                        {{ __('Opret virksomhedskonto her') }} &rarr;
                    </a>
                @endif
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
             class="fixed inset-0 z-50 overflow-y-auto bg-navy/80 backdrop-blur-xs flex items-center justify-center p-4">
            <div @click.away="showGdprModal = false"
                 class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-8 border border-mist shadow-2xl relative text-left">
                <button type="button" @click="showGdprModal = false" class="absolute top-4 right-4 text-ink/50 hover:text-navy p-1 rounded-lg hover:bg-sand transition" aria-label="Luk">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-teal/15 text-teal flex items-center justify-center shrink-0">
                        <x-heroicon-s-shield-check class="w-6 h-6" />
                    </div>
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-navy">{{ __('Persondatapolitik & GDPR') }}</h3>
                        <p class="text-xs text-ink/60">FreyaService • CVR 44556677</p>
                    </div>
                </div>
                <div class="space-y-3 text-xs text-ink/80 leading-relaxed max-h-72 overflow-y-auto pr-1">
                    <p><strong>1. {{ __('Dataminimering') }}:</strong> {{ __('FreyaService indsamler og opbevarer aldrig CPR-numre i sit digitale system.') }}</p>
                    <p><strong>2. {{ __('Sikkerhed') }}:</strong> {{ __('Alle bankoplysninger og personfølsomme data krypteres med AES-256 for optimal datasikkerhed.') }}</p>
                    <p><strong>3. {{ __('Formål') }}:</strong> {{ __('Oplysningerne anvendes udelukkende til administration af vikariater, vagtplanlægning, QR-tidsregistrering og lovpligtig afregning.') }}</p>
                    <p><strong>4. {{ __('Dine rettigheder') }}:</strong> {{ __('Du har til enhver tid ret til indsigt i dine personoplysninger, dataeksport samt sletning ("retten til at blive glemt") jf. gældende EU GDPR-lovgivning.') }}</p>
                    <p><strong>5. {{ __('Spørgsmål') }}:</strong> {{ __('Kontakt os på') }} <a href="mailto:info@freyaservice.dk" class="text-burgundy underline font-semibold">info@freyaservice.dk</a> {{ __('eller på akuttelefon') }} <a href="tel:+4528260926" class="text-burgundy underline font-semibold">+45 28 26 09 26</a>.</p>
                </div>
                <div class="mt-6 pt-4 border-t border-mist flex items-center justify-end">
                    <button type="button" @click="showGdprModal = false" class="px-5 py-2.5 rounded-lg bg-navy hover:bg-navy-800 text-white font-bold text-xs transition cursor-pointer">
                        {{ __('Forstået og luk') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
