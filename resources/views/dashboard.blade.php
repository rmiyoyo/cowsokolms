<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lms-card p-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ __("Welcome back!") }}</h3>
                    <p class="text-lg text-gray-600">{{ __("You're logged in and ready to learn or teach.") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>