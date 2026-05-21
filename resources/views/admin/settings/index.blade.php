@extends('layouts.admin')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Pengaturan Sistem') }}
    </h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        @foreach ($settings as $group => $items)
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden mb-8 border border-gray-100">
                <div class="p-6 border-b border-gray-200 bg-white">
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-widest">{{ $group }}</h3>
                </div>
                <div class="p-6 space-y-6">
                    @foreach ($items as $setting)
                        <div>
                            <x-input-label for="{{ $setting->key }}" :value="$setting->display_name" class="font-bold text-gray-700" />
                            <div class="mt-2">
                                @if ($setting->type === 'boolean')
                                    <select name="{{ $setting->key }}" id="{{ $setting->key }}" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                @elseif ($setting->type === 'integer')
                                    <x-text-input type="number" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}" class="block w-full" />
                                @else
                                    <x-text-input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}" class="block w-full" />
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-400 italic">ID: {{ $setting->key }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-end">
            <x-primary-button class="px-8 py-3">
                Simpan Semua Perubahan
            </x-primary-button>
        </div>
    </form>
</div>
@endsection
