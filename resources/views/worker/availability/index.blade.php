<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Rådighedskalender & Arbejdstider</h1>
                <p class="text-xs text-slate-500 mt-0.5">Angiv hvilke dage og tidsrum du er til rådighed for vikardækning.</p>
            </div>
            <a href="{{ route('worker.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 shadow-xs transition">
                <x-heroicon-o-arrow-left class="w-3.5 h-3.5" />
                <span>Tilbage</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('worker.availability.update') }}" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b border-slate-100 pb-3 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1">
                <div>
                    <h2 class="text-base font-bold text-slate-900">Ugentlig tilbagevendende rådighed</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Vores matchningsalgoritme foreslår kun vagter, der passer til dine åbningstider.</p>
                </div>
                <span class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200/60">Auto-matching aktiv</span>
            </div>

            <div class="space-y-4">
                @foreach($days as $dayKey => $dayName)
                    @php $av = $availabilities->get($dayKey); @endphp
                    <div x-data="{ enabled: {{ ($av && $av->is_available) || ! $av ? 'true' : 'false' }} }"
                        class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">

                        <div class="flex items-center gap-3 w-full sm:w-48">
                            <label class="relative inline-flex items-center cursor-pointer shrink-0">
                                <input type="checkbox" name="days[{{ $dayKey }}][is_available]" value="1" x-model="enabled" class="sr-only peer">
                                <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                            <span class="font-bold text-sm text-slate-900">{{ $dayName }}</span>
                        </div>

                        <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 sm:gap-3 w-full sm:w-auto" x-show="enabled">
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 flex-1 sm:flex-initial">
                                <span>Fra:</span>
                                <input type="time" name="days[{{ $dayKey }}][start_time]" value="{{ $av ? substr($av->start_time, 0, 5) : '08:00' }}" class="text-xs rounded-lg border-slate-300 py-1.5 px-2 w-full sm:w-auto">
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-slate-600 flex-1 sm:flex-initial">
                                <span>Til:</span>
                                <input type="time" name="days[{{ $dayKey }}][end_time]" value="{{ $av ? substr($av->end_time, 0, 5) : '16:00' }}" class="text-xs rounded-lg border-slate-300 py-1.5 px-2 w-full sm:w-auto">
                            </div>
                        </div>

                        <div x-show="!enabled" class="text-xs text-slate-400 italic">
                            Ikke til rådighed på denne ugedag
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pt-4 border-t border-slate-200 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md transition text-center">
                    Gem rådighedsplan
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
