<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'courier'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'courier', 'items.product', 'coupon']);
        $couriers = User::where('role', 'courier')->get();
        
        return view('admin.orders.show', compact('order', 'couriers'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . ucfirst($request->status));
    }

    /**
     * Assign a courier to the order.
     */
    public function assignCourier(Request $request, Order $order)
    {
        $request->validate([
            'courier_id' => 'required|exists:users,id',
        ]);

        $courier = User::findOrFail($request->courier_id);
        
        if ($courier->role !== 'courier') {
            return back()->with('error', 'User yang dipilih bukan merupakan kurir.');
        }

        $order->update([
            'courier_id' => $courier->id,
            'status' => 'shipped'
        ]);

        return back()->with('success', 'Kurir ' . $courier->name . ' berhasil ditugaskan dan status pesanan berubah menjadi Shipped.');
    }
}
