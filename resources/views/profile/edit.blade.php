@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-xl mx-auto p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="relative mb-8">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 h-32 rounded-t-2xl"></div>
                <div class="relative pt-8 text-center">
                    <label for="profilepic" class="inline-block p-2 bg-white rounded-full shadow-lg cursor-pointer">
                        <img src="storage/{{ $user->profilepic }}"
                             alt="Profile Picture"
                             class="h-24 w-24 rounded-full object-cover border-4 border-white mx-auto">
                        <input type="file" name="profilepic" id="profilepic" class="hidden" accept="image/*">
                    </label>
                    <h2 class="mt-4 text-3xl font-bold text-gray-800">Your Profile</h2>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">Firstname</label>
                        <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200 w-full">
                    </div>

                    <div class="col-span-1">
                        <label for="infix" class="block text-sm font-medium text-gray-700 mb-1">Infix</label>
                        <input type="text" name="infix" id="infix" value="{{ $user->infix }}" class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200 w-full">
                    </div>

                    <div class="col-span-2">
                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Lastname</label>
                        <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200 w-full">
                    </div>

                    <div class="col-span-1">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
                        <input type="date" name="birthdate" id="birthdate" value="{{ $user->birthdate }}" class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200 w-full">
                    </div>

                    <div class="col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail address</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-200 w-full">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                            class="w-full px-6 py-3 text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg
                                   hover:from-blue-600 hover:to-blue-700 transform transition-all duration-200
                                   hover:shadow-lg font-semibold flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
