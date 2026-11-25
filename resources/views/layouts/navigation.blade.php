<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('image/website-logo.jpg') }}" alt="Logo" class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->check() && !auth()->user()->isAdmin())
                        <x-nav-link :href="route('votes.index')" :active="request()->routeIs('votes.index')">
                            {{ __('Vote') }}
                        </x-nav-link>
                        <x-nav-link :href="route('votes.overview')" :active="request()->routeIs('votes.overview')">
                            {{ __('My Votes') }}
                        </x-nav-link>
                    @endif
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <x-nav-link :href="url('/admin/parties')" :active="request()->is('admin/parties*')">
                            {{ __('Parties') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/admin/votes')" :active="request()->is('admin/votes*')">
                            {{ __('Votes Management') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if(auth()->check())
                    <img src="{{ asset('storage/' . Auth::user()->profilepic) }}" alt="Profile Picture" class="h-9 w-9 rounded-full object-cover border-2 border-white shadow mr-3" />
                @endif
                <!-- Settings Dropdown -->
                <div class="ml-3 relative" x-data="{ open: false }">
                    <button @click="open = !open" @keydown.escape="open = false" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        @if(auth()->check())
                            <div>{{ Auth::user()->name }}</div>
                        @endif
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false" @click="open = false" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50" x-cloak>
                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            {{ __('Profile') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->check() && !auth()->user()->isAdmin())
                <a href="{{ route('votes.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('votes.index') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    {{ __('Vote') }}
                </a>
                <a href="{{ route('votes.overview') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('votes.overview') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    {{ __('My Votes') }}
                </a>
            @endif
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ url('/admin/parties') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->is('admin/parties*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    {{ __('Parties') }}
                </a>
                <a href="{{ url('/admin/votes') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->is('admin/votes*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    {{ __('Votes Management') }}
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if(auth()->check())
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            @endif
            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                    {{ __('Profile') }}
                </a>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav> 