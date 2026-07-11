<x-app-layout>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center pt-20 pb-28 md:pb-36 overflow-hidden bg-gradient-to-b from-slate-50 to-white">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="relative z-10 space-y-8 text-center lg:text-left lg:col-span-7">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-50 border border-primary-100 rounded-full text-primary-600 text-[10px] font-black uppercase tracking-widest animate-fade-in-down">
                        🚀 Platform Review & Katalog Laptop Masa Depan
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-gray-900 leading-[1.1] tracking-tighter animate-fade-in">
                        Temukan Laptop <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-orange-400">Spesifikasi Sakti</span> <br>
                        Pilihan Anda.
                    </h1>
                    <p class="text-lg text-gray-500 font-medium max-w-lg mx-auto lg:mx-0 leading-relaxed animate-fade-in delay-200">
                        Pertama di Indonesia. Temukan laptop premium idaman Anda melalui video pendek interaktif and katalog berspesifikasi detail. Hubungi admin via WhatsApp untuk konsultasi gratis.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 animate-fade-in delay-300">
                        <a href="{{ route('explore') }}" class="w-full sm:w-auto px-10 py-5 bg-gray-950 text-white rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-black transition shadow-xl shadow-gray-200 flex items-center justify-center group">
                            Coba Explore
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-gray-900 border border-gray-200 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-gray-50 transition flex items-center justify-center">
                            Lihat Katalog
                        </a>
                    </div>
                </div>

                <!-- Abstract Visual -->
                <div class="relative hidden lg:block lg:col-span-5 animate-fade-in-right">
                    <div class="relative w-full aspect-square">
                        <div class="absolute top-0 right-0 w-4/5 h-4/5 bg-primary-100/50 rounded-3xl rotate-6 opacity-40"></div>
                        <div class="absolute bottom-0 left-0 w-4/5 h-4/5 bg-orange-50/50 rounded-3xl -rotate-12 opacity-40"></div>
                        <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="absolute inset-8 w-4/5 h-4/5 object-cover rounded-2xl shadow-2xl z-10 border border-slate-100">
                        
                        <!-- Floating Info -->
                        <div class="absolute top-20 -left-6 bg-white p-4 rounded-xl shadow-xl z-20 border border-slate-150 animate-bounce-slow">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Garansi Resmi</p>
                                    <p class="text-xs font-bold text-gray-900 leading-none">100% Original</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-6 md:bottom-8 left-1/2 -translate-x-1/2 hidden md:block">
                <div class="w-6 h-10 border-2 border-gray-200 rounded-full flex justify-center p-1">
                    <div class="w-1.5 h-1.5 bg-primary-500 rounded-full animate-scroll-down"></div>
                </div>
            </div>
        </section>

        <!-- Best Sellers Catalogue Section -->
        <section class="py-24 bg-slate-50 border-t border-slate-100" id="katalog">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Section Header -->
                <div class="text-center mb-16 space-y-4">
                    <span class="px-4 py-1.5 rounded-full bg-primary-50 border border-primary-100 text-primary-600 text-xs font-black uppercase tracking-widest">
                        🔥 Produk Terlaris
                    </span>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tight leading-tight">
                        Laptop Terfavorit Pilihan Konsumen
                    </h2>
                    <p class="text-slate-500 font-medium max-w-lg mx-auto text-sm md:text-base">
                        Jajaran laptop berspesifikasi sakti dengan angka penjualan tertinggi. Dapatkan performa maksimal dengan penawaran terbaik.
                    </p>
                </div>

                <!-- Product Grid (8 items) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <a href="{{ route('products.show', $product) }}" class="group bg-white rounded-3xl overflow-hidden border border-slate-100 hover:border-primary-100 hover:shadow-2xl hover:shadow-primary-50/50 transition-all duration-300 flex flex-col relative">
                            <!-- Top Image Area -->
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
                    @endforeach
                </div>

                <!-- Call to Action (See all products) -->
                <div class="mt-16 text-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-gray-950 hover:bg-black text-white rounded-xl font-bold text-sm uppercase tracking-widest transition shadow-xl hover:shadow-2xl hover:translate-y-[-1px] active:scale-95 group">
                        Lihat Semua Produk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <style>
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes fadeInRight { from { opacity: 0; transform: translateX(50px); } to { opacity: 1; transform: translateX(0); } }
            @keyframes scrollDown { 0% { transform: translateY(0); opacity: 1; } 100% { transform: translateY(20px); opacity: 0; } }
            @keyframes bounceSlow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

            .animate-fade-in { animation: fadeIn 1s ease-out forwards; }
            .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
            .animate-fade-in-right { animation: fadeInRight 1.5s ease-out forwards; }
            .animate-scroll-down { animation: scrollDown 1.5s infinite; }
            .animate-bounce-slow { animation: bounceSlow 3s infinite ease-in-out; }
            .delay-200 { animation-delay: 0.2s; }
            .delay-300 { animation-delay: 0.4s; }
        </style>
</x-app-layout>
