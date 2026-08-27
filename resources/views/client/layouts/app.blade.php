<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    <link rel="stylesheet" href="{{ asset('build/assets/builder.css') }}">
    <style>
        body {
            font-family: 'Quicksand', sans-serif !important;
        }
    </style>
    @yield('styles')
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</head>
<body class="bg-white text-gray-900 antialiased">
    @yield('content')

    @include('client.partials.admin-bar')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.product-tabs-bar .tab-btn');
            if (!btn) return;
            e.preventDefault();
            
            const container = btn.closest('[data-page-block="product-tabs"]');
            if (!container) return;
            
            container.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const tab = btn.getAttribute('data-tab');
            container.querySelectorAll('.premium-product-card').forEach(card => {
                if (tab === 'all' || card.getAttribute('data-cat') === tab) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    </script>
</body>
</html>
