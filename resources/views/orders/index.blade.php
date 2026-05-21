<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                        <div class="p-6">
                            <!-- Order Header -->
                            <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">PESANAN</div>
                                        <div class="text-lg font-black text-gray-900 leading-none">#ORD-{{ $order->id }}</div>
                                    </div>
                                </div>
                                <div class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest
                                    @if($order->status === 'pending') bg-yellow-50 text-yellow-600
                                    @elseif($order->status === 'paid') bg-blue-50 text-blue-600
                                    @elseif($order->status === 'processing') bg-purple-50 text-purple-600
                                    @elseif($order->status === 'shipped') bg-primary-50 text-primary-600
                                    @elseif($order->status === 'completed') bg-green-50 text-green-600
                                    @else bg-red-50 text-red-600 @endif">
                                    {{ $order->status }}
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-50 mb-6">
                                @if($order->items->first())
                                    <div class="flex-shrink-0 w-20 h-20 bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                                        @php
                                            $firstItem = $order->items->first()->product;
                                            $thumb = $firstItem->primaryImage ? asset('storage/' . $firstItem->primaryImage->image_path) : (
                                                $firstItem->images->first() ? asset('storage/' . $firstItem->images->first()->image_path) : (
                                                    $firstItem->videos->first() && $firstItem->videos->first()->thumbnail_path ? asset('storage/' . $firstItem->videos->first()->thumbnail_path) : 'https://via.placeholder.com/200?text=Food'
                                                )
                                            );
                                        @endphp
                                        <img src="{{ $thumb }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-black text-gray-900 truncate tracking-tight text-lg">{{ $order->items->first()->product->name }}</div>
                                        <div class="text-xs text-gray-500 font-bold uppercase tracking-wide mt-1 flex items-center">
                                            <span>{{ $order->items->first()->quantity }} ITEM</span>
                                            @if($order->items->count() > 1)
                                                <span class="mx-2 text-gray-300">•</span>
                                                <span class="text-primary-600">+ {{ $order->items->count() - 1 }} PRODUK LAINNYA</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Order Footer -->
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">TOTAL PEMBAYARAN</div>
                                    <div class="text-2xl font-black text-primary-600 leading-none">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ route('orders.show', $order) }}" class="px-6 py-3 bg-gray-900 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-black transition active:scale-95 shadow-lg shadow-gray-200">
                                    Detail
                                </a>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50/50 border-t border-gray-50 flex justify-between items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</span>
                            @if($order->status === 'pending')
                                <span class="text-[10px] text-yellow-600 font-black uppercase tracking-widest flex items-center">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span>
                                    Menunggu Pembayaran
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center bg-white rounded-[3rem] border border-gray-100 shadow-sm">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-200 mx-auto mb-6 shadow-inner">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight mb-2 uppercase">Belum Ada Pesanan</h3>
                        <p class="text-gray-400 font-medium mb-8">Sepertinya dapur Anda masih dingin hari ini.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-primary-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-600 transition shadow-xl shadow-primary-100 active:scale-95">
                            Cari Makanan Enak
                        </a>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
