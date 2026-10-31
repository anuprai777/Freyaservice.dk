<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#C9A24B]"></span>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">{{ __('Vikarprofil & Bankoplysninger') }}</h1>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">{{ __('Opdater dine personlige informationer, kompetencer og udbetalingskonto.') }}</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>{{ __('Tilbage') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <x-heroicon-s-check-circle class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Quick Access to Client Shifts -->
        <x-card variant="sand" hover="true" class="border-[#7B1E3A]/20 bg-[#FAF5F2]">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white border border-[#7B1E3A]/20 text-[#7B1E3A] flex items-center justify-center shrink-0">
                        <x-heroicon-o-briefcase class="w-5 h-5 text-[#7B1E3A]" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">{{ __('Er du til rådighed for vagter?') }}</h3>
                        <p class="text-xs text-slate-500">{{ __('Kunder uploader løbende nye bemandingsforespørgsler på platformen.') }}</p>
                    </div>
                </div>
                <a href="{{ route('worker.offers.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#7B1E3A] hover:bg-[#5A1429] text-white shadow-xs transition shrink-0">
                    <span>{{ __('Se alle ledige vagter') }}</span>
                    <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                </a>
            </div>
        </x-card>

        <x-card padding="lg">
            <form method="POST" action="{{ route('worker.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Personal Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-xs">1</span>
                        <h2 class="text-base font-bold text-slate-900">{{ __('Personlige oplysninger') }}</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Fulde Navn')" />
                            <x-text-input id="name" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="text" name="name" :value="old('name', $user->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Telefonnummer')" />
                            <x-text-input id="phone" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="tel" name="phone" :value="old('phone', $user->phone)" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="postcode" :value="__('Postnummer')" />
                            <x-text-input id="postcode" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="text" name="postcode" :value="old('postcode', $worker->postcode)" required />
                            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('By')" />
                            <x-text-input id="city" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="text" name="city" :value="old('city', $worker->city)" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Skills & Work Preferences -->
                <div class="space-y-4 pt-6 border-t border-slate-200">
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span class="w-6 h-6 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-xs">2</span>
                        <h2 class="text-base font-bold text-slate-900">{{ __('Fagområder & Ansættelsesform') }}</h2>
                    </div>

                    <div>
                        <x-input-label for="availability_type" :value="__('Foretrukken type af vagter')" />
                        <select id="availability_type" name="availability_type" class="mt-1 block w-full rounded-xl border-slate-300 text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]">
                            <option value="any" {{ old('availability_type', $worker->availability_type) === 'any' ? 'selected' : '' }}>{{ __('Alle vagttyper (fleksibel)') }}</option>
                            <option value="temporary" {{ old('availability_type', $worker->availability_type) === 'temporary' ? 'selected' : '' }}>{{ __('Kun tilkaldevikar / Akutte vagter') }}</option>
                            <option value="part_time" {{ old('availability_type', $worker->availability_type) === 'part_time' ? 'selected' : '' }}>{{ __('Deltid (faste ugedage)') }}</option>
                            <option value="full_time" {{ old('availability_type', $worker->availability_type) === 'full_time' ? 'selected' : '' }}>{{ __('Fuldtid / Fastansættelse') }}</option>
                        </select>
                    </div>

                    <div>
                        <span class="block text-xs font-bold text-slate-700 mb-2">{{ __('Dine kompetencer (afkryds relevante)') }}</span>
                        @php $currentSkills = $worker->skills ?? []; @endphp
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 text-xs text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-200">
                            @foreach(['Tjener', 'Bartender', 'Opvasker', 'Køkkenhjælp', 'Kok', 'Rengøring', 'Lager', 'Pluk & Pak', 'Truckfører', 'Reception', 'Kontor', 'Chauffør'] as $skillName)
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="skills[]" value="{{ $skillName }}"
                                        {{ in_array($skillName, (array)$currentSkills, true) ? 'checked' : '' }}
                                        class="rounded text-[#7B1E3A] focus:ring-[#7B1E3A]">
                                    <span>{{ __($skillName) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Kort profiltekst / Erfaring')" />
                        <textarea id="notes" name="notes" rows="3" class="w-full text-xs rounded-xl border-slate-300 focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" placeholder="{{ __('Beskriv kort din erfaring, hygiejnebeviser, sprogkundskaber etc...') }}">{{ old('notes', $worker->notes) }}</textarea>
                    </div>
                </div>

                <!-- Encrypted Bank Details -->
                <div class="space-y-4 pt-6 border-t border-slate-200">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-[#FAF5F2] border border-[#7B1E3A]/20 text-[#7B1E3A] font-bold flex items-center justify-center text-xs">3</span>
                            <x-heroicon-o-lock-closed class="w-4 h-4 text-[#7B1E3A]" />
                            <h2 class="text-base font-bold text-slate-900">{{ __('Bankoplysninger til lønudbetaling') }}</h2>
                        </div>
                        <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 flex items-center gap-1">
                            <x-heroicon-s-shield-check class="w-3.5 h-3.5 text-emerald-600" />
                            <span>{{ __('Krypteret i database') }}</span>
                        </span>
                    </div>

                    <div class="bg-[#FAF5F2] p-4 rounded-xl border border-[#7B1E3A]/20 text-xs text-slate-700 leading-relaxed">
                        {{ __('FreyaService gemmer dine bankoplysninger fuldt krypteret jf. gældende GDPR-lovgivning. Vi indsamler ikke dit CPR-nummer på platformen.') }}
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="bank_reg_number" :value="__('Registreringsnr. (4 cifre)')" />
                            <x-text-input id="bank_reg_number" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="text" maxlength="4" name="bank_reg_number" :value="old('bank_reg_number', $worker->bank_reg_number ? '••••' : '')" placeholder="{{ __('F.eks. 3001') }}" />
                            <x-input-error :messages="$errors->get('bank_reg_number')" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="bank_account_number" :value="__('Kontonummer (op til 10 cifre)')" />
                            <x-text-input id="bank_account_number" class="block mt-1 w-full text-xs focus:border-[#7B1E3A] focus:ring-[#7B1E3A]" type="text" maxlength="10" name="bank_account_number" :value="old('bank_account_number', $worker->bank_account_number ? '••••••••' : '')" placeholder="{{ __('F.eks. 0012345678') }}" />
                            <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-6 border-t border-slate-200 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-[#7B1E3A] hover:bg-[#5A1429] text-white font-bold text-sm shadow-md transition">
                        <x-heroicon-s-check class="w-4 h-4 text-[#C9A24B]" />
                        <span>{{ __('Gem profilændringer') }}</span>
                    </button>
                </div>
            </form>
        </x-card>

    </div>
</x-app-layout>