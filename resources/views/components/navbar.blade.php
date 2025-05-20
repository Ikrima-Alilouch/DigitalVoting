<nav class="bg-gray-800 p-4">
    <div class="container mx-auto px-4 sm:px-6 lg:px-80">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}">
                <img src="{{ asset('image/website-logo3.png') }}" alt="Logo" class="h-15 w-20 inline-block mr-2">
            </a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('votes.index') }}" class="text-white hover:text-gray-300 py-2 rounded-md text-sm font-medium">Vote</a>
                <a href="#" class="text-white hover:text-gray-300 py-2 rounded-md text-sm font-medium">Parties</a>
                <a href="#" class="text-white hover:text-gray-300 py-2 rounded-md text-sm font-medium">Voting overview</a>
                <div class="relative ">
                    <button id="profileDropdown" class="text-white hover:text-gray-300 py-2 rounded-md text-sm font-medium flex items-center ">
                        <div class="flex items-center cursor-pointer">
                            @if( auth()->check() )
                                <span>{{ auth()->user()->firstname }}</span>
                                <span class="mx-2">|</span>
                                <img src="{{ asset('storage/' . auth()->user()->profilepic) }}"
                                     alt="Profile Picture"
                                     class="h-6 w-6 border-1 border-white mr-4">
                            @else
                                <span>Profile</span>
                                <span class="mx-2">|</span>
                                <img src="{{ asset('storage/image/user-icon-white.png') }}" alt="User Profile Icon" class="h-5 w-5">
                            @endif
                        </div>
                        </button>
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My votes</a>
                            @if(auth()->check())
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login | Register</a>
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
