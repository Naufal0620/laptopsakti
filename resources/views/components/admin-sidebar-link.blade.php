@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-3 text-sm font-black text-primary-600 bg-primary-50 rounded-xl transition-all duration-200'
            : 'flex items-center p-3 text-sm font-bold text-gray-500 hover:text-primary-600 rounded-xl hover:bg-gray-50 transition-all duration-200 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if(isset($icon))
        <svg class="w-5 h-5 mr-3 {{ ($active ?? false) ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-600' }} transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
        </svg>
    @endif
    {{ $slot }}
</a>
