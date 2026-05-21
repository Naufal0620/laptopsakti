@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Tambah Produk
        </a>
    </div>
@endsection

@section('content')
<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Harga Dasar</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Diskon</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">PO</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ $product->name }}</div>
                        <div class="text-xs text-gray-400">{{ Str::limit($product->description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($product->discount_type !== 'none')
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded">
                                {{ $product->discount_type === 'percentage' ? $product->discount_value . '%' : 'Rp ' . number_format($product->discount_value, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $product->pre_order_days }} Hari</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-bold rounded uppercase {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-gray-600 hover:text-gray-900 font-bold text-sm uppercase">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm uppercase" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50 border-t">
        {{ $products->links() }}
    </div>
</div>
@endsection
