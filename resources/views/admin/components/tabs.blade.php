@props([
    'active',
])

<div
    x-data="{ activeTab: '{{ $active }}' }"
    class="w-full"
>
    <!-- Tab Headers -->
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-6" aria-label="Tabs">
            {{ $headers }}
        </nav>
    </div>

    <!-- Tab Contents -->
    <div class="mt-4">
        {{ $contents }}
    </div>
</div>
