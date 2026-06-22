@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah User Baru') }}
    </h2>
@endsection

@section('content')
<div class="max-w-2xl bg-white shadow-sm sm:rounded-lg p-8">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Contoh: 08123456789" required>
            </div>



            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 uppercase text-xs font-bold tracking-widest">Batal</a>
            <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 shadow-md uppercase text-xs font-bold tracking-widest">Simpan User</button>
        </div>
    </form>
</div>
@endsection
