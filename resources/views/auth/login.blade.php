@extends('layouts.app')

@section('content')
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <div class="text-center mb-8">
            <img src="{{ asset('image/website-logo3.png') }}" alt="Logo" class="mx-auto h-20 w-auto mb-4 transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Welcome back</h2>
            <p class="text-gray-600">Please sign in to your account</p>
        </div>

        <form action="{{ route("login.post") }}" method="POST">
            @csrf
            <div>
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
                           placeholder="Enter your email">
                </div>
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
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


            <button type="submit" class="mt-3 w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Login
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Don't have an account yet? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
        </p>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            let passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        });

        document.getElementById('BSNnumber').addEventListener('input', function() {
            if (this.value.length > 9) {
                this.value = this.value.slice(0, 9);
            }
        });

        document.getElementById('BSNnumber').addEventListener('keydown', function(e) {
            if (['-', '+', '.'].includes(e.key)) {
                e.preventDefault();
            }
        })
    </script>
@endsection
