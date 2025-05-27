<x-layouts.default>
    <x-slot name="title">Manage Party Members - {{ $party->name }}</x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Manage Members - {{ $party->name }}</h1>
                <a href="{{ route('admin.parties.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Back to Parties
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Party Members</h3>
                        <button type="button" onclick="addMember()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Add Member
                        </button>
                    </div>

                    <form action="{{ route('admin.parties.members.update', $party->partyID) }}" method="POST" id="members-form">
                        @csrf
                        @method('PUT')
                        <div id="members-container">
                            @foreach($party->members as $index => $member)
                                <div class="member-entry border-b pb-4 mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-md font-medium text-gray-700">Member {{ $index + 1 }}</h4>
                                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-900">
                                            Remove
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                                            <input type="text" name="members[{{ $index }}][firstname]" value="{{ $member->firstname }}" required
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Infix</label>
                                            <input type="text" name="members[{{ $index }}][infix]" value="{{ $member->infix }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                            <input type="text" name="members[{{ $index }}][lastname]" value="{{ $member->lastname }}" required
                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Save Members
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addMember() {
            const container = document.getElementById('members-container');
            const memberIndex = container.children.length;
            
            const memberHtml = `
                <div class="member-entry border-b pb-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-md font-medium text-gray-700">Member ${memberIndex + 1}</h4>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-900">
                            Remove
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="members[${memberIndex}][firstname]" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Infix</label>
                            <input type="text" name="members[${memberIndex}][infix]"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="members[${memberIndex}][lastname]" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', memberHtml);
        }
    </script>
</x-layouts.default> 