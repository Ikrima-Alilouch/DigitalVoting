<x-layouts.default>
    <x-slot name="title">Parties</x-slot>

    <div id="mainContent" class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 transition-all duration-300 ease-in-out">
        <button class="float-right">
            <a class="mb-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-300" href="{{ route('admin.parties.create') }}">Create Party</a>
        </button>
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Political Parties</h1>

            <!-- Filter Controls -->
            <div class="mb-6 bg-white p-4 rounded-lg shadow">
                <form action="{{ route('admin.parties.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="deactivated" {{ request('status') == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select name="sort" id="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($parties as $party)
                    <div class="bg-white overflow-hidden shadow rounded-lg cursor-pointer hover:shadow-lg transition-shadow duration-300"
                         onclick="showPartyDetails({{ $party->partyID }})">
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $party->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($party->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Party Details Modal -->
    <div id="partyModal" class="fixed inset-0 flex items-center justify-center z-50  bg-opacity-50 backdrop-blur-sm hidden">
        <!-- The actual modal content (white box) -->
        <div class="relative p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white transform transition-all duration-300 ease-in-out">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold text-gray-900" id="modalPartyName"></h3>
                <button onclick="closePartyModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <img id="modalPartyLogo" class="h-20 w-20 rounded-full object-cover" src="" alt="">
                    <div>
                        <p class="text-sm text-gray-500">Party Leader</p>
                        <p id="modalPartyLeader" class="text-lg font-medium"></p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-medium text-gray-900">Description</h4>
                    <p id="modalPartyDescription" class="mt-1 text-gray-600"></p>
                </div>

                <div>
                    <h4 class="text-lg font-medium text-gray-900">Members</h4>
                    <div id="modalPartyMembers" class="mt-2 space-y-2"></div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <a id="modalEditLink" href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Edit Party
                    </a>
                    <a id="modalMembersLink" href="#" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Manage Members
                    </a>
                    <form id="modalDeleteForm" action="#" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this party?')"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Delete Party
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showPartyDetails(partyId) {
                // Show the modal first
                document.getElementById('partyModal').classList.remove('hidden');
                // Prevent background scrolling
                document.body.style.overflow = 'hidden';

                fetch(`/admin/parties/${partyId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modalPartyName').textContent = data.name;
                        document.getElementById('modalPartyLogo').src = data.logo ? `/storage/${data.logo}` : '';
                        document.getElementById('modalPartyLeader').textContent = `${data.leader_firstname} ${data.leader_infix ? data.leader_infix + ' ' : ''}${data.leader_lastname}`;
                        document.getElementById('modalPartyDescription').textContent = data.description || 'No description available';

                        const membersContainer = document.getElementById('modalPartyMembers');
                        membersContainer.innerHTML = '';
                        if (data.members && data.members.length > 0) {
                            data.members.forEach(member => {
                                membersContainer.innerHTML += `
                            <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded">
                                <div>
                                    <p class="text-sm text-gray-900">${member.firstname} ${member.infix ? member.infix + ' ' : ''}${member.lastname}</p>
                                    <p class="text-sm text-gray-500">${member.role}</p>
                                </div>
                            </div>
                        `;
                            });
                        } else {
                            membersContainer.innerHTML = '<p class="text-gray-500">No members found</p>';
                        }

                        document.getElementById('modalEditLink').href = `/admin/parties/${partyId}/edit`;
                        document.getElementById('modalMembersLink').href = `/admin/parties/${partyId}/members`;
                        document.getElementById('modalDeleteForm').action = `/admin/parties/${partyId}`;
                    })
                 
            }

            function closePartyModal() {
                document.getElementById('partyModal').classList.add('hidden');
                // Restore background scrolling
                document.body.style.overflow = '';
            }

            // Close modal when clicking outside
            document.getElementById('partyModal').addEventListener('click', function(e) {
                // Only close if the click target is the modal container itself (the dimming overlay area)
                if (e.target === this) {
                    closePartyModal();
                }
            });

            // Prevent modal from closing when clicking inside the modal content
            // This listener is now on the actual modal content div, not its parent container
            document.querySelector('#partyModal > div.relative').addEventListener('click', function(e) {
                e.stopPropagation();
            });
        </script>
    @endpush
</x-layouts.default>
