@extends('layouts.app')

@section('title', $metaTitle ?: $title)
@section('meta_description', $metaDescription ?: '')

@section('styles')
@vite(['resources/css/builder.css'])
{{-- Elementor keeps each page's widget styling in its own post-<id>.css; without
     it headings fall back to the theme default and the page looks nothing like
     the public site. Derived from the markup, same as the builder canvas. --}}
@foreach(\App\Support\ThemeAssets::elementorStyles([$renderedHtml, $headerHtml, $footerHtml]) as $href)
<link rel="stylesheet" href="{{ $href }}">
@endforeach
<style id="client-page-css">
    *, *::before, *::after { box-sizing: border-box; }
    body { margin: 0; }
    img { max-width: 100%; }
    {!! $css !!}
</style>
@endsection

@section('content')
    <div id="client-page-{{ $page->id }}">
        {!! $renderedHtml !!}
    </div>
@endsection

@push('scripts')
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
@endpush
