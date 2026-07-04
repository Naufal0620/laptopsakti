@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Laptop: ') . $product->name }}
    </h2>
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <!-- Main Form -->
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <x-input-label for="name" :value="__('Nama Laptop')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Spesifikasi & Deskripsi')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm" rows="6" required>{{ old('description', $product->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <x-input-label for="images" :value="__('Tambah Foto Galeri')" />
                        <input id="images" name="images[]" type="file" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
                        <x-input-error class="mt-2" :messages="$errors->get('images')" />
                        <x-input-error class="mt-2" :messages="$errors->get('images.*')" />
                        <p class="mt-1 text-xs text-gray-400 italic">Anda bisa mengunggah banyak foto sekaligus.</p>
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Harga (Rp)')" />
                        <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $product->price)" required />
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
                        <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full" :value="old('brand', $product->brand)" placeholder="Contoh: ASUS, Apple, Lenovo" />
                        <x-input-error class="mt-2" :messages="$errors->get('brand')" />
                    </div>

                    <div>
                        <x-input-label for="processor" :value="__('Processor')" />
                        <x-text-input id="processor" name="processor" type="text" class="mt-1 block w-full" :value="old('processor', $product->processor)" placeholder="Contoh: Intel Core i7-13700H" />
                        <x-input-error class="mt-2" :messages="$errors->get('processor')" />
                    </div>

                    <div>
                        <x-input-label for="graphic_card" :value="__('Kartu Grafis / GPU')" />
                        <x-text-input id="graphic_card" name="graphic_card" type="text" class="mt-1 block w-full" :value="old('graphic_card', $product->graphic_card)" placeholder="Contoh: NVIDIA RTX 4060 (8GB)" />
                        <x-input-error class="mt-2" :messages="$errors->get('graphic_card')" />
                    </div>

                    <div>
                        <x-input-label for="ram" :value="__('RAM (GB)')" />
                        <x-text-input id="ram" name="ram" type="number" class="mt-1 block w-full" :value="old('ram', $product->ram)" placeholder="Contoh: 16" />
                        <x-input-error class="mt-2" :messages="$errors->get('ram')" />
                    </div>

                    <div>
                        <x-input-label for="storage" :value="__('Penyimpanan SSD (GB)')" />
                        <x-text-input id="storage" name="storage" type="number" class="mt-1 block w-full" :value="old('storage', $product->storage)" placeholder="Contoh: 512" />
                        <x-input-error class="mt-2" :messages="$errors->get('storage')" />
                    </div>

                    <div>
                        <x-input-label for="screen_size" :value="__('Ukuran Layar (Inci)')" />
                        <x-text-input id="screen_size" name="screen_size" type="number" step="0.1" class="mt-1 block w-full" :value="old('screen_size', $product->screen_size)" placeholder="Contoh: 14.0" />
                        <x-input-error class="mt-2" :messages="$errors->get('screen_size')" />
                    </div>

                    <div>
                        <x-input-label for="sold" :value="__('Jumlah Terjual')" />
                        <x-text-input id="sold" name="sold" type="number" class="mt-1 block w-full" :value="old('sold', $product->sold)" />
                        <x-input-error class="mt-2" :messages="$errors->get('sold')" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t">
                <label for="is_active" class="inline-flex items-center">
                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <span class="ms-2 text-sm text-gray-600 font-bold uppercase">{{ __('Status Aktif') }}</span>
                </label>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                    <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Gallery Management -->
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6 border-b bg-gray-50">
            <h3 class="font-bold text-gray-700">Kelola Galeri Foto</h3>
            <p class="text-xs text-gray-500">Klik bintang untuk menjadikan foto utama, atau hapus untuk membuang foto.</p>
        </div>
        <div class="p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($product->images as $image)
                <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                    
                    @if($image->is_primary)
                        <div class="absolute top-0 right-0 p-1 bg-yellow-400 text-white text-[10px] font-bold px-2 rounded-bl-lg">UTAMA</div>
                    @endif

                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition gap-2">
                        @if(!$image->is_primary)
                            <form action="{{ route('admin.products.images.primary', $image) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-1 bg-yellow-500 text-white rounded hover:bg-yellow-600" title="Jadikan Utama">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.products.images.destroy', $image) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 bg-red-600 text-white rounded hover:bg-red-700" title="Hapus Foto" onclick="return confirm('Hapus foto ini?')">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-4 text-center text-sm text-gray-500 italic">Belum ada foto galeri.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
