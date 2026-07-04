<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the top 8 best-selling products on the home page.
     */
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with(['primaryImage', 'videos'])
            ->orderBy('sold', 'desc')
            ->take(8)
            ->get();

        return view('welcome', compact('products'));
    }

    /**
     * Display a listing of all products with sidebar filtering.
     */
    public function catalog(Request $request)
    {
        $query = Product::where('is_active', true)->with(['primaryImage', 'videos']);

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('processor', 'like', '%' . $request->search . '%')
                  ->orWhere('graphic_card', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Brands Filter
        if ($request->filled('brands') && is_array($request->brands)) {
            $query->whereIn('brand', $request->brands);
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // RAM Filter
        if ($request->filled('min_ram')) {
            $query->where('ram', '>=', $request->min_ram);
        }
        if ($request->filled('max_ram')) {
            $query->where('ram', '<=', $request->max_ram);
        }

        // Storage Filter
        if ($request->filled('min_storage')) {
            $query->where('storage', '>=', $request->min_storage);
        }
        if ($request->filled('max_storage')) {
            $query->where('storage', '<=', $request->max_storage);
        }

        $products = $query->latest()->paginate(9)->withQueryString();

        // Metadata for Filters
        $availableBrands = Product::where('is_active', true)
            ->whereNotNull('brand')
            ->orderBy('brand')
            ->distinct()
            ->pluck('brand');

        $minPriceBound = Product::where('is_active', true)->min('price') ?? 0;
        $maxPriceBound = Product::where('is_active', true)->max('price') ?? 50000000;

        return view('products.index', compact(
            'products', 
            'availableBrands', 
            'minPriceBound', 
            'maxPriceBound'
        ));
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }
}
