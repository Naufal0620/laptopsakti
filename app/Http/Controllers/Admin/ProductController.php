<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('primaryImage')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $productData = $request->except('images');
        $productData['is_active'] = $request->has('is_active');
        
        $product = Product::create($productData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs("products/{$product->id}", $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk dan galeri foto berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        \Log::info('Update Product Request', [
            'id' => $product->id,
            'has_files' => $request->hasFile('images'),
            'files_count' => count($request->file('images') ?? []),
            'all_files' => array_keys($request->allFiles()),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        \Log::info('Validation Passed', ['id' => $product->id]);

        $productData = $request->except('images');
        $productData['is_active'] = $request->has('is_active');

        $product->update($productData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs("products/{$product->id}", $filename, 'public');

                // If no primary image exists, make this the primary
                $hasPrimary = ProductImage::where('product_id', $product->id)->where('is_primary', true)->exists();

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => !$hasPrimary,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Delete all associated images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $product->delete();
        return back()->with('success', 'Produk dan semua foto terkait berhasil dihapus.');
    }

    public function deleteImage(ProductImage $image)
    {
        $productId = $image->product_id;
        Storage::disk('public')->delete($image->image_path);
        
        $isPrimary = $image->is_primary;
        $image->delete();

        // If we deleted the primary image, set another one as primary if available
        if ($isPrimary) {
            $nextImage = ProductImage::where('product_id', $productId)->first();
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function setPrimaryImage(ProductImage $image)
    {
        ProductImage::where('product_id', $image->product_id)->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Foto utama berhasil diubah.');
    }
}
