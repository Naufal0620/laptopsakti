<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-xl text-gray-800 leading-tight tracking-tight">
                {{ __('Detail Pesanan #') . $order->id }}
            </h2>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-50 text-gray-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-100 transition">Kembali</a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Tracking Header -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8">
                            <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm
                                @if($order->status === 'pending') bg-yellow-50 text-yellow-600
                                @elseif($order->status === 'paid') bg-blue-50 text-blue-600
                                @elseif($order->status === 'processing') bg-purple-50 text-purple-600
                                @elseif($order->status === 'shipped') bg-primary-50 text-primary-600
                                @elseif($order->status === 'completed') bg-green-50 text-green-600
                                @else bg-red-50 text-red-600 @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                        
                        <div class="flex items-center space-x-6 mb-8">
                            <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-900 tracking-tight leading-none mb-2 uppercase">Lacak Pesanan</h3>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-none">Order ID: #ORD-{{ $order->id }}</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 bg-gray-50 rounded-2xl border border-gray-50">
                            <div class="mt-1 w-5 h-5 flex-shrink-0 text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Estimasi Produk Siap</p>
                                <p class="text-sm font-black text-gray-800 tracking-tight">{{ $order->expected_ready_date ? $order->expected_ready_date->format('l, d F Y') : 'Menunggu Konfirmasi' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Daftar Menu Pesanan</h4>
                        <div class="space-y-6">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-6 group">
                                    <div class="w-20 h-20 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex-shrink-0">
                                        @php
                                            $prod = $item->product;
                                            $thumb = $prod->primaryImage ? asset('storage/' . $prod->primaryImage->image_path) : (
                                                $prod->images->first() ? asset('storage/' . $prod->images->first()->image_path) : (
                                                    $prod->videos->first() && $prod->videos->first()->thumbnail_path ? asset('storage/' . $prod->videos->first()->thumbnail_path) : 'https://via.placeholder.com/200?text=Food'
                                                )
                                            );
                                        @endphp
                                        <img src="{{ $thumb }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-black text-gray-900 leading-tight text-lg mb-1">{{ $item->product->name }}</h5>
                                        <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest flex items-center">
                                            <span class="text-primary-600">{{ $item->quantity }}x</span>
                                            <span class="mx-2">@</span>
                                            <span>Rp {{ number_format($item->price_at_time, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-black text-gray-900 leading-none">Rp {{ number_format($item->quantity * $item->price_at_time, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Alamat Pengiriman</h4>
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 mr-4 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 leading-relaxed mb-4">
                                    {{ $order->delivery_address }}
                                </p>
                                <div class="inline-flex items-center px-3 py-1.5 bg-primary-50 rounded-xl text-[10px] font-black text-primary-600 uppercase tracking-widest">
                                    JARAK: {{ $order->distance_km }} KM
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($order->proof_of_delivery)
                    <!-- Proof of Delivery -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm overflow-hidden" x-data="{ 
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
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Bukti Pesanan Sampai</h4>
                        <div class="relative group cursor-pointer" @click="showProof = true; reset()">
                            <div class="w-full h-64 bg-gray-50 rounded-[1.5rem] overflow-hidden border border-gray-100 shadow-inner">
                                <img src="{{ asset('storage/' . $order->proof_of_delivery) }}" alt="Proof of Delivery" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Telah Diterima (Klik untuk Perbesar & Geser)
                                </div>
                                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-tighter">{{ $order->updated_at->format('d M Y, H:i') }}</span>
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
                                     class="max-w-[90%] max-h-[80%] transition-transform duration-200 ease-out shadow-2xl rounded-[2rem]"
                                     :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale})`"
                                     @click.stop
                                     draggable="false">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right: Summary & Action -->
                <div class="space-y-6">
                    <!-- Status Actions -->
                    @if($order->status === 'pending')
                        <div class="bg-primary-600 rounded-[2rem] p-8 text-white shadow-xl shadow-primary-100 overflow-hidden relative group">
                            <div class="relative z-10">
                                <h4 class="text-lg font-black uppercase tracking-tight mb-4 leading-tight">Konfirmasi Pembayaran</h4>
                                <p class="text-xs text-primary-100 font-medium leading-relaxed mb-8 opacity-80">Segera kirimkan bukti transfer Anda agar tim kami dapat memproses hidangan segar Anda!</p>
                                
                                <a href="https://wa.me/{{ \App\Models\Setting::getValue('admin_whatsapp_number', '628123456789') }}?text={{ urlencode('Halo Admin Kulivio, saya ingin konfirmasi pembayaran untuk pesanan #ORD-' . $order->id) }}" target="_blank" class="block w-full text-center py-4 bg-white text-primary-600 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg hover:scale-95 transition-transform">
                                    Kirim Bukti via WA
                                </a>

                                <form action="{{ route('orders.cancel', $order) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                    @csrf
                                    <button type="submit" class="block w-full text-center py-2 bg-primary-700 text-primary-200 rounded-xl font-black text-[9px] uppercase tracking-widest hover:text-white transition">
                                        Batalkan Pesanan
                                    </button>
                                </form>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute -bottom-10 -right-10 w-48 h-48 text-primary-500 opacity-20 group-hover:scale-110 transition-transform duration-700" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                    @else
                        <div class="bg-gray-900 rounded-[2rem] p-8 text-white shadow-xl shadow-gray-200">
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">BANTUAN</div>
                            <h4 class="text-lg font-black uppercase tracking-tight mb-6">Punya kendala dengan pesanan?</h4>
                            <a href="https://wa.me/{{ \App\Models\Setting::getValue('admin_whatsapp_number', '628123456789') }}?text={{ urlencode('Halo Admin Kulivio, saya butuh bantuan untuk pesanan #ORD-' . $order->id) }}" target="_blank" class="inline-flex items-center text-primary-400 font-black text-[10px] uppercase tracking-widest hover:text-primary-300 transition">
                                HUBUNGI CUSTOMER SERVICE
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    @endif

                    <!-- Pricing Summary -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Ringkasan Biaya</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">SUBTOTAL</span>
                                <span class="text-sm font-black text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">ONGKOS KIRIM</span>
                                <span class="text-sm font-black text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            @if($order->discount_amount > 0)
                                <div class="flex justify-between items-center text-green-600 bg-green-50/50 p-2 rounded-xl border border-green-50">
                                    <span class="text-[10px] font-black uppercase tracking-widest">DISKON</span>
                                    <span class="text-sm font-black">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            <div class="pt-6 border-t border-gray-50 flex flex-col mt-4">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">GRAND TOTAL</span>
                                <span class="text-3xl font-black text-primary-600 leading-none">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
