<nav x-data="{ open: false }" class="bg-gradient-to-r from-nature-700 to-nature-600 border-b border-nature-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <span class="text-xl font-bold text-white">LearnSpace</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->role === 'student')
                        <a href="{{ route('student.courses.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('student.courses.index') ? 'border-white' : 'border-transparent' }} text-sm font-medium leading-5 text-white hover:text-nature-200 focus:outline-none transition duration-150 ease-in-out">
                            Browse Courses
                        </a>
                        <a href="{{ route('student.bookmarks') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('student.bookmarks') ? 'border-white' : 'border-transparent' }} text-sm font-medium leading-5 text-white hover:text-nature-200 focus:outline-none transition duration-150 ease-in-out">
                            My Bookmarks
                        </a>
                        <a href="{{ route('student.completions') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('student.completions') ? 'border-white' : 'border-transparent' }} text-sm font-medium leading-5 text-white hover:text-nature-200 focus:outline-none transition duration-150 ease-in-out">
                            Completed Courses
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-white' : 'border-transparent' }} text-sm font-medium leading-5 text-white hover:text-nature-200 focus:outline-none transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-nature-600 hover:bg-nature-500 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-nature-500 focus:outline-none transition duration-150 ease-in-out">
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
            @if(Auth::user()->role === 'student')
                <a href="{{ route('student.courses.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('student.courses.index') ? 'border-white bg-nature-800' : 'border-transparent' }} text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                    Browse Courses
                </a>
                <a href="{{ route('student.bookmarks') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('student.bookmarks') ? 'border-white bg-nature-800' : 'border-transparent' }} text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                    My Bookmarks
                </a>
                <a href="{{ route('student.completions') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('student.completions') ? 'border-white bg-nature-800' : 'border-transparent' }} text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                    Completed Courses
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-white bg-nature-800' : 'border-transparent' }} text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                    Dashboard
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-nature-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-nature-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                    Profile
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:bg-nature-700 focus:outline-none transition duration-150 ease-in-out">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
