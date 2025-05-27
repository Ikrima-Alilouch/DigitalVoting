<x-layouts.default>
    <x-slot name="title">Create New Party</x-slot>

    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Party</h1>

            <form action="{{ route('admin.parties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Party Logo</label>
                    <input type="file" name="image" id="image"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="partyName" class="block text-sm font-medium text-gray-700 mb-1">Party Name</label>
                    <input type="text" name="partyName" id="partyName"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required autofocus>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <input type="text" name="description" id="description"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="window.location.href='{{ route('admin.parties.index') }}'"
                            class="bg-gray-300 text-gray-700 hover:bg-gray-400 transition-colors duration-300 py-2 px-4 rounded-md mr-2">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-blue-950 text-white hover:text-blue-200 transition-colors duration-300 py-2 px-4 rounded-md hover:bg-blue-800">
                        Create Party
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
