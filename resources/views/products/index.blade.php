<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-slate-950 text-white overflow-hidden border-b border-slate-900 py-16 sm:py-24">
        <!-- Tech glowing lines & abstract auras -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-primary-600/10 blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-primary-500/10 blur-[130px]"></div>
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Text Area -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 text-primary-300 text-xs font-bold uppercase tracking-widest animate-fade-in-down">
                        ⚡ Ditenagai Performa Sakti & Bergaransi Resmi
                    </div>
                    
                    <h1 class="text-4xl sm:text-6xl font-black tracking-tight leading-[1.05] text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-primary-300">
                        Rajanya Laptop <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 via-orange-400 to-primary-300">Spesifikasi Sakti</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Temukan jajaran laptop premium terbaik untuk Gaming, Kreator, Bisnis, hingga kebutuhan harian Anda. Hubungi admin via WhatsApp untuk konsultasi dan pembelian instan.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#produk-list" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:from-primary-500 hover:to-primary-400 transition-all shadow-xl shadow-primary-950/50 hover:scale-[1.02] text-center">
                            Mulai Belanja
                        </a>
                        <a href="{{ route('explore') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-slate-200 border border-slate-800 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-800 transition-all text-center flex items-center justify-center gap-2 hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Explore Video Review
                        </a>
                    </div>
                </div>

                <!-- Showcase Image Area -->
                <div class="lg:col-span-5 relative hidden lg:block">
                    <div class="relative w-full aspect-square flex items-center justify-center">
                        <!-- Orbiting tech shapes -->
                        <div class="absolute w-72 h-72 rounded-full border border-primary-500/10 animate-spin" style="animation-duration: 15s;"></div>
                        <div class="absolute w-96 h-96 rounded-full border border-primary-400/5 animate-spin" style="animation-duration: 25s; animation-direction: reverse;"></div>
                        
                        <!-- Floating specs banner -->
                        <div class="absolute top-10 right-2 bg-slate-900/90 backdrop-blur-md p-4 rounded-2xl border border-slate-800 shadow-2xl z-20 animate-bounce-slow">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-primary-500/10 flex items-center justify-center text-primary-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Garansi</p>
                                    <p class="text-xs font-black text-white leading-none">100% Resmi</p>
                                </div>
                            </div>
                        </div>

                        <!-- Main visual mockup -->
                        <div class="relative w-4/5 aspect-[4/3] bg-gradient-to-b from-primary-950/40 to-slate-950/20 p-4 rounded-3xl border border-primary-500/20 shadow-2xl overflow-hidden group">
                            <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Laptop Premium" class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Catalogue Section -->
    <div class="py-16 bg-slate-50 min-h-screen" id="produk-list">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Quick Category Filters & Search -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-100 border border-slate-100 mb-12">
                <h2 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-primary-600 rounded-full"></span>
                    Cari & Filter Laptop
                </h2>
                
                <form action="{{ route('home') }}" method="GET" id="filter-form" class="space-y-6">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search Box -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search-input" placeholder="Cari tipe laptop (ASUS ROG, MacBook, ThinkPad, i5, RTX)..." value="{{ request('search') }}" class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-slate-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium transition-all" />
                        </div>
                        
                        <!-- Price Filters -->
                        <div class="flex gap-3">
                            <div class="relative flex-1 md:w-40">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-xs font-bold">Rp</span>
                                <input type="number" name="min_price" placeholder="Harga Min" value="{{ request('min_price') }}" class="block w-full pl-9 pr-4 py-4 bg-slate-50 border-slate-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium transition-all" />
                            </div>
                            <div class="relative flex-1 md:w-40">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-xs font-bold">Rp</span>
                                <input type="number" name="max_price" placeholder="Harga Max" value="{{ request('max_price') }}" class="block w-full pl-9 pr-4 py-4 bg-slate-50 border-slate-100 focus:bg-white focus:border-primary-500 focus:ring-primary-500 rounded-2xl shadow-sm text-sm font-medium transition-all" />
                            </div>
                            
                            <button type="submit" class="px-8 py-4 bg-slate-900 text-white font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-primary-100 active:scale-95">
                                Filter
                            </button>
                        </div>
                    </div>

                    <!-- Category Pills (Interactive tags) -->
                    <div class="pt-2">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Rekomendasi Kategori:</p>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $categories = [
                                    ['label' => 'Semua Laptop', 'query' => ''],
                                    ['label' => 'ROG & Gaming', 'query' => 'gaming'],
                                    ['label' => 'MacBook Air', 'query' => 'macbook'],
                                    ['label' => 'ThinkPad & Business', 'query' => 'thinkpad'],
                                    ['label' => 'Layar OLED', 'query' => 'oled'],
                                    ['label' => 'Intel Core i5', 'query' => 'i5'],
                                    ['label' => 'Ryzen 9', 'query' => 'ryzen 9'],
                                ];
                            @endphp
                            @foreach($categories as $cat)
                                <button type="button" 
                                        onclick="applyCategoryFilter('{{ $cat['query'] }}')"
                                        class="px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider border transition-all duration-200 
                                               {{ (request('search') == $cat['query'] && ($cat['query'] != '' || request('search') == '')) ? 'bg-primary-600 text-white border-primary-600 shadow-md shadow-primary-100' : 'bg-slate-50 text-slate-600 border-slate-100 hover:bg-slate-100 hover:border-slate-200' }}">
                                    {{ $cat['label'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    @php
                        // Dynamically determine category & tags from description
                        $descLower = strtolower($product->description);
                        $categoryTag = 'Standard';
                        $specBadge = 'Sakti';
                        $specBadgeBg = 'bg-slate-50 text-slate-600 border-slate-100';
                        
                        if (str_contains($descLower, 'gaming') || str_contains($descLower, 'rtx') || str_contains($descLower, 'ryzen 9')) {
                            $categoryTag = 'Gaming';
                            $specBadge = 'Extreme Spec';
                            $specBadgeBg = 'bg-red-50 text-red-600 border-red-100';
                        } elseif (str_contains($descLower, 'thinkpad') || str_contains($descLower, 'bisnis') || str_contains($descLower, 'keamanan')) {
                            $categoryTag = 'Business';
                            $specBadge = 'Enterprise';
                            $specBadgeBg = 'bg-primary-50 text-primary-600 border-primary-100';
                        } elseif (str_contains($descLower, 'macbook') || str_contains($descLower, 'oled') || str_contains($descLower, 'retina')) {
                            $categoryTag = 'Creator';
                            $specBadge = 'Pro Display';
                            $specBadgeBg = 'bg-purple-50 text-purple-600 border-purple-100';
                        } elseif (str_contains($descLower, 'harian') || str_contains($descLower, 'pelajar') || str_contains($descLower, 'pavilion')) {
                            $categoryTag = 'Student/Daily';
                            $specBadge = 'Best Value';
                            $specBadgeBg = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                        }
                    @endphp

                    <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-100 hover:border-primary-100 hover:shadow-2xl hover:shadow-primary-50/50 transition-all duration-300 flex flex-col relative">
                        <!-- Top Image / Media Area -->
                        <div class="relative h-52 overflow-hidden bg-slate-900">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($product->videos->first() && $product->videos->first()->thumbnail_path)
                                <img src="{{ asset('storage/' . $product->videos->first()->thumbnail_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                                    <svg class="w-16 h-16 text-slate-700 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs uppercase font-bold tracking-wider">No Image</span>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-1.5">
                                <span class="bg-primary-600/90 backdrop-blur-sm px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest text-white shadow-sm">Ready Stock</span>
                                <span class="bg-slate-900/80 backdrop-blur-sm px-2.5 py-0.5 rounded-md text-[8px] font-bold uppercase tracking-wider text-slate-300 border border-slate-800">{{ $categoryTag }}</span>
                            </div>

                            @if($product->videos->count() > 0)
                                <div class="absolute bottom-4 right-4">
                                    <span class="bg-rose-600/90 backdrop-blur-sm p-2 rounded-full text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168l4.74 3.555a.5.5 0 010 .893l-4.74 3.556A.5.5 0 019 14.721V7.279a.5.5 0 01.755-.432z" />
                                        </svg>
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Specs Badge -->
                            <div class="mb-2">
                                <span class="inline-block px-2.5 py-0.5 rounded text-[9px] font-black uppercase tracking-widest border {{ $specBadgeBg }}">
                                    {{ $specBadge }}
                                </span>
                            </div>
                            
                            <h3 class="text-base font-black text-slate-900 group-hover:text-primary-600 transition-colors leading-tight mb-2 line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-slate-500 text-xs font-medium line-clamp-3 mb-4 leading-relaxed flex-1">{{ $product->description }}</p>
                            
                            <!-- Bottom Info -->
                            <div class="pt-4 flex items-center justify-between border-t border-slate-50 mt-auto">
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Harga Sakti</span>
                                    <span class="text-lg font-black text-slate-900 leading-none">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <span class="text-xs font-bold text-primary-600 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                    Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100 flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 mb-4">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-black text-slate-800 uppercase tracking-tight">Laptop Tidak Ditemukan</h4>
                        <p class="text-slate-400 mt-1 italic text-sm">Coba cari kata kunci lain atau bersihkan filter pencarian.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Category Filter Script -->
    <script>
        function applyCategoryFilter(query) {
            document.getElementById('search-input').value = query;
            document.getElementById('filter-form').submit();
        }
    </script>

    <style>
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .animate-fade-in-down {
            animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-bounce-slow {
            animation: bounceSlow 3s infinite ease-in-out;
        }
    </style>
</x-app-layout>
