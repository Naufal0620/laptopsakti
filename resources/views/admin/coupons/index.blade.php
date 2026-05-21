@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kupon') }}
        </h2>
        <a href="{{ route('admin.coupons.create') }}" class="px-4 py-2 bg-orange-600 text-white rounded-md text-xs font-bold uppercase tracking-widest hover:bg-orange-700 shadow-md">Tambah Kupon</a>
    </div>
@endsection

@section('content')
<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nilai</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Masa Berlaku</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $coupon->code }}</td>
                    <td class="px-6 py-4 text-gray-600 uppercase text-xs">{{ $coupon->type }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        @if($coupon->type === 'percentage')
                            {{ $coupon->value }}% (Maks: Rp {{ number_format($coupon->max_discount, 0, ',', '.') }})
                        @else
                            Rp {{ number_format($coupon->value, 0, ',', '.') }}
                        @endif
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">
                        {{ $coupon->start_date ? $coupon->start_date->format('d/m/y') : '∞' }} - 
                        {{ $coupon->end_date ? $coupon->end_date->format('d/m/y') : '∞' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($coupon->is_active)
                            <span class="px-2 py-1 text-[10px] font-bold rounded uppercase bg-green-100 text-green-800">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-[10px] font-bold rounded uppercase bg-red-100 text-red-800">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-blue-600 hover:text-blue-900 font-bold uppercase text-[10px] tracking-widest">Edit</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Hapus kupon ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold uppercase text-[10px] tracking-widest">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada kupon yang dibuat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($coupons->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $coupons->links() }}
        </div>
    @endif
</div>
@endsection
