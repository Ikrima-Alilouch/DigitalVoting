<x-layouts.default>
    <x-slot name="title">ProfileEdit</x-slot>

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <h2 class="mb-4 text-2xl font-semibold text-center text-gray-700">Edit profile</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Profile Picture</label>
                <input type="file" name="profilepic" id="profilepic" class="w-full px-4 py-2 mt-1 border rounded-lg">
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Firstname</label>
                <input name="firstname" id="firstname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->firstname }}">
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Infix</label>
                <input name="infix" id="infix" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->infix }}">
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Lastname</label>
                <input name="lastname" id="lastname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->lastname }}">
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">E-mailadress</label>
                <input name="email" id="email" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg"
                       value="{{ $user->email }}">
                @error('email')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Save
            </button>
        </form>
    </div>

</x-layouts.default>
