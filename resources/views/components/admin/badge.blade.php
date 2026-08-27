@props([
    'variant' => 'info',
])

@php
    $baseClasses = 'inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-semibold';
    
    $variants = [
        'info' => 'bg-blue-100 text-blue-800',
        'success' => 'bg-emerald-100 text-emerald-800',
        'warning' => 'bg-amber-100 text-amber-800',
        'danger' => 'bg-red-100 text-red-800',
        'secondary' => 'bg-gray-100 text-gray-800',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['info']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
