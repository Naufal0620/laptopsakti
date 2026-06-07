<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - Nikmati Kuliner UMKM Terbaik</title>
        <link rel="icon" href="{{ asset('images/logos/kulivio_logo.svg') }}" type="image/svg+xml">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-white font-sans text-gray-900 overflow-x-hidden">
        <!-- Floating Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 px-6 py-6 transition-all" x-data="{ atTop: true }" @scroll.window="atTop = (window.pageYOffset > 50 ? false : true)" :class="{ 'bg-white/80 backdrop-blur-xl shadow-sm py-4': !atTop }">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <x-application-logo class="w-10 h-10 text-primary-600" />
                    <span class="font-black text-2xl tracking-tighter">{{ config('app.name') }}</span>
                </div>
                <div class="hidden md:flex items-center space-x-8 text-sm font-bold uppercase tracking-widest text-gray-500">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 transition">Katalog</a>
                    <a href="{{ route('explore') }}" class="hover:text-primary-600 transition text-primary-600">Explore</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-primary-600 transition">Pesanan</a>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-primary-600 transition">Masuk</a>
                    @endauth
                </div>
                <a href="{{ route('explore') }}" class="bg-primary-600 text-white px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-700 transition shadow-lg shadow-primary-100">
                    Mulai Belanja
                </a>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center pt-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="relative z-10 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-50 rounded-full text-primary-600 text-[10px] font-black uppercase tracking-widest animate-fade-in-down">
                        🚀 Platform Kuliner UMKM Masa Depan
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-gray-900 leading-[1.1] tracking-tighter animate-fade-in">
                        Rasakan Sensasi <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-orange-400">Belanja Visual</span> <br>
                        Kuliner Lokal.
                    </h1>
                    <p class="text-lg text-gray-500 font-medium max-w-lg mx-auto lg:mx-0 leading-relaxed animate-fade-in delay-200">
                        Pertama di Indonesia. Temukan kelezatan UMKM melalui video pendek interaktif. Pesan sekarang, nikmati kesegarannya nanti.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 animate-fade-in delay-300">
                        <a href="{{ route('explore') }}" class="w-full sm:w-auto px-10 py-5 bg-gray-900 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-black transition shadow-2xl shadow-gray-200 flex items-center justify-center group">
                            Coba Explore
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-gray-900 border border-gray-100 rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-gray-50 transition flex items-center justify-center">
                            Lihat Katalog
                        </a>
                    </div>
                </div>

                <!-- Abstract Visual -->
                <div class="relative hidden lg:block animate-fade-in-right">
                    <div class="relative w-full aspect-square">
                        <div class="absolute top-0 right-0 w-4/5 h-4/5 bg-primary-100 rounded-[3rem] rotate-6 opacity-50"></div>
                        <div class="absolute bottom-0 left-0 w-4/5 h-4/5 bg-orange-50 rounded-[4rem] -rotate-12 opacity-50"></div>
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="absolute inset-10 w-4/5 h-4/5 object-cover rounded-[3.5rem] shadow-2xl z-10 border-8 border-white">
                        
                        <!-- Floating Info -->
                        <div class="absolute top-20 -left-10 bg-white p-4 rounded-2xl shadow-xl z-20 animate-bounce-slow">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Freshly Made</p>
                                    <p class="text-xs font-bold text-gray-900 leading-none">100% Homemade</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 hidden md:block">
                <div class="w-6 h-10 border-2 border-gray-100 rounded-full flex justify-center p-1">
                    <div class="w-1.5 h-1.5 bg-primary-500 rounded-full animate-scroll-down"></div>
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
    </body>
</html>
