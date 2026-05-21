<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('product')->latest()->paginate(12);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.videos.create', compact('products'));
    }

    public function show(Video $video)
    {
        $video->load('product');
        return view('admin.videos.show', compact('video'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'video' => 'required|file|mimetypes:video/mp4|max:20480', // 20MB
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // 2MB
        ]);

        $product = Product::findOrFail($request->product_id);

        // Upload Video
        $videoFile = $request->file('video');
        $videoFilename = Str::random(20) . '.' . $videoFile->getClientOriginalExtension();
        $videoPath = $videoFile->storeAs("videos/{$product->id}", $videoFilename, 'public');

        // Upload Thumbnail
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbFilename = Str::random(20) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs("thumbnails/{$product->id}", $thumbFilename, 'public');
        }

        Video::create([
            'product_id' => $product->id,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'status' => 'ready',
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video feed berhasil diunggah.');
    }

    public function edit(Video $video)
    {
        $products = Product::where('is_active', true)->get();
        return view('admin.videos.edit', compact('video', 'products'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:ready,processing,failed',
        ]);

        $data = [
            'product_id' => $request->product_id,
            'status' => $request->status,
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }

            $thumbnailFile = $request->file('thumbnail');
            $thumbFilename = Str::random(20) . '.' . $thumbnailFile->getClientOriginalExtension();
            $data['thumbnail_path'] = $thumbnailFile->storeAs("thumbnails/{$request->product_id}", $thumbFilename, 'public');
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')->with('success', 'Informasi video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
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
