@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Preview Video: ') . $video->product->name }}
    </h2>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6">
            <div class="relative aspect-[9/16] bg-black rounded-lg overflow-hidden shadow-lg">
                <video class="w-full h-full" controls autoplay muted loop>
                    <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            
            <div class="mt-6 space-y-4">
                <div class="flex justify-between items-center border-b pb-4">
                    <span class="text-gray-500 text-sm uppercase font-bold tracking-wider">Produk</span>
                    <span class="font-bold text-gray-900">{{ $video->product->name }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-4">
                    <span class="text-gray-500 text-sm uppercase font-bold tracking-wider">Status</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded uppercase">
                        {{ $video->status }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm uppercase font-bold tracking-wider">Diunggah Pada</span>
                    <span class="text-gray-900 text-sm">{{ $video->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <a href="{{ route('admin.videos.edit', $video) }}" class="flex-1 text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    Edit Video / Thumbnail
                </a>
                <a href="{{ route('admin.videos.index') }}" class="flex-1 text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
