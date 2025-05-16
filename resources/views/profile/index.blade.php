<x-layouts.default>
    <x-slot name="title">Profile</x-slot>

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <h2 class="mb-4 text-2xl font-semibold text-center text-gray-700">Your profile</h2>

            <div class="mb-2 text-center">
                <img src="storage/{{ $user->profilepic }}" alt="Logo" class="h-20 w-20 inline-block mr-2">
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Firstname</label>
                <input name="firstname" id="firstname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->firstname }}" readonly>
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Infix</label>
                <input name="infix" id="infix" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->infix }}" readonly>
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Lastname</label>
                <input name="lastname" id="lastname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->lastname }}" readonly>
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Birthdate</label>
                <input name="birthdate" id="birthdate" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->birthdate }}" readonly>
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">E-mailadress</label>
                <input name="email" id="email" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->email }}" readonly>
            </div>

            <button type="button" onclick="window.location.href='{{ route('profile.edit') }}'" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Edit
            </button>
    </div>

</x-layouts.default>
