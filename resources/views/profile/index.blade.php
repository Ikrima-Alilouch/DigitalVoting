<x-layouts.default>
    <x-slot name="title">Profile</x-slot>

    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-xl mx-auto p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
            <div class="relative mb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 h-32 rounded-t-2xl"></div>
                <div class="relative pt-8 text-center">
                    <div class="inline-block p-2 bg-white rounded-full shadow-lg">
                        <img src="storage/{{ $user->profilepic }}"
                             alt="Profile Picture"
                             class="h-24 w-24 rounded-full object-cover border-4 border-white">
                    </div>
                    <h2 class="mt-4 text-3xl font-bold text-gray-800">Your Profile</h2>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Firstname</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                            {{ $user->firstname }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Infix</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                            {{ $user->infix ?: '-' }}
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lastname</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                            {{ $user->lastname }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                            {{ $user->birthdate }}
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">E-mail address</label>
                        <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="button"
                            onclick="window.location.href='{{ route('profile.edit') }}'"
                            class="w-full px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg
                                   hover:from-blue-600 hover:to-blue-700 transform transition-all duration-200
                                   hover:shadow-lg font-semibold flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.default>
