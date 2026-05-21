<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="space-y-4">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex gap-4 relative overflow-hidden">
                            <!-- Product Image -->
                            <div class="w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden">
                                @if(Str::startsWith($details['image'], 'http'))
                                    <img src="{{ $details['image'] }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 flex flex-col justify-between py-1">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $details['name'] }}</h3>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-primary-50 text-primary-600 uppercase tracking-wide">
                                            PO {{ $details['pre_order_days'] }} Hari
                                        </span>
                                    </div>
                                    <div class="mt-2 text-primary-600 font-black text-xl">
                                        Rp {{ number_format($details['price'], 0, ',', '.') }}
                                    </div>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center justify-between mt-4">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-100">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="quantity" value="{{ $details['quantity'] - 1 }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-primary-600 transition" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                        </button>
                                        <span class="w-10 text-center font-bold text-gray-800">{{ $details['quantity'] }}</span>
                                        <button type="submit" name="quantity" value="{{ $details['quantity'] + 1 }}" class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-primary-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Floating Summary -->
                <div class="mt-8 sticky bottom-20 sm:bottom-6 bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-gray-500 text-sm font-bold uppercase tracking-widest">Total Bayar</div>
                        <div class="text-2xl font-black text-gray-900">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="{{ route('home') }}" class="flex-1 flex justify-center items-center py-4 bg-gray-50 text-gray-700 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-gray-100 transition">
                            Lanjut
                        </a>
                        <a href="{{ route('checkout.index') }}" class="flex-[2] flex justify-center items-center py-4 bg-primary-500 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 active:scale-95 transition shadow-lg shadow-primary-200">
                            Checkout
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center">
                    <div class="mb-8 flex justify-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Kosong</h3>
                    <p class="text-gray-500 mb-10">Sepertinya Anda belum memilih makanan lezat hari ini.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-primary-500 text-white rounded-xl font-black text-sm uppercase tracking-widest hover:bg-primary-600 transition shadow-lg shadow-primary-100">
                        Cari Makanan
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
