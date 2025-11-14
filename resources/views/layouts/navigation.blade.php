<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-4">
                <!-- Logo + Nama Sistem -->
                <a href="{{ Auth::check() ? (Auth::user()->jenisUser === 'admin' ? route('admin.dashboard') : route('user.dashboard')) : route('landing') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo_satgas.png') }}" alt="Logo Satgas" class="h-10 w-10">
                    <span class="text-xl font-bold text-gray-800">SIPRAK</span>
                </a>

                <!-- Dashboard Link (❌ Tidak tampil di halaman publik) -->
                @auth
                    @if (!Request::is('/') && !Request::is('berita/*'))
                        <x-nav-link 
                            :href="Auth::user()->jenisUser === 'admin' ? route('admin.dashboard') : route('user.dashboard')" 
                            :active="request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')" 
                            class="flex items-center space-x-1">
                            
                            <!-- Icon Rumah -->
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5l9-7 9 7V20a1 1 0 01-1 1h-5a1 1 0 01-1-1v-5H9v5a1 1 0 01-1 1H3a1 1 0 01-1-1V9.5z"/>
                            </svg>
                            <span>Dashboard</span>
                        </x-nav-link>
                    @endif
                @endauth
            </div>

            <!-- User Settings / Login (❌ Tidak tampil di halaman publik) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    @if (!Request::is('/') && !Request::is('berita/*'))
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                                    <div>{{ Auth::user()->nama }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endif
                @else
                    @if (!Request::is('/') && !Request::is('berita/*'))
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium mx-3">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Register</a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
