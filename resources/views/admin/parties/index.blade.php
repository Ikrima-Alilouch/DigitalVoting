<x-layouts.default>
    <x-slot name="title">PartyManagement</x-slot>

    <div class="flex justify-end">
        <button class="bg-blue-950 text-white hover:text-blue-200 transition-colors duration-300 py-3 px-3 rounded-md m-2 text-sm font-medium hover:bg-blue-800" onclick="window.location.href='{{ route('admin.parties.create') }}'">
            Create New Party
        </button>
    </div>
</x-layouts.default>
