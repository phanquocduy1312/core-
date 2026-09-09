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
        // Mobile / Touch interaction for Elementor Flip Boxes
        document.body.addEventListener('click', function(e) {
            const flipBox = e.target.closest('.elementor-flip-box');
            if (!flipBox) return;
            if (e.target.closest('.elementor-flip-box__button')) return;
            if (window.innerWidth <= 1024) {
                flipBox.classList.toggle('is-flipped');
            }
        });
    });
    </script>
    @if(str_contains($renderedHtml, 'lux-carousel'))
        <link rel="stylesheet" href="/wp-content/plugins/custom-lux/assets/custom.css">
        <script src="/wp-content/plugins/custom-lux/assets/TweenLite.min.js"></script>
        <script src="/wp-content/plugins/custom-lux/assets/imagesloaded.pkgd.min.js"></script>
        <script src="/wp-content/plugins/custom-lux/assets/CSSPlugin.min.js"></script>
        <script src="/wp-content/plugins/custom-lux/assets/gsap.min.js"></script>
        <script src="/wp-content/plugins/custom-lux/assets/carousel.js"></script>
    @endif
    @if(str_contains($renderedHtml, 'project-carousel') || str_contains($renderedHtml, 'elementor-image-carousel'))
        <link rel="stylesheet" href="/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css"/>
        <script src="/wp-content/plugins/elementor/assets/lib/swiper/v8/swiper.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swiper && document.querySelector('.swiper')) {
                document.querySelectorAll('.swiper').forEach(function(el) {
                    if (!el.swiper) {
                        new Swiper(el, {
                            slidesPerView: 1,
                            loop: true,
                            autoplay: { delay: 3000, disableOnInteraction: false },
                            pagination: { el: el.querySelector('.swiper-pagination') || '.swiper-pagination', clickable: true }
                        });
                    }
                });
            }
        });
        </script>
    @endif
@endpush

