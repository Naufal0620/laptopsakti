@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Unggah Video Feed') }}
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
        <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div>
                <x-input-label for="product_id" :value="__('Pilih Produk')" />
                <select id="product_id" name="product_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">-- Pilih Produk Kuliner --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="video" :value="__('File Video (MP4, Max 20MB)')" />
                    <input id="video" name="video" type="file" accept="video/mp4" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required />
                    <p class="mt-1 text-xs text-gray-400 italic">Rasio disarankan: 9:16 (Portrait)</p>
                    <x-input-error class="mt-2" :messages="$errors->get('video')" />
                </div>

                <div>
                    <x-input-label for="thumbnail" :value="__('Thumbnail / Sampul (Opsional)')" />
                    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Mulai Unggah') }}</x-primary-button>
                <a href="{{ route('admin.videos.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
