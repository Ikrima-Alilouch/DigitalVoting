<x-layouts.default>
    <x-slot name="title">Thank You</x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Thank You for Voting!</h1>
                    <p class="text-lg text-gray-600 mb-8">Your vote has been successfully recorded.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Return to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.default> 