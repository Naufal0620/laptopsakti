@extends('layouts.admin')

@section('header')
    {{ __('Manajemen Kupon') }}
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

@section('floating_button')
    <a href="{{ route('admin.coupons.create') }}" class="fixed bottom-8 right-8 w-14 h-14 bg-primary-600 text-white rounded-full flex items-center justify-center shadow-2xl hover:bg-primary-700 hover:scale-110 transition-all duration-300 z-50 group" title="Tambah Kupon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 transition-transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
        </svg>
    </a>
@endsection
