<x-layouts.default>
    <x-slot name="title">Parties</x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <button class="float-right">
            <a class="mb-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300" href="{{ route('admin.parties.create') }}">Create Party</a>
        </button>
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Political Parties</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach( $parties as $party)
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                @if($party->image)
                                    <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $party->image) }}" alt="{{ $party->name }}">
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
                                <p class="text-sm text-gray-600">{{ $party->description }}</p>
                            </div>

                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-900">Party Members</h4>
                                <ul class="mt-2 space-y-2">
                                    @foreach($party->members as $member)
                                        <li class="text-sm text-gray-600">
                                            {{ $member->firstname }}
                                            {{ $member->infix ? $member->infix . ' ' : '' }}
                                            {{ $member->lastname }}
                                            <span class="text-gray-500">({{ $member->role }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $party->seats }} Seats
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.default>
