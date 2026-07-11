<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-xl border-b border-slate-100 sticky top-0 z-50 py-1 transition-all">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left Section: Logo & Brand -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <x-application-logo class="w-9 h-9 text-primary-600" />
                    <span class="font-black text-xl tracking-tighter text-slate-900">{{ config('app.name') }}</span>
                </a>
            </div>

            <!-- Center Section: Navigation Links -->
            <div class="hidden md:flex items-center space-x-8 text-xs font-bold uppercase tracking-widest text-slate-500">
                <a href="{{ route('products.index') }}" class="hover:text-primary-600 transition {{ request()->routeIs('products.index') ? 'text-primary-600' : '' }}">Katalog</a>
                <a href="{{ route('explore') }}" class="hover:text-primary-600 transition {{ request()->routeIs('explore') ? 'text-primary-600' : '' }}">Explore Video</a>
                <a href="{{ route('about') }}" class="hover:text-primary-600 transition {{ request()->routeIs('about') ? 'text-primary-600' : '' }}">Tentang Kami</a>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600 transition {{ request()->routeIs('admin.*') ? 'text-primary-600' : '' }}">Admin Panel</a>
                    @endif
                @endauth
            </div>

            <!-- Right Section: Action / User Menu -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3.5 py-2 border border-slate-200 text-xs font-bold uppercase tracking-wider rounded-lg text-slate-700 bg-white hover:text-primary-600 hover:border-primary-200 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1.5">
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
                @endauth
                <a href="{{ route('products.index') }}" class="bg-primary-600 text-white px-5 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider hover:bg-primary-700 transition shadow-md shadow-primary-100">
                    Mulai Belanja
                </a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-500 hover:bg-slate-50 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Drawer Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-slate-100 bg-white shadow-lg transition-all duration-300">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('products.index') }}" class="block px-4 py-2.5 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 hover:text-primary-600 {{ request()->routeIs('products.index') ? 'text-primary-600 bg-slate-50' : '' }}">Katalog</a>
            <a href="{{ route('explore') }}" class="block px-4 py-2.5 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 hover:text-primary-600 {{ request()->routeIs('explore') ? 'text-primary-600 bg-slate-50' : '' }}">Explore Video</a>
            <a href="{{ route('about') }}" class="block px-4 py-2.5 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 hover:text-primary-600 {{ request()->routeIs('about') ? 'text-primary-600 bg-slate-50' : '' }}">Tentang Kami</a>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 hover:text-primary-600 {{ request()->routeIs('admin.*') ? 'text-primary-600 bg-slate-50' : '' }}">Admin Panel</a>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-4 border-t border-slate-150 bg-slate-50">
            @auth
                <div class="px-4 mb-3">
                    <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-400">{{ Auth::user()->email }}</div>
                </div>
                <div class="space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50">Log Out</button>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('products.index') }}" class="block w-full text-center py-2.5 bg-primary-600 hover:bg-primary-700 rounded-lg text-sm font-bold uppercase tracking-wider text-white shadow-md shadow-primary-50">Mulai Belanja</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
