@extends('layouts.admin')

@section('header')
    {{ __('Manajemen Video Feed') }}
@endsection

@section('content')
<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-100 p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($videos as $video)
            <div class="border rounded-lg overflow-hidden flex flex-col bg-gray-50 border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="relative aspect-[9/16] bg-black flex items-center justify-center group">
                    @if($video->thumbnail_path)
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="w-full h-full object-cover">
                    @else
                        <div class="text-white text-xs">No Thumbnail</div>
                    @endif
                    
                    <!-- Overlay with Show/Edit buttons -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black bg-opacity-60 space-y-2">
                        <a href="{{ route('admin.videos.show', $video) }}" class="p-2 bg-white rounded-full text-gray-900 hover:bg-gray-200 shadow-lg" title="Preview Video">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('admin.videos.edit', $video) }}" class="p-2 bg-white rounded-full text-primary-600 hover:bg-gray-200 shadow-lg" title="Edit Metadata">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <div class="font-bold text-sm truncate text-gray-900">{{ $video->product->name }}</div>
                    <div class="text-xs text-gray-500 mt-1 uppercase font-semibold">Status: <span class="text-green-600">{{ $video->status }}</span></div>
                </div>
                <div class="p-4 border-t bg-white border-gray-100">
                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-center text-red-600 hover:text-red-900 text-xs font-bold uppercase tracking-widest" onclick="return confirm('Hapus video ini? File video juga akan terhapus dari server.')">
                            Hapus Video
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada video yang diunggah.
            </div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $videos->links() }}
    </div>
</div>
@endsection

@section('floating_button')
    <a href="{{ route('admin.videos.create') }}" class="fixed bottom-8 right-8 w-14 h-14 bg-primary-600 text-white rounded-full flex items-center justify-center shadow-2xl hover:bg-primary-700 hover:scale-110 transition-all duration-300 z-50 group" title="Unggah Video Baru">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
        </svg>
    </a>
@endsection
