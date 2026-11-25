@extends('layouts.app')

@section('content')
    <div class="w-150 p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <div class="text-center mb-8">
            <img src="{{ asset('image/website-logo3.png') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4 transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Create account</h2>
            <p class="text-gray-600">Create an digivote account to continue</p>
        </div>

        <form action="{{ route("register.post") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div class="grid grid-cols-4 gap-6">
                    <div class="mb-4 col-span-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                        <input type="file" name="profilepic" id="profilepic"
                               class="appearance-none relative block w-full px-4 pr-3 py-3 border border-gray-300
                                      placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                               @if ($errors->any())
                                    <div class="mb-4 p-3 bg-yellow-100 text-yellow-700 border border-yellow-400 rounded">
                                    <strong>Warning: </strong> You need to reselect your profile picture.
                                    </div>
                               @endif
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Firstname</label>
                        <input name="firstname" id="firstname" type="text"
                               class="appearance-none relative block w-full px-4 pr-3 py-3 border border-gray-300
                                          placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               value="{{ old("firstname") }}" placeholder="Enter your firstname" required autofocus>
                        @error('firstname')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Infix</label>
                        <input name="infix" id="infix" type="text"
                               class="appearance-none relative block w-full px-4 pr-3 py-3 border border-gray-300
                                          placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               value="{{ old("infix") }}" placeholder="Enter your infix">
                        @error('infix')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lastname</label>
                        <input name="lastname" id="lastname" type="text"
                               class="appearance-none relative block w-full px-4 pr-3 py-3 border border-gray-300
                                          placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               value="{{ old("lastname") }}" placeholder="Enter your lastname" required>
                        @error('lastname')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Birthdate</label>
                        <input name="birthdate" id="birthdate" type="date"
                               class="appearance-none relative block w-full px-4 pr-3 py-3 border border-gray-300
                                          placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               value="{{ old("birthdate") }}" placeholder="Enter your birthdate" required>
                        @error('birthdate')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" required
                                   class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300
                                          placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   value="{{ old("email") }}"
                                   placeholder="Enter your email">
                        </div>
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                   class="appearance-none block w-full px-3 py-2.5 pl-10 border border-gray-300 rounded-lg
                                          placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="togglePassword" class="focus:outline-none">
                                    <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14.048 10a4 4 0 10-8.096 0 4 4 0 008.096 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="confirmPassword" required
                                   class="appearance-none block w-full px-3 py-2.5 pl-10 border border-gray-300 rounded-lg
                                          placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Confirm password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button"  id="toggleConfirmPassword" class="focus:outline-none">
                                    <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14.048 10a4 4 0 10-8.096 0 4 4 0 008.096 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">BSNnumber</label>
                            <input name="BSNnumber" id="BSNnumber" type="number" min="000000001" max="999999999"
                            class="appearance-none relative block w-full pl-10 px-4 py-3 border border-gray-300
                                  placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none
                                  focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"                        value="{{ old('BSNnumber') }}" placeholder="Enter your BSNnumber" required>
                        @error('BSNnumber')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                    Register
                </button>
            </div>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a>
        </p>
    </div>

    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === "password" ? "text" : "password";
        }

        document.getElementById("togglePassword").addEventListener("click", function() {
            togglePassword('password');
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            togglePassword('confirmPassword');
        });

        document.getElementById('BSNnumber').addEventListener('input', function() {
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
            }
        });

        document.getElementById('BSNnumber').addEventListener('keydown', function(e) {
            if (['-', '+', '.', 'e'].includes(e.key)) {
                e.preventDefault();
            }
        })
    </script>
@endsection
