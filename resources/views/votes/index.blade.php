<x-layouts.default>
    <x-slot:title>
        Voting Page
    </x-slot>

    <div class="max-w-3xl mx-auto py-12">
        <h2 class="text-3xl font-bold text-indigo-700 mb-6">Cast Your Vote</h2>
        <p class="mb-8 text-gray-600">Welcome to the voting page. Here you can select your preferred party or candidate and submit your vote securely.</p>
        <!-- Example voting form -->
        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Choose your party:</label>
                <select class="w-full border border-gray-300 rounded px-3 py-2" name="party">
                    <option value="">-- Select --</option>
                    <option value="party1">Party 1</option>
                    <option value="party2">Party 2</option>
                    <option value="party3">Party 3</option>
                </select>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Submit Vote</button>
        </form>
    </div>
</x-layouts.default>