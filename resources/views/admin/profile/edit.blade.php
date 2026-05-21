@extends('layouts.admin')

@section('header')
    {{ __('Profil Administrator') }}
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Profile Info -->
    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm relative overflow-hidden group">
        <div class="max-w-xl relative z-10">
            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6">Informasi Profil Admin</h3>
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
    </div>

    <!-- Password -->
    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm relative overflow-hidden group">
        <div class="max-w-xl relative z-10">
            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6">Keamanan Kata Sandi</h3>
            @include('profile.partials.update-password-form')
        </div>
        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-gray-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
    </div>

    <!-- Delete -->
    <div class="bg-red-50/30 rounded-3xl p-8 border border-red-100 shadow-sm">
        <div class="max-w-xl">
            <h3 class="text-sm font-black text-red-900 uppercase tracking-widest mb-6">Hapus Akun Administrator</h3>
            <p class="text-xs text-gray-500 mb-6 font-medium uppercase tracking-wider">Tindakan ini permanen dan tidak dapat dibatalkan.</p>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
