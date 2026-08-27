@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-semibold rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';
    
    $variants = [
        'primary' => 'text-white bg-primary hover:bg-primary-hover active:bg-primary-active focus:ring-primary',
        'secondary' => 'text-gray-700 bg-gray-100 hover:bg-gray-200 active:bg-gray-300 focus:ring-gray-500',
        'outline' => 'text-gray-700 bg-transparent border border-gray-300 hover:bg-gray-50 active:bg-gray-100 focus:ring-gray-500',
        'danger' => 'text-white bg-red-600 hover:bg-red-700 active:bg-red-800 focus:ring-red-500',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-base',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
