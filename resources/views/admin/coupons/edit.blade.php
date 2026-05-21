@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Kupon: ') . $coupon->code }}
    </h2>
@endsection

@section('content')
<div class="max-w-2xl bg-white shadow-sm sm:rounded-lg p-8">
    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Kode Kupon</label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tipe Diskon</label>
                <select name="type" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                    <option value="fixed" {{ $coupon->type === 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                    <option value="percentage" {{ $coupon->type === 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nilai Diskon</label>
                <input type="number" name="value" value="{{ old('value', $coupon->value) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Maksimal Diskon (Rp)</label>
                <input type="number" name="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Minimal Belanja (Rp)</label>
                <input type="number" name="min_order" value="{{ old('min_order', $coupon->min_order) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ old('start_date', $coupon->start_date ? $coupon->start_date->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal Berakhir</label>
                <input type="date" name="end_date" value="{{ old('end_date', $coupon->end_date ? $coupon->end_date->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Limit Penggunaan Total</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Limit Per User</label>
                <input type="number" name="limit_per_user" value="{{ old('limit_per_user', $coupon->limit_per_user) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div class="md:col-span-2 flex items-center space-x-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $coupon->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                <label for="is_active" class="text-sm font-bold text-gray-700 uppercase tracking-wider">Kupon Aktif</label>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.coupons.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 uppercase text-xs font-bold tracking-widest">Batal</a>
            <button type="submit" class="px-6 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 shadow-md uppercase text-xs font-bold tracking-widest">Update Kupon</button>
        </div>
    </form>
</div>
@endsection
