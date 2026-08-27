@props([
    'variant' => 'info',
    'dismissible' => false,
])

@php
    $baseClasses = 'p-4 rounded-lg flex items-start gap-3 border text-sm';

    $variants = [
        'info' => 'bg-blue-50 border-blue-200 text-blue-800',
        'success' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
        'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
        'danger' => 'bg-red-50 border-red-200 text-red-800',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['info']);
@endphp

<div
    @if($dismissible)
        x-data="{ show: true }"
        x-show="show"
        x-transition
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
    role="alert"
>
    <div class="flex-grow">
        {{ $slot }}
    </div>

    @if($dismissible)
        <button
            type="button"
            class="inline-flex items-center justify-center p-1 rounded-md text-current hover:bg-black hover:bg-opacity-10 focus:outline-none"
            @click="show = false"
        >
            <span class="sr-only">Close alert</span>
            <span aria-hidden="true" class="text-lg leading-none">&times;</span>
        </button>
    @endif
</div>
