<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    /**
     * Store a newly created video in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'video' => 'required|file|mimetypes:video/mp4|max:20480', // Max 20MB
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $videoFile = $request->file('video');
        $filename = Str::random(20) . '.' . $videoFile->getClientOriginalExtension();
        
        // Store video: storage/app/public/videos/{product_id}/{filename}
        $videoPath = $videoFile->storeAs(
            "videos/{$product->id}", 
            $filename, 
            'public'
        );

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbFilename = Str::random(20) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs(
                "thumbnails/{$product->id}", 
                $thumbFilename, 
                'public'
            );
        }

        $video = $product->videos()->create([
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'status' => 'ready',
        ]);

        return back()->with('success', 'Video berhasil diunggah.');
    }

    /**
     * Remove the specified video from storage.
     */
    public function destroy(Video $video)
    {
        // Delete files from storage
        if (Storage::disk('public')->exists($video->video_path)) {
            Storage::disk('public')->delete($video->video_path);
        }

        if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        $video->delete();

        return back()->with('success', 'Video berhasil dihapus.');
    }
}
