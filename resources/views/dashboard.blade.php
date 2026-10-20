<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-brand-secondary leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-brand-surface border border-brand-border overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6 text-brand-body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
