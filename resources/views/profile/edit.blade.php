<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight tracking-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Profile Info -->
            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="max-w-xl relative z-10">
                    <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight mb-6">Informasi Profil</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
            </div>

            <!-- Password -->
            <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="max-w-xl relative z-10">
                    <h3 class="text-lg font-black text-gray-900 uppercase tracking-tight mb-6">Keamanan Kata Sandi</h3>
                    @include('profile.partials.update-password-form')
                </div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-gray-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
            </div>

            <!-- Delete -->
            <div class="bg-red-50/30 rounded-[2rem] p-8 border border-red-100 shadow-sm">
                <div class="max-w-xl">
                    <h3 class="text-lg font-black text-red-900 uppercase tracking-tight mb-6">Hapus Akun</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
