<nav class="bg-gradient-to-r from-blue-600 to-blue-950 shadow-lg">
    <div class="container mx-auto px-4 sm:px-6 lg:px-80 py-3">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="transition transform hover:scale-105 duration-300">
                <img src="{{ asset('image/website-logo3.png') }}" alt="Logo" class="h-16 w-18 inline-block">
            </a>
            <div class="flex items-center space-x-6">
                <a href="{{ route('votes.index') }}" class="text-white hover:text-blue-200 transition-colors duration-300 py-2 px-3 rounded-md text-sm font-medium hover:bg-blue-700/50">Vote</a>
                <a href="#" class="text-white hover:text-blue-200 transition-colors duration-300 py-2 px-3 rounded-md text-sm font-medium hover:bg-blue-700/50">Parties</a>
                <a href="#" class="text-white hover:text-blue-200 transition-colors duration-300 py-2 px-3 rounded-md text-sm font-medium hover:bg-blue-700/50">Voting overview</a>
                <div class="relative">
                    <button id="profileDropdown" class="text-white hover:text-blue-200 transition-all duration-300 py-2 px-4 rounded-md text-sm font-medium flex items-center hover:bg-blue-700/50">
                        <div class="flex items-center cursor-pointer">
                            @if( auth()->check() )
                                <span>{{ auth()->user()->firstname }}</span>
                                <span class="mx-2 text-blue-200">|</span>
                                <img src="{{ asset('storage/' . auth()->user()->profilepic) }}"
                                     alt="Profile Picture"
                                     class="h-8 w-8 rounded-full border-2 border-white/50 hover:border-white transition-all duration-300">
                            @else
                                <span>Profile</span>
                                <span class="mx-2 text-blue-200">|</span>
                                <img src="{{ asset('storage/image/user-icon-white.png') }}" alt="User Profile Icon" class="h-6 w-6">
                            @endif
                        </div>
                    </button>
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 transform transition-all duration-200 origin-top-right z-50">
                        <div class="py-1">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">My votes</a>
                            @if(auth()->check())
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 transition-colors duration-200">Login | Register</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const profileDropdown = document.getElementById('profileDropdown');
    const profileMenu = document.getElementById('profileMenu');

    profileDropdown.addEventListener('click', () => {
        profileMenu.classList.toggle('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!profileDropdown.contains(e.target)) {
            profileMenu.classList.add('hidden');
        }
    });
</script>
