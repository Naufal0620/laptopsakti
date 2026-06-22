<x-app-layout>
    <!-- PHP Helper for Spec Parsing -->
    @php
        $descLower = strtolower($product->description);
        
        // Parse CPU
        $cpu = 'Intel / AMD / Apple Silicon';
        if (str_contains($descLower, 'ryzen 9')) $cpu = 'AMD Ryzen 9';
        elseif (str_contains($descLower, 'ryzen 7')) $cpu = 'AMD Ryzen 7';
        elseif (str_contains($descLower, 'core i5')) $cpu = 'Intel Core i5';
        elseif (str_contains($descLower, 'core i7')) $cpu = 'Intel Core i7';
        elseif (str_contains($descLower, 'm3')) $cpu = 'Apple M3 Chip';
        elseif (str_contains($descLower, 'core ultra')) $cpu = 'Intel Core Ultra';
        elseif (str_contains($descLower, 'evo')) $cpu = 'Intel Core Evo';
        
        // Parse RAM
        $ram = '8GB / 16GB LPDDR5';
        if (str_contains($descLower, 'ram 16gb') || str_contains($descLower, '16gb')) $ram = '16GB LPDDR5 / DDR5';
        elseif (str_contains($descLower, 'ram 8gb') || str_contains($descLower, '8gb')) $ram = '8GB LPDDR5';
        elseif (str_contains($descLower, 'ram 32gb') || str_contains($descLower, '32gb')) $ram = '32GB LPDDR5 High Speed';

        // Parse Storage
        $storage = '512GB NVMe SSD';
        if (str_contains($descLower, '1tb') || str_contains($descLower, '1 tb')) $storage = '1TB NVMe PCIe SSD';
        elseif (str_contains($descLower, '256gb')) $storage = '256GB High-Speed SSD';

        // Parse GPU
        $gpu = 'Integrated Graphics';
        if (str_contains($descLower, 'rtx 4060')) $gpu = 'NVIDIA GeForce RTX 4060 (8GB)';
        elseif (str_contains($descLower, 'rtx 3050')) $gpu = 'NVIDIA GeForce RTX 3050 (4GB)';
        elseif (str_contains($descLower, 'rtx 4050')) $gpu = 'NVIDIA GeForce RTX 4050 (6GB)';
        elseif (str_contains($descLower, 'rtx')) $gpu = 'NVIDIA GeForce RTX Series';
        elseif (str_contains($descLower, 'radeon')) $gpu = 'AMD Radeon Graphics';
        elseif (str_contains($descLower, 'macbook') || str_contains($descLower, 'm3')) $gpu = 'Apple M3 Cores Integrated GPU';

        // Parse Screen
        $screen = '14" FHD IPS Display';
        if (str_contains($descLower, 'oled')) {
            if (str_contains($descLower, '2.8k')) $screen = '14" 2.8K OLED HDR Display';
            else $screen = '14" OLED Ultra-Vivid Screen';
        } elseif (str_contains($descLower, 'nebula')) $screen = '14" ROG Nebula HDR Display';
        elseif (str_contains($descLower, 'retina')) $screen = '13.6" Liquid Retina Display';
        elseif (str_contains($descLower, '13')) $screen = '13.3" Bezel-Less IPS Display';
    @endphp

    <div class="pb-32 sm:pb-20 bg-slate-50 min-h-screen">
        <!-- Back Button (Mobile Header) -->
        <div class="sm:hidden sticky top-0 z-30 bg-white/95 backdrop-blur-md px-4 py-4 flex items-center border-b border-slate-100 shadow-sm">
            <a href="{{ route('home') }}" class="p-2 -ml-2 text-slate-400 hover:text-primary-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="ml-2 font-black text-slate-900 tracking-tight">Detail Spesifikasi Laptop</h2>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 sm:pt-12">
            <!-- Breadcrumbs -->
            <div class="hidden sm:flex items-center space-x-2 text-xs font-bold uppercase tracking-wider text-slate-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Katalog</a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-500">{{ $product->name }}</span>
            </div>

            <!-- Product Main Card -->
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-100/50 p-6 sm:p-12 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    
                    <!-- Left Column: Media / Gallery -->
                    <div class="lg:col-span-6 space-y-6">
                        <div id="main-display-container" class="relative aspect-square sm:aspect-[4/3] bg-slate-950 rounded-3xl overflow-hidden shadow-xl border border-slate-900 group">
                            @php
                                $mainImage = $product->primaryImage ? asset('storage/' . $product->primaryImage->image_path) : (
                                    $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : (
                                        $product->videos->first() && $product->videos->first()->thumbnail_path ? asset('storage/' . $product->videos->first()->thumbnail_path) : null
                                    )
                                );
                            @endphp
                            @if($mainImage)
                                <img src="{{ $mainImage }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" id="main-display-img">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                                    <svg class="w-20 h-20 text-slate-800 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-xs uppercase font-black tracking-widest text-slate-600">Belum ada gambar</span>
                                </div>
                            @endif
                            
                            <!-- Glowing overlays -->
                            <div class="absolute top-6 left-6 flex flex-col gap-2">
                                <span class="bg-primary-600/90 backdrop-blur-sm text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg border border-primary-500/20">Spesifikasi Sakti</span>
                            </div>
                        </div>

                        <!-- Media Thumbnails Slider -->
                        @if($product->images->count() > 0 || $product->videos->count() > 0)
                            <div class="flex gap-4 overflow-x-auto pb-4 hide-scrollbar snap-x">
                                <!-- Videos -->
                                @foreach($product->videos as $video)
                                    <div class="relative w-24 h-24 flex-shrink-0 bg-slate-900 rounded-2xl cursor-pointer overflow-hidden border-2 border-transparent hover:border-primary-500 transition-all snap-start group" onclick="updateMainDisplay('{{ asset('storage/' . $video->video_path) }}', true)">
                                        @if($video->thumbnail_path)
                                            <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="w-full h-full object-cover opacity-60">
                                        @endif
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                            <div class="p-1.5 bg-white/20 backdrop-blur-md rounded-full text-white group-hover:scale-110 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168l4.74 3.555a.5.5 0 010 .893l-4.74 3.556A.5.5 0 019 14.721V7.279a.5.5 0 01.755-.432z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Images -->
                                @foreach($product->images as $image)
                                    <div class="w-24 h-24 flex-shrink-0 bg-slate-50 rounded-2xl cursor-pointer overflow-hidden border-2 border-transparent hover:border-primary-500 transition-all snap-start" onclick="updateMainDisplay('{{ asset('storage/' . $image->image_path) }}', false)">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Details & Actions -->
                    <div class="lg:col-span-6 flex flex-col justify-between">
                        <div>
                            <!-- Badges -->
                            <div class="flex flex-wrap items-center gap-2 mb-6">
                                <span class="inline-flex items-center px-3.5 py-1 rounded-full text-[10px] font-black bg-primary-50 text-primary-600 uppercase tracking-widest border border-primary-100">Original Laptop</span>
                                <span class="inline-flex items-center px-3.5 py-1 rounded-full text-[10px] font-black bg-emerald-50 text-emerald-600 uppercase tracking-widest border border-emerald-100">Garansi Resmi</span>
                                <span class="inline-flex items-center px-3.5 py-1 rounded-full text-[10px] font-black bg-slate-50 text-slate-500 uppercase tracking-widest border border-slate-100">Ready Stock</span>
                            </div>

                            <!-- Name & Price -->
                            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 leading-tight mb-4 tracking-tighter">{{ $product->name }}</h1>
                            
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-8">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Harga Spesial Sakti</p>
                                <p class="text-3xl sm:text-4xl font-black text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>

                            <!-- Laptop Specs Highlights (Icon Grid) -->
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <!-- Processor Info -->
                                <div class="flex items-center p-3 bg-white border border-slate-100 rounded-xl">
                                    <div class="p-2.5 bg-primary-50 text-primary-600 rounded-lg mr-3">
                                        <!-- CPU icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="4" y="4" width="16" height="16" rx="2" stroke-width="2" />
                                            <path d="M9 9h6v6H9z" stroke-width="2"/>
                                            <path d="M9 1v3M15 1v3M9 20v3M15 20v3M20 9h3M20 15h3M1 9h3M1 15h3" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Processor</p>
                                        <p class="text-xs font-black text-slate-800 leading-none truncate max-w-[120px]">{{ $cpu }}</p>
                                    </div>
                                </div>

                                <!-- RAM Info -->
                                <div class="flex items-center p-3 bg-white border border-slate-100 rounded-xl">
                                    <div class="p-2.5 bg-primary-50 text-primary-600 rounded-lg mr-3">
                                        <!-- RAM icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="2" y="6" width="20" height="12" rx="2" stroke-width="2"/>
                                            <path d="M6 6v12M10 6v12M14 6v12M18 6v12" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">RAM Memory</p>
                                        <p class="text-xs font-black text-slate-800 leading-none truncate max-w-[120px]">{{ $ram }}</p>
                                    </div>
                                </div>

                                <!-- Storage Info -->
                                <div class="flex items-center p-3 bg-white border border-slate-100 rounded-xl">
                                    <div class="p-2.5 bg-primary-50 text-primary-600 rounded-lg mr-3">
                                        <!-- HDD/SSD icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="2"/>
                                            <circle cx="8" cy="8" r="1.5" fill="currentColor"/>
                                            <path d="M14 7h4M14 11h4M6 16h12" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Penyimpanan</p>
                                        <p class="text-xs font-black text-slate-800 leading-none truncate max-w-[120px]">{{ $storage }}</p>
                                    </div>
                                </div>

                                <!-- GPU Info -->
                                <div class="flex items-center p-3 bg-white border border-slate-100 rounded-xl">
                                    <div class="p-2.5 bg-primary-50 text-primary-600 rounded-lg mr-3">
                                        <!-- GPU icon -->
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="2"/>
                                            <path d="M7 12l3-3 4 6 3-3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Kartu Grafis</p>
                                        <p class="text-xs font-black text-slate-800 leading-none truncate max-w-[120px]">{{ $gpu }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="space-y-4 mb-8">
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                    Deskripsi Produk
                                </h3>
                                <p class="text-slate-600 leading-relaxed font-medium text-sm whitespace-pre-line">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                        <!-- Buy Action via WhatsApp -->
                        @php
                            $whatsappNumber = \App\Models\Setting::getValue('admin_whatsapp_number', '6285270110305');
                            $message = "Halo LaptopSakti! Saya tertarik untuk membeli laptop berikut:\n\n" .
                                       "💻 Laptop: " . $product->name . "\n" .
                                       "💵 Harga: Rp " . number_format($product->price, 0, ',', '.') . "\n\n" .
                                       "Apakah laptop ini masih tersedia?";
                            $waUrl = "https://wa.me/" . $whatsappNumber . "?text=" . rawurlencode($message);
                        @endphp

                        <!-- Desktop button -->
                        <div class="hidden sm:block">
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center py-4.5 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl font-black text-sm uppercase tracking-widest active:scale-95 transition-all shadow-lg hover:shadow-xl hover:shadow-primary-100 gap-3 hover:translate-y-[-1px]">
                                <!-- WhatsApp icon representation -->
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.864-9.864.002-2.637-1.03-5.118-2.905-6.993C16.458 1.87 13.987.84 11.36.84c-5.442 0-9.866 4.424-9.87 9.869-.001 1.702.463 3.361 1.34 4.8l-.997 3.646 3.734-.979zM15.82 12.9c-.22-.11-1.298-.64-1.5-.71-.2-.08-.35-.12-.5.1-.15.22-.58.73-.71.88-.13.15-.26.17-.48.06-.22-.11-.93-.34-1.77-1.09-.65-.58-1.09-1.3-1.22-1.51-.13-.22-.01-.33.1-.44.1-.1.22-.26.33-.39.11-.13.15-.22.22-.37.07-.15.03-.28-.02-.39-.05-.1-.49-1.18-.67-1.62-.17-.43-.35-.37-.48-.37H9.2c-.15 0-.4.06-.6.28-.2.22-.76.75-.76 1.83 0 1.08.79 2.13.9 2.28.11.15 1.55 2.37 3.76 3.32.53.22.94.36 1.26.46.53.17 1.01.14 1.39.09.42-.06 1.3-.53 1.48-1.04.18-.51.18-.95.13-1.04-.05-.09-.2-.15-.42-.26z"/>
                                </svg>
                                Hubungi Admin via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Purchase Bottom Bar (Mobile Only) -->
        <div class="sm:hidden fixed bottom-16 left-0 right-0 bg-white/90 backdrop-blur-xl border-t border-slate-100 p-4 z-40 shadow-lg">
            <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center py-4 bg-primary-600 hover:bg-primary-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-md gap-2 active:scale-95 transition-all">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.864-9.864.002-2.637-1.03-5.118-2.905-6.993C16.458 1.87 13.987.84 11.36.84c-5.442 0-9.866 4.424-9.87 9.869-.001 1.702.463 3.361 1.34 4.8l-.997 3.646 3.734-.979zM15.82 12.9c-.22-.11-1.298-.64-1.5-.71-.2-.08-.35-.12-.5.1-.15.22-.58.73-.71.88-.13.15-.26.17-.48.06-.22-.11-.93-.34-1.77-1.09-.65-.58-1.09-1.3-1.22-1.51-.13-.22-.01-.33.1-.44.1-.1.22-.26.33-.39.11-.13.15-.22.22-.37.07-.15.03-.28-.02-.39-.05-.1-.49-1.18-.67-1.62-.17-.43-.35-.37-.48-.37H9.2c-.15 0-.4.06-.6.28-.2.22-.76.75-.76 1.83 0 1.08.79 2.13.9 2.28.11.15 1.55 2.37 3.76 3.32.53.22.94.36 1.26.46.53.17 1.01.14 1.39.09.42-.06 1.3-.53 1.48-1.04.18-.51.18-.95.13-1.04-.05-.09-.2-.15-.42-.26z"/>
                </svg>
                Beli via WhatsApp (Fast Response)
            </a>
        </div>
    </div>

    <!-- Media Switcher JavaScript -->
    <script>
        function updateMainDisplay(source, isVideo) {
            const container = document.getElementById('main-display-container');
            if (isVideo) {
                container.innerHTML = `<video class="w-full h-full object-cover" controls autoplay muted loop><source src="${source}" type="video/mp4"></video>`;
            } else {
                container.innerHTML = `<img src="${source}" class="w-full h-full object-cover animate-fade-in" id="main-display-img">`;
            }
        }
    </script>

    <style>
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</x-app-layout>
