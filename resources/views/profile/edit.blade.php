<x-layouts.default>
    <x-slot name="title">ProfileEdit</x-slot>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939]">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Profile</h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div class="mb-4">
                        <label for="profilepic" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                        <input type="file" name="profilepic" id="profilepic"
                               class="bg-gray-50 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}"
                                   class="bg-gray-50 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="infix" class="block text-sm font-medium text-gray-700 mb-1">Infix</label>
                            <input type="text" name="infix" id="infix" value="{{ $user->infix }}"
                                   class="bg-gray-50 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div class="col-span-2">
                            <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}"
                                   class="bg-gray-50 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div class="col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}"
                                   class="bg-gray-50 w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
