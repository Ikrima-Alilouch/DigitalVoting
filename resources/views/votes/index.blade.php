<x-layouts.default>
    <x-slot name="title">Vote</x-slot>
        <div id="mainContent" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 transition-all duration-300 ease-in-out">
            <div class="px-4 py-6 sm:px-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Political Parties</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach( $parties as $party)
                        <div class="bg-white overflow-hidden shadow rounded-lg cursor-pointer hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex items-center space-x-4">
                                    @if($party->logo)
                                        <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $party->logo) }}" alt="{{ $party->name }}">
                                    @endif
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $party->name }}</h3>
                                        <p class="text-sm text-gray-500">
                                            Leader: {{ $party->leader_firstname }}
                                            {{ $party->leader_infix ? $party->leader_infix . ' ' : '' }}
                                            {{ $party->leader_lastname }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">{{ Str::limit($party->description, 100) }}</p>
                                </div>

                                <div class="mt-4">
                                    <button>
                                        <a class="mb-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300" href="">Vote</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-layouts.default>

