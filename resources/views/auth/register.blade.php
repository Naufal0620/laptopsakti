<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm font-medium text-gray-400 mt-1">Bergabunglah untuk memesan hidangan terbaik.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="name" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="email" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Nomor WhatsApp')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="phone" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all" type="text" name="phone" :value="old('phone')" required placeholder="08123456789" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="password" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="password_confirmation" class="block w-full bg-gray-50 border-gray-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button class="w-full py-4 bg-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-xl shadow-primary-100 flex items-center justify-center">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-gray-50">
            <p class="text-xs font-bold text-gray-400">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary-600 hover:underline">Masuk Di Sini</a></p>
        </div>
    </form>
</x-guest-layout>

