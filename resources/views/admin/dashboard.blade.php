@extends('layouts.admin')

@section('header')
    Dashboard Overview
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stats Cards -->
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-gray-50 rounded-2xl text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Produk</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['total_products'] }}</div>
        <div class="mt-2 text-xs font-bold text-gray-400 italic">Produk UMKM Terdaftar</div>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-primary-50 rounded-2xl text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest">Pesanan Baru</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['pending_orders'] }}</div>
        <div class="mt-2 text-xs font-bold text-primary-500 italic">Butuh Konfirmasi Segera</div>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-green-50 rounded-2xl text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-green-600 uppercase tracking-widest">Revenue</span>
        </div>
        <div class="text-2xl font-black text-gray-900 leading-none">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
        <div class="mt-2 text-xs font-bold text-green-500 italic">Total Omzet Penjualan</div>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Customer</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['total_customers'] }}</div>
        <div class="mt-2 text-xs font-bold text-blue-500 italic">Pelanggan Terdaftar</div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
        <h3 class="font-black text-gray-900 uppercase tracking-tighter">Pesanan Terbaru</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-[10px] font-black uppercase tracking-widest text-primary-600 hover:text-primary-700 transition">View All Orders</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($latest_orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-5 font-black text-gray-900">#ORD-{{ $order->id }}</td>
                    <td class="px-8 py-5 font-bold text-gray-700">{{ $order->user->name }}</td>
                    <td class="px-8 py-5 font-black text-primary-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td class="px-8 py-5 text-center">
                        <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase tracking-widest
                            @if($order->status === 'pending') bg-yellow-50 text-yellow-600
                            @elseif($order->status === 'paid') bg-blue-50 text-blue-600
                            @elseif($order->status === 'processing') bg-purple-50 text-purple-600
                            @elseif($order->status === 'shipped') bg-primary-50 text-primary-600
                            @elseif($order->status === 'completed') bg-green-50 text-green-600
                            @else bg-red-50 text-red-600 @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-xs text-gray-500 font-bold uppercase tracking-wider">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center italic text-gray-400 text-sm font-medium">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
