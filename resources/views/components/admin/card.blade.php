@props([
    'title' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden']) }}>
    @if($title || isset($header))
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            @if(isset($header))
                {{ $header }}
            @else
                <h3 class="text-lg font-bold text-gray-800">{{ $title }}</h3>
            @endif
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex items-center justify-end gap-3">
            {{ $footer }}
        </div>
    @endif
</div>
