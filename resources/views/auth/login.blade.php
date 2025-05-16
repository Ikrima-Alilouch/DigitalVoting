<x-layouts.default>
    <x-slot name="title">Login</x-slot>

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <h2 class="mb-4 text-2xl font-semibold text-center text-gray-700">Login</h2>

        <form action="{{ route("login.post") }}" method="POST">
            @csrf
            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Email</label>
                <input name="email" id="email" type="email"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old("email") }}" placeholder="Enter your email">
                @error('email')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Password</label>
                <div class="relative w-full">
                    <input id="password" type="password" name="password"
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                           placeholder="Enter your password">
                    <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 px-3 flex items-center bg-gray-100 border border-black hover:bg-gray-200 rounded-r-lg cursor-pointer">
                        👁️
                    </button>
                </div>
                @error('password')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
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
</x-layouts.default>
