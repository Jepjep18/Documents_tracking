<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __("Welcome to your Dashboard!") }}</h3>
                    
                    <p>{{ __("You're logged in!") }}</p>
                    
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold mb-2">{{ __("Quick Links") }}</h4>
                        <ul class="list-disc list-inside">
                            <li><a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">{{ __("Edit Profile") }}</a></li>
                            <li><a href="{{ route('doctrack.index') }}" class="text-blue-500 hover:underline">{{ __("Document Tracking") }}</a></li>
                        </ul>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
