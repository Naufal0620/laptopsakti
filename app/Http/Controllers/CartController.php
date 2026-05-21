<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart items.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        // Logic to determine the product image for the cart
        $productImage = 'https://via.placeholder.com/150?text=Produk';
        
        if ($product->primaryImage) {
            $productImage = $product->primaryImage->image_path;
        } elseif ($product->images->first()) {
            $productImage = $product->images->first()->image_path;
        } elseif ($product->videos->first() && $product->videos->first()->thumbnail_path) {
            $productImage = $product->videos->first()->thumbnail_path;
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->discounted_price,
                "image" => $productImage,
                "pre_order_days" => $product->pre_order_days
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cartCount' => collect($cart)->sum('quantity')
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update the cart item quantity.
     */
    public function update(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Product $product)
    {
        if ($product->id) {
            $cart = session()->get('cart');
            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }
    }
}
