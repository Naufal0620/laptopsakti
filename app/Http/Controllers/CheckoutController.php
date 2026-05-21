<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $shipping_cost_per_km = Setting::getValue('shipping_cost_per_km', 2000);
        $store_lat = Setting::getValue('store_latitude', -6.2088);
        $store_lng = Setting::getValue('store_longitude', 106.8456);
        
        return view('checkout.index', compact('cart', 'shipping_cost_per_km', 'store_lat', 'store_lng'));
    }

    /**
     * Apply coupon and return discount info.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'subtotal' => 'required|numeric',
        ]);

        $coupon = Coupon::where('code', $request->code)->where('is_active', true)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Kode kupon tidak valid atau sudah tidak aktif.'
            ], 422);
        }

        if (!$coupon->isValid($request->subtotal)) {
            // Detailed error messages based on validation failure
            $message = 'Kupon tidak dapat digunakan.';
            
            if ($coupon->start_date && $coupon->start_date->isFuture()) {
                $message = 'Kupon baru dapat digunakan mulai tanggal ' . $coupon->start_date->format('d M Y');
            } elseif ($coupon->end_date && $coupon->end_date->isPast()) {
                $message = 'Kupon sudah kadaluwarsa.';
            } elseif ($coupon->min_order > $request->subtotal) {
                $message = 'Minimal belanja untuk menggunakan kupon ini adalah Rp ' . number_format($coupon->min_order, 0, ',', '.');
            } elseif ($coupon->usage_limit !== null && $coupon->orders()->count() >= $coupon->usage_limit) {
                $message = 'Kuota penggunaan kupon ini sudah habis.';
            } elseif ($coupon->limit_per_user !== null) {
                $userUsage = $coupon->orders()->where('user_id', auth()->id())->count();
                if ($userUsage >= $coupon->limit_per_user) {
                    $message = 'Anda sudah mencapai batas penggunaan kupon ini.';
                }
            }

            return response()->json([
                'success' => false,
                'message' => $message
            ], 422);
        }

        $discount = $coupon->calculateDiscount($request->subtotal);

        return response()->json([
            'success' => true,
            'code' => $coupon->code,
            'discount_amount' => $discount,
            'message' => 'Kupon berhasil diterapkan!'
        ]);
    }

    /**
     * Process the checkout and redirect to WhatsApp.
     */
    public function process(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'delivery_lat' => 'required|numeric',
            'delivery_lng' => 'required|numeric',
            'coupon_code' => 'nullable|string|exists:coupons,code',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Calculate distance on server side for security
        $store_lat = Setting::getValue('store_latitude', -6.2088);
        $store_lng = Setting::getValue('store_longitude', 106.8456);
        $distance_km = $this->calculateDistance($store_lat, $store_lng, $request->delivery_lat, $request->delivery_lng);

        return DB::transaction(function () use ($request, $cart, $distance_km) {
            $total_price = 0;
            $max_pre_order_days = 0;
            foreach ($cart as $item) {
                $total_price += $item['price'] * $item['quantity'];
                if ($item['pre_order_days'] > $max_pre_order_days) {
                    $max_pre_order_days = $item['pre_order_days'];
                }
            }

            $shipping_cost_per_km = Setting::getValue('shipping_cost_per_km', 2000);
            $shipping_cost = $distance_km * $shipping_cost_per_km;
            
            // Coupon logic
            $discount_amount = 0;
            $coupon_id = null;
            if ($request->coupon_code) {
                $coupon = Coupon::where('code', $request->coupon_code)->where('is_active', true)->first();
                if ($coupon && $coupon->isValid($total_price)) {
                    $discount_amount = $coupon->calculateDiscount($total_price);
                    $coupon_id = $coupon->id;
                } else {
                    // If coupon was provided but is now invalid, we could either fail or ignore.
                    // Let's redirect back with error if the user specifically wanted to use a coupon but it's invalid.
                    return redirect()->back()->withInput()->with('error', 'Kupon yang Anda gunakan sudah tidak valid. Silakan periksa kembali.');
                }
            }

            $grand_total = ($total_price + $shipping_cost) - $discount_amount;

            $order = Order::create([
                'user_id' => auth()->id(),
                'coupon_id' => $coupon_id,
                'delivery_address' => $request->delivery_address,
                'delivery_lat' => $request->delivery_lat,
                'delivery_lng' => $request->delivery_lng,
                'distance_km' => $distance_km,
                'total_price' => $total_price,
                'shipping_cost' => $shipping_cost,
                'discount_amount' => $discount_amount,
                'grand_total' => $grand_total,
                'status' => 'pending',
                'expected_ready_date' => now()->addDays($max_pre_order_days),
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price_at_time' => $item['price'],
                ]);
            }

            // Clear Cart
            session()->forget('cart');

            // WhatsApp Redirect
            return $this->redirectToWhatsApp($order);
        });
    }

    /**
     * Calculate distance between two points using Haversine formula.
     */
    protected function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Radius of the earth in km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return round($distance, 2);
    }

    /**
     * Generate WhatsApp Redirect URL.
     */
    protected function redirectToWhatsApp(Order $order)
    {
        $admin_phone = Setting::getValue('admin_whatsapp_number', '628123456789');
        $items_text = "";
        foreach ($order->items as $item) {
            $items_text .= "   - {$item->quantity}x {$item->product->name} (Rp " . number_format($item->price_at_time, 0, ',', '.') . ")\n";
        }

        $message = "Halo Admin Kulivio! Saya ingin mengonfirmasi pembayaran untuk pesanan berikut:\n\n" .
                   "🆔 ID Pesanan: #ORD-{$order->id}\n" .
                   "👤 Nama: " . auth()->user()->name . "\n" .
                   "🛍️ Detail Item:\n{$items_text}" .
                   "💰 Total Tagihan: Rp " . number_format($order->grand_total, 0, ',', '.') . "\n" .
                   "🚚 Alamat Kirim: {$order->delivery_address}\n\n" .
                   "Saya akan segera mengirimkan bukti transfernya. Terima kasih!";

        $url = "https://wa.me/{$admin_phone}?text=" . urlencode($message);

        return redirect()->away($url);
    }
}
