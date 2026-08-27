@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'required' => false,
    'errorName' => null,
])

@php
    $errorKey = $errorName ?? $name;
    // Clean array input names for error retrieval: title[vi] -> title.vi
    $errorKey = str_replace(['[', ']'], ['.', ''], $errorKey);
    $errorKey = rtrim($errorKey, '.');
@endphp

<div {{ $attributes->merge(['class' => 'mb-4']) }}>
    @if($label)
        <label for="{{ $name }}" class="block mb-2 text-sm font-semibold text-gray-900">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->class([
                'block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border focus:ring-primary focus:border-primary focus:outline-none transition-colors',
                'border-red-300 focus:ring-red-500 focus:border-red-500' => $errors->has($errorKey),
                'border-gray-300' => !$errors->has($errorKey),
            ]) }}
            @required($required)
        >{{ old($name, $value) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            {{ $attributes->class([
                'block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border focus:ring-primary focus:border-primary focus:outline-none transition-colors',
                'border-red-300 focus:ring-red-500 focus:border-red-500' => $errors->has($errorKey),
                'border-gray-300' => !$errors->has($errorKey),
            ]) }}
            @required($required)
        >
    @endif

    @error($errorKey)
        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
