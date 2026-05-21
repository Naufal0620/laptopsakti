<x-app-layout>
    <div class="pb-32 sm:pb-12 bg-gray-50 min-h-screen">
        <!-- Sticky Header with Back Button -->
        <div class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-100 p-4 flex items-center">
            <a href="{{ route('courier.dashboard') }}" class="p-2 -ml-2 text-gray-400 hover:text-primary-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="ml-2 font-black text-gray-900 tracking-tight">Detail Pengiriman</h2>
            <div class="ml-auto">
                <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase tracking-widest
                    @if($order->status === 'shipped') bg-primary-50 text-primary-600
                    @elseif($order->status === 'completed') bg-green-50 text-green-600
                    @endif">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

        <!-- Map Section (Edge to Edge) -->
        <div class="relative w-full h-80 z-10 shadow-inner overflow-hidden border-b border-gray-100">
            @if($order->delivery_lat && $order->delivery_lng)
                <div id="map" class="w-full h-full"></div>
                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $order->delivery_lat }},{{ $order->delivery_lng }}" target="_blank" class="absolute bottom-4 right-4 z-20 bg-white shadow-xl rounded-xl px-4 py-3 flex items-center space-x-2 border border-gray-100 active:scale-95 transition">
                    <img src="https://www.google.com/images/branding/product/2x/maps_96in128dp.png" class="w-6 h-6">
                    <span class="text-xs font-black uppercase tracking-widest text-gray-700">Rute G-Maps</span>
                </a>
            @else
                <div class="w-full h-full bg-gray-100 flex flex-col items-center justify-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 10V7" />
                    </svg>
                    <span class="text-sm italic">Peta tidak tersedia</span>
                </div>
            @endif
        </div>

        <div class="max-w-xl mx-auto px-4 mt-6 space-y-6">
            <!-- Delivery Info Card -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center text-2xl font-black mr-4 shadow-sm">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nama Pelanggan</div>
                            <h3 class="font-black text-gray-900 text-lg leading-tight">{{ $order->user->name }}</h3>
                        </div>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user->phone) }}" target="_blank" class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center hover:bg-green-100 transition shadow-sm active:scale-95">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-2.278 0-4.128 1.849-4.128 4.128 0 2.279 1.85 4.128 4.128 4.128 2.279 0 4.128-1.849 4.128-4.128 0-2.279-1.849-4.128-4.128-4.128zm.014 9.429c-3.13 0-5.67-2.541-5.67-5.67s2.541-5.67 5.67-5.67 5.67 2.541 5.67 5.67-2.541 5.67-5.67 5.67zm11.955-3.601c0 6.627-5.373 12-12 12-2.04 0-3.951-.512-5.626-1.412l-5.626 1.412 1.412-5.626c-.9-1.675-1.412-3.586-1.412-5.626 0-6.627 5.373-12 12-12s12 5.373 12 12zm-3.081 0c0-4.926-4.008-8.934-8.934-8.934s-8.934 4.008-8.934 8.934c0 1.942.622 3.738 1.676 5.205l-1.076 4.288 4.288-1.076c1.467 1.054 3.263 1.676 5.205 1.676 4.926 0 8.934-4.008 8.934-8.934z"/></svg>
                    </a>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Alamat Lengkap</div>
                        <p class="text-sm text-gray-800 leading-relaxed font-medium">{{ $order->delivery_address }}</p>
                    </div>
                    <div class="flex items-center text-xs font-black text-gray-400 space-x-4">
                        <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Jarak: {{ $order->distance_km }} KM</span>
                        <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> PO: {{ $order->expected_ready_date->format('d M') }}</span>
                    </div>
                </div>
            </div>

            <!-- Items List -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100">
                    <h4 class="text-xs font-black text-gray-400 uppercase tracking-widest">Daftar Belanja</h4>
                </div>
                <div class="divide-y divide-gray-50">
                    @foreach($order->items as $item)
                    <div class="p-6 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 flex-shrink-0">
                                @php
                                    $primaryImage = $item->product->images->where('is_primary', true)->first();
                                @endphp
                                @if($primaryImage)
                                    <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-200">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 leading-tight">{{ $item->product->name }}</h4>
                                <div class="mt-1 flex items-center text-xs text-gray-400 font-bold uppercase tracking-wider">
                                    <span class="text-primary-600 mr-2">{{ $item->quantity }} Porsi</span>
                                    <span>Rp {{ number_format($item->price_at_time, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Fixed Bottom Action Bar -->
        <div class="fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-gray-100 p-6 z-40 sm:max-w-xl sm:mx-auto sm:relative sm:mt-8 sm:rounded-3xl sm:border sm:shadow-lg">
            @if($order->status === 'shipped')
            <form action="{{ route('courier.orders.complete', $order) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Konfirmasi bahwa pesanan sudah sampai ke tangan pelanggan?')">
                @csrf
                <div class="mb-4">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 text-center">Ambil Bukti Foto Pengiriman</label>
                    <div class="relative group">
                        <input type="file" name="proof_of_delivery" accept="image/*" capture="environment" required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-6 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center group-hover:border-primary-300 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300 group-hover:text-primary-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-[10px] font-black text-gray-400 uppercase group-hover:text-primary-500">Klik untuk Kamera</span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full py-4 bg-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-xl shadow-primary-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Selesaikan Pengiriman
                </button>
            </form>
            @else
                <div class="flex flex-col items-center" x-data="{ 
                    showProof: false, 
                    scale: 1, 
                    originX: 0, 
                    originY: 0, 
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
                    @if($order->proof_of_delivery)
                        <div class="mb-4 w-full text-center">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Bukti Pengiriman (Klik untuk Perbesar)</label>
                            <div class="w-full h-48 bg-gray-100 rounded-2xl overflow-hidden border border-gray-100 cursor-pointer active:scale-95 transition" @click="showProof = true; reset()">
                                <img src="{{ asset('storage/' . $order->proof_of_delivery) }}" alt="Proof of Delivery" class="w-full h-full object-cover">
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

                            <div class="absolute bottom-10 text-white/50 text-[10px] font-bold uppercase tracking-[0.2em]">Gunakan mouse atau sentuhan untuk menggeser</div>
                        </div>
                    @endif
                    <div class="flex items-center justify-center text-green-600 font-black uppercase tracking-widest text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Pesanan Selesai Diantar
                    </div>
                    <div class="text-center text-[10px] text-gray-400 mt-1 font-bold">
                        {{ $order->updated_at->format('d F Y, H:i') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($order->delivery_lat && $order->delivery_lng)
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        const destLat = {{ $order->delivery_lat }};
        const destLng = {{ $order->delivery_lng }};
        
        const map = L.map('map', {
            zoomControl: false
        }).setView([destLat, destLng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const destIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        L.marker([destLat, destLng], {icon: destIcon}).addTo(map)
            .bindPopup("<b>Lokasi Tujuan</b>")
            .openPopup();
            
        L.control.zoom({
            position: 'topright'
        }).addTo(map);
    </script>
    @endif
</x-app-layout>