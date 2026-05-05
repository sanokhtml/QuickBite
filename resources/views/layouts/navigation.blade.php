<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
            <a href="/" class="flex items-center">
                <div class="shrink-0 flex items-center gap-3">
                    <x-application-logo class="block h-10 w-auto" />

                    <span class="text-3xl font-black tracking-tighter text-[#5F55F8] leading-none mt-1.5">
                        QuickBite
                    </span>
                </div>
            </a>

            </div>
                <div class="flex justify-center items-center gap-2">
                    @can('admin')
                        @if(auth()->user()->email === 'admin@quickbite.com')           
                            <a href="{{ route('restaurant.create') }}" class="hidden sm:flex items-center">
                                <x-primary-button>
                                    Create Restaurant
                                </x-primary-button>
                            </a>

                            <a href="{{ route('product.create') }}" class="hidden sm:flex items-center">
                                <x-primary-button>
                                    Create Product
                                </x-primary-button>
                            </a>
                        @endif
                    @endcan

                @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
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

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('register') }}"
                        class="hidden sm:flex items-center px-3 py-2 border border-transparent text-sm leading-4 
                        rounded-lg active font-medium rounded-md text-white bg-[#5F55F8] hover:bg-[#7A72F9] text-white transition duration-150
                        hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        Create an Account
                    </a>

                    <a href="{{ route('login') }}"
                        class="hidden sm:flex items-center px-3 py-2 border border-transparent text-sm leading-4
                        bg-[#5F55F8] hover:bg-[#7A72F9] text-white transition duration-150 rounded-lg active
                        font-medium rounded-md text-white hover:text-gray-700 focus:outline-none transition
                        ease-in-out duration-150">
                        Log in
                    </a>
                @endguest

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                @can('admin')
                @if(auth()->user()->email === 'admin@quickbite.com')
                    <div class="mt-3 px-4 space-y-2">
                        <a href="{{ route('restaurant.create') }}" class="w-full flex justify-center text-center py-2 bg-[#5F55F8] hover:bg-[#7A72F9] text-white font-bold rounded-lg transition duration-150">
                            Create Restaurant
                        </a>
                        <a href="{{ route('product.create') }}" class="w-full flex justify-center text-center py-2 bg-[#5F55F8] hover:bg-[#7A72F9] text-white font-bold rounded-lg transition duration-150">
                            Create Product
                        </a>
                    </div>
                @endif
            @endcan

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>


                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
            @endauth
            @guest
            <div class="pt-2 pb-3 space-y-1 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('register')" class="text-[#5F55F8] font-bold">
                    {{ __('Create an Account') }}
                </x-responsive-nav-link>
            </div>
        @endguest
        </div>
</nav>