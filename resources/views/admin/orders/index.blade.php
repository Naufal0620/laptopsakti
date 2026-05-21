@extends('layouts.admin')

@section('header')
    Daftar Pesanan
@endsection

@section('content')
<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.orders.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ !request('status') ? 'bg-primary-500 text-white shadow-lg shadow-primary-100' : 'bg-white text-gray-500 border border-gray-100 hover:bg-gray-50' }}">
            Semua
        </a>
        @foreach(['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
            <a href="{{ route('admin.orders.index', ['status' => $status]) }}" 
               class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ request('status') === $status ? 'bg-primary-500 text-white shadow-lg shadow-primary-100' : 'bg-white text-gray-500 border border-gray-100 hover:bg-gray-50' }}">
                {{ $status }}
            </a>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-50">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID Pesanan</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Total Tagihan</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-8 py-5">
                        <span class="font-black text-gray-900">#ORD-{{ $order->id }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-900 leading-none mb-1">{{ $order->user->name }}</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $order->user->phone }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <span class="font-black text-primary-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <span class="inline-flex px-3 py-1 text-[10px] font-black rounded-full uppercase tracking-widest
                            @if($order->status === 'pending') bg-yellow-50 text-yellow-600
                            @elseif($order->status === 'paid') bg-blue-50 text-blue-600
                            @elseif($order->status === 'processing') bg-purple-50 text-purple-600
                            @elseif($order->status === 'shipped') bg-primary-50 text-primary-600
                            @elseif($order->status === 'completed') bg-green-50 text-green-600
                            @else bg-red-50 text-red-600 @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-xs text-gray-500 font-bold">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="inline-flex items-center px-4 py-2 bg-gray-50 text-gray-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-500 hover:text-white hover:shadow-lg hover:shadow-primary-100 transition-all">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <span class="text-gray-400 italic text-sm">Tidak ada pesanan ditemukan</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
        <div class="px-8 py-5 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
