<x-layouts.default>
    <x-slot name="title">Edit Party</x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Edit Party</h1>
                <a href="{{ route('admin.parties.index') }}" class="text-blue-600 hover:text-blue-900">Back to Parties</a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form action="{{ route('admin.parties.update', $party) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Party Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $party->name) }}" required
                                   class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $party->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="seats" class="block text-sm font-medium text-gray-700">Number of Seats</label>
                            <input type="number" name="seats" id="seats" value="{{ old('seats', $party->seats) }}" min="1" required
                                   class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('seats')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" required
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="active" {{ old('status', $party->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="deactivated" {{ old('status', $party->status) == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="party_image" class="block text-sm font-medium text-gray-700">Party Logo</label>
                            @if($party->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $party->image) }}" alt="{{ $party->name }}" class="h-20 w-20 object-cover rounded-md">
                                </div>
                            @endif
                            <input type="file" name="party_image" id="party_image" accept="image/*"
                                   class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300">
                            <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current image</p>
                            @error('party_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="leader_firstname" class="block text-sm font-medium text-gray-700">Leader First Name</label>
                                <input type="text" name="leader_firstname" id="leader_firstname" value="{{ old('leader_firstname', $party->leader_firstname) }}" required
                                       class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('leader_firstname')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="leader_infix" class="block text-sm font-medium text-gray-700">Leader Infix</label>
                                <input type="text" name="leader_infix" id="leader_infix" value="{{ old('leader_infix', $party->leader_infix) }}"
                                       class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('leader_infix')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="leader_lastname" class="block text-sm font-medium text-gray-700">Leader Last Name</label>
                                <input type="text" name="leader_lastname" id="leader_lastname" value="{{ old('leader_lastname', $party->leader_lastname) }}" required
                                       class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('leader_lastname')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Party
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.default>
