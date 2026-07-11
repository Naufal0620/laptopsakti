<x-app-layout>
    <!-- Header Section -->
    <div class="bg-slate-950 text-white border-b border-slate-900 py-12 relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-50%] left-[-20%] w-[60%] h-[100%] rounded-full bg-primary-600/10 blur-[130px] animate-pulse"></div>
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-300">
                Katalog Laptop Sakti
            </h1>
            <p class="text-slate-400 mt-2 font-medium max-w-xl text-sm sm:text-base">
                Temukan spesifikasi laptop idaman Anda dengan filter lengkap dan presisi di bawah ini.
            </p>
        </div>
    </div>

    <!-- Catalog Main Area -->
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Sidebar Filters -->
                <aside class="lg:col-span-3 bg-white p-6 rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 z-10">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                        <h2 class="font-black text-slate-800 text-sm uppercase tracking-wider flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Filter Pencarian
                        </h2>
                        <a href="{{ route('products.index') }}" class="text-xs text-slate-400 hover:text-primary-600 font-bold transition">Reset Filter</a>
                    </div>

                    <form action="{{ route('products.index') }}" method="GET" class="space-y-6">
                        <!-- Search Box -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider">Cari Laptop</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                <input type="text" name="search" placeholder="ASUS, i7, RTX, dll..." value="{{ request('search') }}" class="block w-full pl-9 pr-3 py-2.5 bg-slate-50 border-slate-200 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg text-xs font-medium transition" />
                            </div>
                        </div>

                        <!-- Price Range Slider (2 Points) -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Rentang Harga (Rp)</label>
                            <div x-data="{
                                minPrice: {{ request('min_price', $minPriceBound) }},
                                maxPrice: {{ request('max_price', $maxPriceBound) }},
                                minBound: {{ $minPriceBound }},
                                maxBound: {{ $maxPriceBound }},
                                formatRupiah(value) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                }
                            }" class="space-y-4 pt-2">
                                <div class="flex justify-between items-center text-[10px] text-slate-500 font-black">
                                    <span>Rp <span x-text="formatRupiah(minPrice)"></span></span>
                                    <span>Rp <span x-text="formatRupiah(maxPrice)"></span></span>
                                </div>
                                <div class="relative h-2 bg-slate-100 rounded-lg">
                                    <div class="absolute h-2 bg-primary-500 rounded-lg"
                                         :style="'left: ' + ((minPrice - minBound) / (maxBound - minBound) * 100) + '%; right: ' + (100 - (maxPrice - minBound) / (maxBound - minBound) * 100) + '%'"></div>
                                    <input type="range" :min="minBound" :max="maxBound" step="500000" x-model.number="minPrice"
                                           @input="if(minPrice > maxPrice) { minPrice = maxPrice }"
                                           class="absolute pointer-events-none appearance-none w-full h-2 bg-transparent top-0 left-0 outline-none double-range-slider-input-min">
                                    <input type="range" :min="minBound" :max="maxBound" step="500000" x-model.number="maxPrice"
                                           @input="if(maxPrice < minPrice) { maxPrice = minPrice }"
                                           class="absolute pointer-events-none appearance-none w-full h-2 bg-transparent top-0 left-0 outline-none double-range-slider-input-max">
                                </div>
                                <input type="hidden" name="min_price" :value="minPrice">
                                <input type="hidden" name="max_price" :value="maxPrice">
                            </div>
                        </div>

                        <!-- Brand Checkboxes -->
                        @if($availableBrands->count() > 0)
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Merek Laptop</label>
                                <div class="space-y-2 max-h-40 overflow-y-auto pr-2">
                                    @foreach($availableBrands as $brand)
                                        <label class="flex items-center text-xs font-medium text-slate-600 cursor-pointer">
                                            <input type="checkbox" name="brands[]" value="{{ $brand }}" 
                                                   {{ in_array($brand, request('brands', [])) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 mr-2.5 h-4 w-4 transition">
                                            {{ $brand }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- RAM Range (Min/Max Select) -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Kapasitas RAM</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Min RAM</span>
                                    <select name="min_ram" class="block w-full mt-1 bg-slate-50 border-slate-200 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg text-xs font-medium transition py-2">
                                        <option value="">Semua</option>
                                        <option value="8" {{ request('min_ram') == '8' ? 'selected' : '' }}>8 GB</option>
                                        <option value="16" {{ request('min_ram') == '16' ? 'selected' : '' }}>16 GB</option>
                                        <option value="32" {{ request('min_ram') == '32' ? 'selected' : '' }}>32 GB</option>
                                    </select>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Max RAM</span>
                                    <select name="max_ram" class="block w-full mt-1 bg-slate-50 border-slate-200 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg text-xs font-medium transition py-2">
                                        <option value="">Semua</option>
                                        <option value="8" {{ request('max_ram') == '8' ? 'selected' : '' }}>8 GB</option>
                                        <option value="16" {{ request('max_ram') == '16' ? 'selected' : '' }}>16 GB</option>
                                        <option value="32" {{ request('max_ram') == '32' ? 'selected' : '' }}>32 GB</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Storage Range (Min/Max Select) -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Penyimpanan SSD</label>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Min Storage</span>
                                    <select name="min_storage" class="block w-full mt-1 bg-slate-50 border-slate-200 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg text-xs font-medium transition py-2">
                                        <option value="">Semua</option>
                                        <option value="256" {{ request('min_storage') == '256' ? 'selected' : '' }}>256 GB</option>
                                        <option value="512" {{ request('min_storage') == '512' ? 'selected' : '' }}>512 GB</option>
                                        <option value="1024" {{ request('min_storage') == '1024' ? 'selected' : '' }}>1 TB (1024GB)</option>
                                    </select>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Max Storage</span>
                                    <select name="max_storage" class="block w-full mt-1 bg-slate-50 border-slate-200 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-lg text-xs font-medium transition py-2">
                                        <option value="">Semua</option>
                                        <option value="256" {{ request('max_storage') == '256' ? 'selected' : '' }}>256 GB</option>
                                        <option value="512" {{ request('max_storage') == '512' ? 'selected' : '' }}>512 GB</option>
                                        <option value="1024" {{ request('max_storage') == '1024' ? 'selected' : '' }}>1 TB (1024GB)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Apply Button -->
                        <button type="submit" class="w-full py-3 bg-primary-600 text-white rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-primary-700 transition shadow-md shadow-primary-50 active:scale-95">
                            Terapkan Filter
                        </button>
                    </form>
                </aside>

                <!-- Right Column Products list -->
                <main class="lg:col-span-9">
                    <div class="flex items-center justify-between mb-8">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                            Menampilkan {{ $products->total() }} Laptops
                        </span>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse ($products as $product)
                            <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-100 hover:border-primary-100 hover:shadow-2xl hover:shadow-primary-50/50 transition-all duration-300 flex flex-col relative">
                                <!-- Media / Image area -->
                                <div class="relative h-56 overflow-hidden bg-slate-50">
                                    @if($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @elseif($product->videos->first() && $product->videos->first()->thumbnail_path)
                                        <img src="{{ asset('storage/' . $product->videos->first()->thumbnail_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                                            <svg class="w-12 h-12 text-slate-700 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="text-[10px] uppercase font-bold tracking-wider">No Image</span>
                                        </div>
                                    @endif
                                    


                                    @if($product->videos->count() > 0)
                                        <div class="absolute bottom-4 right-4">
                                            <span class="bg-rose-600/90 backdrop-blur-sm w-7 h-7 rounded-full text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm6.3-2.841A1.5 1.5 0 006 8.428v3.144a1.5 1.5 0 002.3 1.268l2.493-1.572a1.5 1.5 0 000-2.537L8.3 7.159z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content Area -->
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-sm font-black text-slate-900 group-hover:text-primary-600 transition-colors leading-tight mb-1 line-clamp-1">{{ $product->name }}</h3>
                                        <p class="text-slate-500 text-[11px] font-medium line-clamp-2 mb-3 leading-relaxed">{{ $product->description }}</p>
                                    </div>
                                    
                                    <!-- Bottom Info -->
                                    <div class="pt-3 border-t border-slate-50 flex items-center justify-between mt-auto">
                                        <div class="flex flex-col">
                                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-0.5">Harga</span>
                                            <span class="text-sm font-black text-slate-900 leading-none">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-primary-600 flex items-center gap-0.5 group-hover:translate-x-0.5 transition-transform">
                                            Detail
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full py-20 text-center bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-100 flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 mb-4">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h4 class="text-lg font-black text-slate-800 uppercase tracking-tight">Laptop Tidak Ditemukan</h4>
                                <p class="text-slate-400 mt-1 italic text-xs">Coba cari kata kunci lain atau sesuaikan filter pencarian Anda.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                </main>

            </div>
        </div>
    </div>

    <!-- Styles for Double range slider thumbs -->
    <style>
        .double-range-slider-input-min, .double-range-slider-input-max {
            pointer-events: none;
        }
        .double-range-slider-input-min::-webkit-slider-thumb, .double-range-slider-input-max::-webkit-slider-thumb {
            pointer-events: auto;
            appearance: none;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #f15a24;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
            position: relative;
            z-index: 30;
        }
        .double-range-slider-input-min::-moz-range-thumb, .double-range-slider-input-max::-moz-range-thumb {
            pointer-events: auto;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #f15a24;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
            position: relative;
            z-index: 30;
        }
    </style>
</x-app-layout>
