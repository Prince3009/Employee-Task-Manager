<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-200">
                <p class="text-lg text-gray-700">
                    👋 You are logged in as <span class="font-semibold text-blue-600">Admin</span>!
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
