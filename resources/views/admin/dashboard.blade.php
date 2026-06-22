@extends('layouts.admin')

@section('header')
    Overview Dashboard LaptopSakti
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <!-- Stats Cards -->
    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-gray-50 rounded-2xl text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Laptop</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['total_products'] }}</div>
        <div class="mt-2 text-xs font-bold text-gray-400 italic">Laptop Terdaftar di Katalog</div>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-primary-50 rounded-2xl text-primary-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-primary-600 uppercase tracking-widest">Total Video</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['total_videos'] }}</div>
        <div class="mt-2 text-xs font-bold text-primary-500 italic">Video Review Produk</div>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Total Admin</span>
        </div>
        <div class="text-3xl font-black text-gray-900 leading-none">{{ $stats['total_admins'] }}</div>
        <div class="mt-2 text-xs font-bold text-blue-500 italic">Administrator Terdaftar</div>
    </div>
</div>

<div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm text-center">
    <h3 class="text-xl font-black text-gray-800 mb-2">Selamat Datang di Admin Panel LaptopSakti</h3>
    <p class="text-gray-500 max-w-xl mx-auto">Gunakan menu navigasi untuk mengelola data katalog laptop, video review produk, serta nomor WhatsApp penjual.</p>
</div>
@endsection
