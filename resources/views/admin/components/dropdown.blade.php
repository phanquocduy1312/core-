@props([
    'align' => 'right',
    'width' => '48',
])

@php
    $alignmentClasses = [
        'left' => 'left-0 origin-top-left',
        'right' => 'right-0 origin-top-right',
        'center' => 'left-1/2 -translate-x-1/2 origin-top',
    ][$align] ?? 'right-0 origin-top-right';

    $widthClasses = [
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
    ][$width] ?? 'w-48';
@endphp

<div
    x-data="{ open: false }"
    @click.away="open = false"
    @close.stop="open = false"
    class="relative inline-block text-left"
>
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClasses }} rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none {{ $alignmentClasses }}"
        style="display: none;"
    >
        <div class="py-1">
            {{ $content }}
        </div>
    </div>
</div>
