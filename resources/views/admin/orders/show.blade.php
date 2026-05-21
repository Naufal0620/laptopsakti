@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #ORD-') . $order->id }}
        </h2>
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-xs font-bold uppercase tracking-widest hover:bg-gray-300">Kembali</a>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Order Items & Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Order Items -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Item Pesanan</h3>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($order->items as $item)
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
                            @if($item->product->images->where('is_primary', true)->first())
                                <img src="{{ asset('storage/' . $item->product->images->where('is_primary', true)->first()->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $item->product->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price_at_time, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">Rp {{ number_format($item->quantity * $item->price_at_time, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Ongkos Kirim ({{ $order->distance_km }} km)</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                @if($order->discount_amount > 0)
                <div class="flex justify-between text-sm text-red-600">
                    <span>Diskon ({{ $order->coupon->code ?? 'Promo' }})</span>
                    <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                </div>
                @endif
                <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-2 mt-2">
                    <span class="text-gray-900">Total Tagihan</span>
                    <span class="text-orange-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Informasi Pengiriman</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                    <p class="text-gray-800 leading-relaxed">{{ $order->delivery_address }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Estimasi Siap Kirim</p>
                    <p class="text-gray-800">{{ $order->expected_ready_date ? $order->expected_ready_date->format('d M Y') : '-' }}</p>
                </div>
            </div>
        </div>

        @if($order->proof_of_delivery)
        <!-- Proof of Delivery -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden" x-data="{ 
            showProof: false, 
            scale: 1, 
            translateX: 0, 
            translateY: 0,
            isDragging: false,
            startX: 0,
            startY: 0,
            
            reset() {
                this.scale = 1;
                this.translateX = 0;
                this.translateY = 0;
            },
            
            zoomIn() {
                this.scale = Math.min(this.scale + 0.5, 4);
            },
            
            zoomOut() {
                this.scale = Math.max(this.scale - 0.5, 1);
                if (this.scale === 1) this.reset();
            },

            startDrag(e) {
                if (this.scale > 1) {
                    this.isDragging = true;
                    this.startX = (e.pageX || e.touches[0].pageX) - this.translateX;
                    this.startY = (e.pageY || e.touches[0].pageY) - this.translateY;
                }
            },

            drag(e) {
                if (this.isDragging) {
                    e.preventDefault();
                    this.translateX = (e.pageX || e.touches[0].pageX) - this.startX;
                    this.translateY = (e.pageY || e.touches[0].pageY) - this.startY;
                }
            },

            stopDrag() {
                this.isDragging = false;
            }
        }">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Bukti Pengiriman (Foto Kurir)</h3>
            </div>
            <div class="p-6">
                <div class="w-full max-w-md bg-gray-100 rounded-lg overflow-hidden border border-gray-200 cursor-pointer hover:opacity-90 transition" @click="showProof = true; reset()">
                    <img src="{{ asset('storage/' . $order->proof_of_delivery) }}" alt="Proof of Delivery" class="w-full h-auto object-cover">
                </div>
                <div class="mt-2 text-xs text-gray-500 italic">
                    Foto diunggah pada {{ $order->updated_at->format('d M Y, H:i') }} (Klik foto untuk perbesar & geser)
                </div>
            </div>

            <!-- Fullscreen Modal -->
            <div x-show="showProof" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-black/95 backdrop-blur-md"
                 @keydown.escape.window="showProof = false"
                 style="display: none;">
                
                <!-- Toolbar -->
                <div class="absolute top-0 left-0 right-0 p-6 flex justify-between items-center z-[110]">
                    <div class="flex items-center space-x-2">
                        <button @click="zoomOut()" class="w-10 h-10 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                        </button>
                        <span class="text-[10px] font-black text-white w-12 text-center uppercase tracking-widest" x-text="Math.round(scale * 100) + '%'"></span>
                        <button @click="zoomIn()" class="w-10 h-10 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </button>
                        <button @click="reset()" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-[10px] font-black uppercase tracking-widest transition">Reset</button>
                    </div>
                    <button @click="showProof = false" class="w-10 h-10 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <!-- Image Container -->
                <div class="relative w-full h-full flex items-center justify-center overflow-hidden cursor-move"
                     @mousedown="startDrag"
                     @mousemove="drag"
                     @mouseup="stopDrag"
                     @mouseleave="stopDrag"
                     @touchstart="startDrag"
                     @touchmove="drag"
                     @touchend="stopDrag"
                     @click="showProof = false">
                    <img src="{{ asset('storage/' . $order->proof_of_delivery) }}" 
                         class="max-w-[90%] max-h-[80%] transition-transform duration-200 ease-out shadow-2xl rounded-lg"
                         :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale})`"
                         @click.stop
                         draggable="false">
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Right Column: Actions -->
    <div class="space-y-6">
        <!-- Status Management -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Update Status</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Baru</label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            @foreach(['pending', 'paid', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-orange-600 text-white font-bold py-3 rounded-md shadow-md hover:bg-orange-700 transition">
                        Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Courier Assignment -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Tugaskan Kurir</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.orders.assign-courier', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="courier_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kurir</label>
                        <select name="courier_id" id="courier_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            <option value="">-- Pilih Kurir --</option>
                            @foreach($couriers as $courier)
                                <option value="{{ $courier->id }}" {{ $order->courier_id === $courier->id ? 'selected' : '' }}>
                                    {{ $courier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-md shadow-md hover:bg-blue-700 transition">
                        Tugaskan Kurir
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Informasi Pelanggan</h3>
            </div>
            <div class="p-6">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-xl uppercase">
                        {{ substr($order->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->phone) }}" target="_blank" class="flex items-center justify-center space-x-2 w-full border border-green-500 text-green-600 font-bold py-2 rounded-md hover:bg-green-50 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-2.278 0-4.128 1.849-4.128 4.128 0 2.279 1.85 4.128 4.128 4.128 2.279 0 4.128-1.849 4.128-4.128 0-2.279-1.849-4.128-4.128-4.128zm.014 9.429c-3.13 0-5.67-2.541-5.67-5.67s2.541-5.67 5.67-5.67 5.67 2.541 5.67 5.67-2.541 5.67-5.67 5.67zm11.955-3.601c0 6.627-5.373 12-12 12-2.04 0-3.951-.512-5.626-1.412l-5.626 1.412 1.412-5.626c-.9-1.675-1.412-3.586-1.412-5.626 0-6.627 5.373-12 12-12s12 5.373 12 12zm-3.081 0c0-4.926-4.008-8.934-8.934-8.934s-8.934 4.008-8.934 8.934c0 1.942.622 3.738 1.676 5.205l-1.076 4.288 4.288-1.076c1.467 1.054 3.263 1.676 5.205 1.676 4.926 0 8.934-4.008 8.934-8.934z"/></svg>
                    <span>Hubungi Pelanggan</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
