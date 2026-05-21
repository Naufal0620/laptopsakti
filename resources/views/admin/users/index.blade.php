@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-orange-600 text-white rounded-md text-xs font-bold uppercase tracking-widest hover:bg-orange-700 shadow-md">Tambah User</a>
    </div>
@endsection

@section('content')
<div class="mb-6 flex flex-wrap justify-between items-center gap-4">
    <div class="flex gap-2">
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 {{ !request('role') ? 'ring-2 ring-orange-500' : '' }}">
            Semua
        </a>
        @foreach(['admin', 'customer', 'courier'] as $role)
            <a href="{{ route('admin.users.index', ['role' => $role]) }}" 
               class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 {{ request('role') === $role ? 'ring-2 ring-orange-500' : '' }}">
                {{ ucfirst($role) }}
            </a>
        @endforeach
    </div>

    <form action="{{ route('admin.users.index') }}" method="GET" class="flex w-full md:w-auto">
        <input type="hidden" name="role" value="{{ request('role') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau HP..." class="w-full md:w-64 border-gray-300 rounded-l-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-r-md hover:bg-gray-900 transition text-sm">Cari</button>
    </form>
</div>

<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Kontak</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Terdaftar</th>
                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 font-bold uppercase mr-3">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <div>{{ $user->email }}</div>
                        <div class="text-xs text-gray-400">{{ $user->phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="text-xs border-gray-200 rounded p-1 bg-gray-50 focus:border-orange-500 focus:ring-0">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="courier" {{ $user->role === 'courier' ? 'selected' : '' }}>Courier</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold uppercase text-[10px] tracking-widest">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada user ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
