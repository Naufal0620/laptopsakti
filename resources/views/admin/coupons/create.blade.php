@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Kupon Baru') }}
    </h2>
@endsection

@section('content')
<div class="max-w-2xl bg-white shadow-sm sm:rounded-lg p-8">
    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Kode Kupon</label>
                <input type="text" name="code" value="{{ old('code') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="CONTOH: PROMOHEBATT" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tipe Diskon</label>
                <select name="type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                    <option value="fixed">Nominal Tetap (Rp)</option>
                    <option value="percentage">Persentase (%)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nilai Diskon</label>
                <input type="number" name="value" value="{{ old('value') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Maksimal Diskon (Rp)</label>
                <input type="number" name="max_discount" value="{{ old('max_discount') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="Kosongkan jika tidak ada batas">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Minimal Belanja (Rp)</label>
                <input type="number" name="min_order" value="{{ old('min_order') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="0">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Berakhir</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Limit Penggunaan Total</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" placeholder="∞">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Limit Per User</label>
                <input type="number" name="limit_per_user" value="{{ old('limit_per_user', 1) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div class="md:col-span-2 flex items-center space-x-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                <label for="is_active" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Kupon Aktif</label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.coupons.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 uppercase text-xs font-bold tracking-widest">Batal</a>
            <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 shadow-md uppercase text-xs font-bold tracking-widest">Simpan Kupon</button>
        </div>
    </form>
</div>
@endsection
