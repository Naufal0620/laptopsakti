@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Metadata Video') }}
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
        <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="product_id" :value="__('Produk Terkait')" />
                <select id="product_id" name="product_id" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id', $video->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status Penayangan')" />
                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm" required>
                    <option value="ready" {{ old('status', $video->status) == 'ready' ? 'selected' : '' }}>Ready (Ditampilkan)</option>
                    <option value="processing" {{ old('status', $video->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="failed" {{ old('status', $video->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div>
                    <x-input-label :value="__('Video Saat Ini')" />
                    <div class="mt-2 relative aspect-[9/16] bg-black rounded-lg overflow-hidden">
                        <video class="w-full h-full" muted loop autoplay>
                            <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                        </video>
                    </div>
                    <p class="mt-2 text-xs text-gray-500 italic">* Untuk mengganti file video, silakan hapus dan unggah baru.</p>
                </div>

                <div>
                    <x-input-label for="thumbnail" :value="__('Update Thumbnail / Sampul')" />
                    @if($video->thumbnail_path)
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="mt-2 w-32 h-48 object-cover rounded-lg shadow">
                    @endif
                    <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" />
                    <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t">
                <x-primary-button>{{ __('Perbarui Informasi') }}</x-primary-button>
                <a href="{{ route('admin.videos.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
