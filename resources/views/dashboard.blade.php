<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-navy leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <div class="text-ink">
                    {{ __("You're logged in!") }}
                </div>
            </x-card>
        </div>
    </div>
</x-app-layout>
