<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kurir') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pengiriman</div>
                    <div class="text-3xl font-black text-primary-600 leading-none">{{ $stats['pending_delivery'] }}</div>
                    <div class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Aktif</div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                    <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tugas</div>
                    <div class="text-3xl font-black text-green-600 leading-none">{{ $stats['completed_delivery'] }}</div>
                    <div class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Selesai</div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                Tugas Anda
                <span class="ml-2 px-2 py-0.5 bg-primary-100 text-primary-600 text-[10px] font-black rounded-full uppercase tracking-widest">Baru</span>
            </h3>

            <div class="space-y-4">
                @forelse($assigned_orders as $order)
                <a href="{{ route('courier.orders.show', $order) }}" class="block bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:border-primary-200 transition-all active:scale-98 group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">ID PESANAN</span>
                            <span class="font-black text-gray-900 text-lg group-hover:text-primary-600 transition">#ORD-{{ $order->id }}</span>
                        </div>
                        <span class="px-3 py-1 text-[10px] font-black rounded-full uppercase tracking-widest
                            @if($order->status === 'shipped') bg-primary-50 text-primary-600
                            @elseif($order->status === 'completed') bg-green-50 text-green-600
                            @endif">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="flex items-start space-x-3 mb-4">
                        <div class="mt-1 w-5 h-5 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tujuan Pengiriman</div>
                            <p class="text-sm text-gray-700 leading-snug line-clamp-2">{{ $order->delivery_address }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ $order->user->name }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-black text-primary-500">{{ $order->distance_km }} KM</span>
                            <div class="p-1.5 bg-primary-50 text-primary-600 rounded-lg group-hover:bg-primary-500 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Santai Dulu!</h4>
                    <p class="text-gray-500 text-sm italic leading-relaxed">Belum ada tugas pengiriman untuk Anda saat ini.</p>
                </div>
                @endforelse
            </div>

            @if($assigned_orders->hasPages())
                <div class="mt-8">
                    {{ $assigned_orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
