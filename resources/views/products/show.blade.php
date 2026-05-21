<x-app-layout>
    <div class="pb-32 sm:pb-12">
        <!-- Back Button (Mobile) -->
        <div class="sm:hidden sticky top-0 z-30 bg-white/80 backdrop-blur-md px-4 py-4 flex items-center border-b border-gray-100">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-gray-400 hover:text-primary-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="ml-2 font-black text-gray-900 tracking-tight">Detail Produk</h2>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Left: Gallery -->
                <div class="space-y-6">
                    <div id="main-display-container" class="relative aspect-square sm:aspect-[4/5] bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-2xl shadow-gray-200 border border-white group">
                        @php
                            $mainImage = $product->primaryImage ? asset('storage/' . $product->primaryImage->image_path) : (
                                $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : (
                                    $product->videos->first() && $product->videos->first()->thumbnail_path ? asset('storage/' . $product->videos->first()->thumbnail_path) : 'https://via.placeholder.com/800x1000?text=Produk'
                                )
                            );
                        @endphp
                        <img src="{{ $mainImage }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <div class="absolute top-6 left-6 flex flex-col gap-2">
                            <span class="bg-primary-500 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg">Pilihan Terbaik</span>
                        </div>
                    </div>

                    @if($product->images->count() > 0 || $product->videos->count() > 0)
                        <div class="flex gap-4 overflow-x-auto pb-4 hide-scrollbar snap-x">
                            <!-- Video Thumbnails -->
                            @foreach($product->videos as $video)
                                <div class="relative w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-black rounded-3xl cursor-pointer overflow-hidden border-2 border-transparent hover:border-primary-500 transition-all snap-start group" onclick="updateMainDisplay('{{ asset('storage/' . $video->video_path) }}', true)">
                                    @if($video->thumbnail_path)
                                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="w-full h-full object-cover opacity-60">
                                    @endif
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="p-2 bg-white/20 backdrop-blur-md rounded-full text-white group-hover:scale-110 transition">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168l4.74 3.555a.5.5 0 010 .893l-4.74 3.556A.5.5 0 019 14.721V7.279a.5.5 0 01.755-.432z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Image Thumbnails -->
                            @foreach($product->images as $image)
                                <div class="w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-gray-50 rounded-3xl cursor-pointer overflow-hidden border-2 border-transparent hover:border-primary-500 transition-all snap-start" onclick="updateMainDisplay('{{ asset('storage/' . $image->image_path) }}', false)">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right: Content -->
                <div class="flex flex-col">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-primary-50 text-primary-600 uppercase tracking-widest">Pre-Order Fresh</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-green-50 text-green-600 uppercase tracking-widest">Terlaris</span>
                    </div>

                    <h1 class="text-3xl sm:text-5xl font-black text-gray-900 leading-tight mb-4 tracking-tighter">{{ $product->name }}</h1>
                    
                    <div class="flex items-end space-x-4 mb-8">
                        @if ($product->discount_type !== 'none' && $product->discount_value > 0)
                            <div class="flex flex-col">
                                <span class="text-sm text-gray-400 line-through font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-4xl font-black text-primary-600">Rp {{ number_format($product->discounted_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="bg-red-50 text-red-600 px-3 py-1 rounded-xl text-xs font-black self-start">
                                -{{ $product->discount_type === 'percentage' ? $product->discount_value . '%' : 'Hemat' }}
                            </div>
                        @else
                            <span class="text-4xl font-black text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>

                    <!-- PO Highlight -->
                    <div class="bg-gray-50 rounded-3xl p-6 border border-gray-100 flex items-center mb-10 shadow-inner">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-primary-500 shadow-sm mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Waktu Tunggu (Pre-Order)</p>
                            <p class="text-lg font-black text-gray-900 leading-none">{{ $product->pre_order_days }} HARI KERJA</p>
                            <p class="text-xs text-gray-500 mt-1 font-medium italic">* Produk dimasak segar khusus untuk Anda.</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-4 mb-12">
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Deskripsi Produk
                        </h3>
                        <p class="text-gray-600 leading-relaxed font-medium">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Desktop Action (Hidden on Mobile) -->
                    <div class="hidden sm:block mt-auto">
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-4">
                            @csrf
                            <div class="w-32 bg-gray-50 rounded-2xl p-1 border border-gray-100 flex items-center overflow-hidden">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary-600 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg></button>
                                <input type="number" name="quantity" value="1" min="1" class="w-full bg-transparent border-none text-center font-black text-gray-900 focus:ring-0" readonly>
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-primary-600 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></button>
                            </div>
                            <button type="submit" class="flex-1 py-4 bg-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-xl shadow-primary-100">
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Bottom Bar (Mobile Only) -->
        <div class="sm:hidden fixed bottom-16 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-gray-100 p-4 z-40">
            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-3">
                @csrf
                <div class="w-24 bg-gray-50 rounded-xl p-1 border border-gray-100 flex items-center">
                    <input type="number" name="quantity" value="1" min="1" class="w-full bg-transparent border-none text-center font-black text-gray-900 focus:ring-0 text-sm py-1" readonly id="mobile-qty">
                </div>
                <button type="submit" class="flex-1 py-3 bg-primary-500 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-primary-100">
                    Tambah Ke Keranjang
                </button>
            </form>
        </div>
    </div>

    <script>
        function updateMainDisplay(source, isVideo) {
            const container = document.getElementById('main-display-container');
            if (isVideo) {
                container.innerHTML = `<video class="w-full h-full object-cover" controls autoplay muted loop><source src="${source}" type="video/mp4"></video>`;
            } else {
                container.innerHTML = `<img src="${source}" class="w-full h-full object-cover animate-fade-in">`;
            }
        }
    </script>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out; }
    </style>
</x-app-layout>
