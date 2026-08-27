@php
    $currentLocale = app()->getLocale();
    $locales = app(\App\Services\LanguageRegistry::class)->admin();
    $segments = request()->segments();
    $flags = [
        'vi' => 'admin-assets/images/flag/Flag_of_Vietnam.svg.png',
        'en' => 'admin-assets/images/flag/icon-flag-en.svg',
    ];

    if ($segments && $locales->contains('code', $segments[0])) {
        array_shift($segments);
    }
@endphp

@if($locales->count() > 1)
    <x-admin.dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center justify-center p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none" title="{{ __('admin.language') }}">
                <img src="{{ asset($flags[$currentLocale] ?? $flags['vi']) }}"
                     alt="{{ $locales->firstWhere('code', $currentLocale)?->native_name ?? $currentLocale }}"
                     class="w-5 h-5 rounded-full object-cover">
            </button>
        </x-slot>
        <x-slot name="content">
            @foreach($locales as $language)
                @php($localeCode = $language->code)
                <a rel="alternate"
                   hreflang="{{ $localeCode }}"
                   href="{{ url(trim($localeCode.'/'.implode('/', $segments), '/')) }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors {{ $currentLocale === $localeCode ? 'bg-red-50 font-semibold text-primary' : '' }}">
                    <img src="{{ asset($language->flag_path ?: ($flags[$localeCode] ?? $flags['vi'])) }}"
                         alt="{{ $language->native_name }}"
                         class="w-5 h-5 rounded-full object-cover">
                    <span>{{ $language->native_name }}</span>
                </a>
            @endforeach
        </x-slot>
    </x-admin.dropdown>
@endif
