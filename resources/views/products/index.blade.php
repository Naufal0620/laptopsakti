<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden border-b border-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-black text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Nikmati Kuliner Terbaik</span>
                            <span class="block text-primary-600 xl:inline leading-tight">UMKM Pilihan Anda</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 font-medium">
                            Temukan berbagai hidangan lezat langsung dari dapur UMKM lokal. Pesan secara Pre-Order untuk kualitas dan kesegaran yang terjamin.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-xl shadow">
                                <a href="{{ route('explore') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-black rounded-xl text-white bg-primary-600 hover:bg-primary-700 md:py-4 md:text-lg md:px-10 transition shadow-lg shadow-primary-100">
                                    Mulai Jelajah Video
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#produk-list" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-bold rounded-xl text-primary-700 bg-primary-50 hover:bg-primary-100 md:py-4 md:text-lg md:px-10 transition">
                                    Lihat Katalog
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Delicious Food">
        </div>
    </div>

    <div class="py-12" id="produk-list">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search & Filter Bar -->
            <div class="mb-12">
                <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari makanan yang kamu idamkan..." value="{{ request('search') }}" class="block w-full pl-12 pr-4 py-4 bg-white border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium transition-all" />
                    </div>
                    <div class="flex gap-2">
                        <div class="relative flex-1 md:w-36">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs font-bold uppercase tracking-widest">Rp</span>
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="block w-full pl-10 pr-4 py-4 bg-white border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium" />
                        </div>
                        <div class="relative flex-1 md:w-36">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs font-bold uppercase tracking-widest">Rp</span>
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="block w-full pl-10 pr-4 py-4 bg-white border-gray-100 focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium" />
                        </div>
                        <button type="submit" class="px-8 py-4 bg-gray-900 text-white font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-black transition active:scale-95 shadow-lg shadow-gray-200">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-primary-200 hover:shadow-xl hover:shadow-primary-50/50 transition-all duration-300 flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @elseif($product->videos->first() && $product->videos->first()->thumbnail_path)
                                <img src="{{ asset('storage/' . $product->videos->first()->thumbnail_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest text-primary-600 shadow-sm border border-primary-50">Pre-Order</span>
                            </div>
                            
                            @if($product->discount_type !== 'none' && $product->discount_value > 0)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-md">
                                        @if($product->discount_type === 'percentage')
                                            -{{ $product->discount_value }}%
                                        @else
                                            DISKON
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-lg font-black text-gray-900 group-hover:text-primary-600 transition-colors leading-tight mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-xs font-medium line-clamp-2 mb-4 leading-relaxed">{{ $product->description }}</p>
                            
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <div class="flex flex-col">
                                    @if ($product->discount_type !== 'none' && $product->discount_value > 0)
                                        <span class="text-[10px] text-gray-400 line-through font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="text-xl font-black text-primary-600 leading-none">Rp {{ number_format($product->discounted_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-xl font-black text-gray-900 leading-none">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-[8px] font-black text-gray-300 uppercase tracking-widest">Estimasi</span>
                                    <span class="text-xs font-black text-gray-400">{{ $product->pre_order_days }} HARI</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h4 class="text-xl font-bold text-gray-400 uppercase tracking-tight">Opps! Produk Kosong</h4>
                        <p class="text-gray-400 mt-1 italic">Coba kata kunci lain atau bersihkan filter.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
