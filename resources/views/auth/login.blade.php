<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Admin Login</h2>
        <p class="text-sm font-medium text-gray-400 mt-1">Masuk untuk mengelola katalog laptop, video, dan settings.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="email" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-[10px] font-black uppercase tracking-widest text-gray-400" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black uppercase tracking-widest text-primary-600 hover:text-primary-700 transition" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-200 text-primary-600 shadow-sm focus:ring-primary-500 transition-all" name="remember">
                <span class="ms-2 text-xs font-bold text-gray-500 group-hover:text-gray-700 transition-colors">{{ __('Ingat saya di perangkat ini') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button class="w-full py-4 bg-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-xl shadow-primary-100 flex items-center justify-center">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>


    </form>
</x-guest-layout>
