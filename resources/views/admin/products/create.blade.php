@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tambah Laptop Baru') }}
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
                        <x-input-label for="name" :value="__('Nama Laptop')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Spesifikasi & Deskripsi')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm" rows="6" required>{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <x-input-label for="images" :value="__('Galeri Foto Laptop (Bisa banyak)')" />
                        <input id="images" name="images[]" type="file" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
                        <p class="mt-1 text-xs text-gray-400 italic">Pilih satu atau beberapa foto. Foto pertama akan otomatis menjadi foto utama.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('images')" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Harga (Rp)')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', 0)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="border-t border-gray-150 pt-6">
                <h3 class="font-black text-xs text-slate-400 uppercase tracking-wider mb-4">Spesifikasi Laptop</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="brand" :value="__('Merek / Brand')" />
                        <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand')" placeholder="Contoh: ASUS, Apple, Lenovo" />
                        <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                    </div>

                    <div>
                        <x-input-label for="processor" :value="__('Processor')" />
                        <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full" :value="old('processor')" placeholder="Contoh: Intel Core i7-13700H" />
                        <x-input-error class="mt-2" :messages="$errors->get('processor')" />
                    </div>

                    <div>
                        <x-input-label for="graphic_card" :value="__('Kartu Grafis / GPU')" />
                        <x-text-input id="graphic_card" name="graphic_card" type="text" class="mt-1 block w-full" :value="old('graphic_card')" placeholder="Contoh: NVIDIA RTX 4060 (8GB)" />
                        <x-input-error class="mt-2" :messages="$errors->get('graphic_card')" />
                    </div>

                    <div>
                        <x-input-label for="ram" :value="__('RAM (GB)')" />
                        <x-text-input id="ram" name="ram" type="number" class="mt-1 block w-full" :value="old('ram')" placeholder="Contoh: 16" />
                        <x-input-error class="mt-2" :messages="$errors->get('ram')" />
                    </div>

                    <div>
                        <x-input-label for="storage" :value="__('Penyimpanan SSD (GB)')" />
                        <x-text-input id="storage" name="storage" type="number" class="mt-1 block w-full" :value="old('storage')" placeholder="Contoh: 512" />
                        <x-input-error class="mt-2" :messages="$errors->get('storage')" />
                    </div>

                    <div>
                        <x-input-label for="screen_size" :value="__('Ukuran Layar (Inci)')" />
                        <x-text-input id="screen_size" name="screen_size" type="number" step="0.1" class="mt-1 block w-full" :value="old('screen_size')" placeholder="Contoh: 14.0" />
                        <x-input-error class="mt-2" :messages="$errors->get('screen_size')" />
                    </div>

                    <div>
                        <x-input-label for="sold" :value="__('Jumlah Terjual')" />
                        <x-text-input id="sold" name="sold" type="number" class="mt-1 block w-full" :value="old('sold', 0)" />
                        <x-input-error class="mt-2" :messages="$errors->get('sold')" />
                    </div>
                </div>
            </div>

            <div>
                <label for="is_active" class="inline-flex items-center">
                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="ms-2 text-sm text-gray-600">{{ __('Tampilkan di Toko (Aktif)') }}</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t">
                <x-primary-button>{{ __('Simpan Laptop') }}</x-primary-button>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
