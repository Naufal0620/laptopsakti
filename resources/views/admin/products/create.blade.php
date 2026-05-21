@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Produk Baru') }}
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <x-input-label for="name" :value="__('Nama Produk')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Produk')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <x-input-label for="images" :value="__('Galeri Foto Produk (Bisa banyak)')" />
                        <input id="images" name="images[]" type="file" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
                        <p class="mt-1 text-xs text-gray-400 italic">Pilih satu atau beberapa foto. Foto pertama akan otomatis menjadi foto utama.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('images')" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="price" :value="__('Harga Dasar (Rp)')" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', 0)" required />
                        </div>
                        <div>
                            <x-input-label for="pre_order_days" :value="__('Estimasi PO (Hari)')" />
                            <x-text-input id="pre_order_days" name="pre_order_days" type="number" class="mt-1 block w-full" :value="old('pre_order_days', 1)" required />
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t">
                <div>
                    <x-input-label for="discount_type" :value="__('Tipe Diskon')" />
                    <select id="discount_type" name="discount_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="none" {{ old('discount_type') == 'none' ? 'selected' : '' }}>Tanpa Diskon</option>
                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Potongan Harga (Rp)</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="discount_value" :value="__('Nilai Diskon')" />
                    <x-text-input id="discount_value" name="discount_value" type="number" class="mt-1 block w-full" :value="old('discount_value', 0)" />
                </div>
            </div>

            <div>
                <label for="is_active" class="inline-flex items-center">
                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Tampilkan di Toko (Aktif)') }}</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t">
                <x-primary-button>{{ __('Simpan Produk') }}</x-primary-button>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
