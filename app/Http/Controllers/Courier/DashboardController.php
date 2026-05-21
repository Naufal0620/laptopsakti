<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the courier dashboard.
     */
    public function index()
    {
        $assigned_orders = Order::with(['user', 'items.product'])
            ->where('courier_id', auth()->id())
            ->whereIn('status', ['shipped', 'completed'])
            ->latest()
            ->paginate(10);

        $stats = [
            'pending_delivery' => Order::where('courier_id', auth()->id())->where('status', 'shipped')->count(),
            'completed_delivery' => Order::where('courier_id', auth()->id())->where('status', 'completed')->count(),
        ];

        return view('courier.dashboard', compact('assigned_orders', 'stats'));
    }

    /**
     * Display the specific order details for courier.
     */
    public function show(Order $order)
    {
        if ($order->courier_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['user', 'items.product']);
        
        return view('courier.orders.show', compact('order'));
    }

    /**
     * Mark an order as completed.
     */
    public function complete(Request $request, Order $order)
    {
        if ($order->courier_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'shipped') {
            return back()->with('error', 'Hanya pesanan dengan status Shipped yang bisa diselesaikan.');
        }

        $request->validate([
            'proof_of_delivery' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('proof_of_delivery')) {
            $file = $request->file('proof_of_delivery');
            $filename = 'proof_' . $order->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('proofs', $filename, 'public');
            
            $order->update([
                'status' => 'completed',
                'proof_of_delivery' => $path,
            ]);
        }

        return back()->with('success', 'Pesanan #ORD-' . $order->id . ' telah berhasil diselesaikan dengan bukti foto!');
    }
}
