<x-layouts.default>
    <x-slot name="title">Register</x-slot>

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md mx-auto border border-[#1E2939] m-16">
        <h2 class="mb-4 text-2xl font-semibold text-center text-gray-700">Register</h2>

        <form action="{{ route("register.post") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Profile Picture</label>
                <input type="file" name="profilepic" id="profilepic"
                       class="w-full px-4 py-2 mt-1 border rounded-lg">
                @error('profilepic')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Firstname</label>
                <input name="firstname" id="firstname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old("firstname") }}" placeholder="Enter your firstname" required autofocus>
                @error('firstname')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Infix</label>
                <input name="infix" id="infix" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old("infix") }}" placeholder="Enter your infix">
                @error('infix')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Lastname</label>
                <input name="lastname" id="lastname" type="text"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old("lastname") }}" placeholder="Enter your lastname" required>
                @error('lastname')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">Birthdate</label>
                <input name="birthdate" id="birthdate" type="date"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old("birthdate") }}" placeholder="Enter your birthdate" required>
                @error('birthdate')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">E-mailadress</label>
                <input name="email" id="email" type="email"
                       class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                       value="{{ old('email') }}" placeholder="Enter your e-mailadress" required>
                @error('email')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Password</label>
                <div class="relative w-full">
                    <input name="password" id="password" type="password"
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                           placeholder="Enter your password" required>
                    <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 px-3 flex items-center bg-gray-100 border border-black hover:bg-gray-200 rounded-r-lg cursor-pointer">
                        👁️
                    </button>
                </div>
                @error('password')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Confirm password</label>
                <div class="relative w-full">
                    <input name="password_confirmation" id="confirmPassword" type="password"
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                           placeholder="Confirm your password" required>
                    <button type="button" id="toggleConfirmPassword"
                            class="absolute inset-y-0 right-0 px-3 flex items-center bg-gray-100 border border-black hover:bg-gray-200 rounded-r-lg cursor-pointer">
                        👁️
                    </button>
                </div>
                @error('password_confirmation')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-600">BSNnumber</label>
                    <input name="BSNnumber" id="BSNnumber" type="number" min="000000001" max="999999999"
                    class="w-full px-4 py-2 mt-1 border rounded-lg focus:ring focus:ring-blue-300"
                    value="{{ old('BSNnumber') }}" placeholder="Enter your BSNnumber" required>
                @error('BSNnumber')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Register
            </button>
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
            if (['-', '+', '.'].includes(e.key)) {
                e.preventDefault();
            }
        })
    </script>
</x-layouts.default>
