<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <div class="py-6 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Session Status -->
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl relative text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left: Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-bold mb-6 flex items-center">
                                <span class="w-8 h-8 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                                Informasi Pengiriman
                            </h3>
                            
                            <div class="mb-6">
                                <x-input-label for="delivery_address" :value="__('Alamat Lengkap')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
                                <textarea id="delivery_address" name="delivery_address" class="block w-full border-gray-100 bg-gray-50 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm transition-all duration-200" rows="3" required placeholder="Tuliskan nama jalan, nomor rumah, atau patokan...">{{ old('delivery_address', auth()->user()->address ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <x-input-label :value="__('Titik Lokasi Pengiriman')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <button type="button" onclick="getCurrentLocation()" class="text-[10px] font-bold uppercase tracking-wider bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-lg transition-all">
                                        📍 Lokasi Saya
                                    </button>
                                </div>
                                <div id="map" class="w-full h-72 rounded-2xl border border-gray-100 z-0 shadow-inner"></div>
                                <p class="text-[10px] text-gray-400 mt-3 italic">* Geser pin merah tepat di atas lokasi rumah Anda untuk akurasi pengiriman.</p>
                                
                                <input type="hidden" name="delivery_lat" id="delivery_lat" value="{{ old('delivery_lat', $store_lat) }}">
                                <input type="hidden" name="delivery_lng" id="delivery_lng" value="{{ old('delivery_lng', $store_lng) }}">
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-bold mb-6 flex items-center">
                                <span class="w-8 h-8 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                                Promo & Kupon
                            </h3>
                            <div class="flex gap-2">
                                <input type="text" name="coupon_code" id="coupon_code" placeholder="Punya kode kupon?" class="flex-1 border-gray-100 bg-gray-50 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-xl shadow-sm transition-all" value="{{ old('coupon_code') }}" />
                                <button type="button" id="apply-coupon-btn" class="px-6 py-2 bg-gray-800 text-white rounded-xl font-bold text-sm hover:bg-gray-900 transition active:scale-95">Pakai</button>
                            </div>
                            <div id="coupon-message" class="text-xs mt-3 hidden font-bold"></div>
                        </div>

                        <div class="p-4 bg-primary-50 text-primary-700 rounded-2xl text-xs flex items-start leading-relaxed border border-primary-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p><strong>Info Penting:</strong> Setelah melakukan pesanan, Anda akan diarahkan ke WhatsApp Admin. Mohon kirimkan bukti transfer agar pesanan segera diproses.</p>
                        </div>
                    </div>

                    <!-- Right: Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 lg:sticky lg:top-6">
                            <h3 class="text-lg font-bold mb-6">Ringkasan Pesanan</h3>
                            
                            <div class="space-y-4 mb-6 max-h-48 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-100">
                                @php $subtotal = 0; @endphp
                                @foreach($cart as $item)
                                    @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                    <div class="flex justify-between text-sm">
                                        <div class="flex flex-col">
                                            <span class="text-gray-900 font-bold leading-tight">{{ $item['name'] }}</span>
                                            <span class="text-[10px] text-gray-400 uppercase font-bold mt-0.5">{{ $item['quantity'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                        </div>
                                        <span class="font-black text-gray-900 ml-4">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-50 pt-6 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 font-medium">Subtotal Produk</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex flex-col">
                                        <span class="text-gray-500 font-medium">Ongkos Kirim</span>
                                        <span id="display-distance" class="text-[10px] text-gray-400 font-bold">Jarak: 0 km</span>
                                    </div>
                                    <span id="display-shipping" class="font-bold text-gray-900">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-sm text-green-600 bg-green-50/50 p-2 rounded-lg border border-green-50 hidden" id="discount-row">
                                    <span class="font-medium">Potongan Diskon</span>
                                    <span id="display-discount" class="font-black">- Rp 0</span>
                                </div>
                                <div class="pt-4 flex flex-col mt-2">
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Total Tagihan</span>
                                    <span id="display-grand-total" class="text-3xl font-black text-primary-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="submit" form="checkout-form" class="w-full py-4 mt-8 bg-primary-500 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-lg shadow-primary-100 flex items-center justify-center">
                                Pesan & Bayar via WA
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        const storeLat = {{ $store_lat }};
        const storeLng = {{ $store_lng }};
        const subtotal = {{ $subtotal }};
        const shippingRate = {{ $shipping_cost_per_km }};

        // UI Elements
        const latInput = document.getElementById('delivery_lat');
        const lngInput = document.getElementById('delivery_lng');
        const displayShipping = document.getElementById('display-shipping');
        const displayDistance = document.getElementById('display-distance');
        const displayDiscount = document.getElementById('display-discount');
        const displayGrandTotal = document.getElementById('display-grand-total');
        const couponInput = document.getElementById('coupon_code');
        const couponBtn = document.getElementById('apply-coupon-btn');
        const couponMessage = document.getElementById('coupon-message');

        let currentDiscount = 0;

        // Initialize Map
        const map = L.map('map').setView([storeLat, storeLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Store Marker (Fixed)
        const storeIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        L.marker([storeLat, storeLng], {icon: storeIcon}).addTo(map).bindPopup("<b>Lokasi Kulivio UMKM</b>").openPopup();

        // User Marker (Draggable)
        const userMarker = L.marker([storeLat, storeLng], {
            draggable: true
        }).addTo(map);

        function calculateHaversine(lat1, lon1, lat2, lon2) {
            const R = 6371; // km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function updateTotals() {
            const pos = userMarker.getLatLng();
            latInput.value = pos.lat;
            lngInput.value = pos.lng;

            const distance = calculateHaversine(storeLat, storeLng, pos.lat, pos.lng);
            const shipping = distance * shippingRate;
            const grandTotal = Math.max(0, (subtotal + shipping) - currentDiscount);

            displayDistance.innerText = `Jarak: ${distance.toFixed(2)} km`;
            displayShipping.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(shipping));
            displayDiscount.innerText = '- Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(currentDiscount));
            displayGrandTotal.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(grandTotal));
        }

        userMarker.on('dragend', updateTotals);

        // Add Click event to map
        map.on('click', function(e) {
            userMarker.setLatLng(e.latlng);
            updateTotals();
        });

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const newPos = new L.LatLng(lat, lng);
                    userMarker.setLatLng(newPos);
                    map.setView(newPos, 15);
                    updateTotals();
                }, (error) => {
                    alert("Gagal mengambil lokasi. Pastikan GPS aktif dan izin diberikan.");
                });
            } else {
                alert("Browser Anda tidak mendukung geolokasi.");
            }
        }

        // Coupon AJAX Logic
        couponBtn.addEventListener('click', async function() {
            const code = couponInput.value.trim();
            if (!code) return;

            couponBtn.disabled = true;
            couponBtn.innerText = '...';

            try {
                const response = await fetch('{{ route('checkout.apply-coupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code: code,
                        subtotal: subtotal
                    })
                });

                const data = await response.json();

                couponMessage.classList.remove('hidden', 'text-red-600', 'text-green-600');
                
                if (data.success) {
                    currentDiscount = data.discount_amount;
                    couponMessage.innerText = data.message;
                    couponMessage.classList.add('text-green-600');
                } else {
                    currentDiscount = 0;
                    couponMessage.innerText = data.message;
                    couponMessage.classList.add('text-red-600');
                }
                updateTotals();
            } catch (error) {
                console.error('Error applying coupon:', error);
                couponMessage.innerText = 'Terjadi kesalahan saat menerapkan kupon.';
                couponMessage.classList.remove('hidden');
                couponMessage.classList.add('text-red-600');
            } finally {
                couponBtn.disabled = false;
                couponBtn.innerText = 'Pakai';
            }
        });

        // Initial update
        updateTotals();
    </script>
</x-app-layout>
