<!DOCTYPE html>
<html lang="{{ $contentLocale ?? 'vi' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ url('/') }}/">
    <title>{{ $title ?? 'Canvas' }}</title>
    
    {{-- The real site theme first, so imported Elementor markup renders exactly
         as it does on the public page, then the builder's Tailwind utilities for
         blocks authored in this builder. --}}
    @include('partials.theme-styles')
    @vite(['resources/css/builder.css'])

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <style id="page-custom-css">
        /* Only what the theme does not already provide. Deliberately no
           font-family / color override here: forcing Quicksand on top of the
           theme was making this preview diverge from the live page. */
        body {
            margin: 0;
            padding: 0;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        [data-page-block] {
            position: relative;
        }
        [data-page-block]:hover::after {
            content: attr(data-page-block);
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(227, 35, 38, 0.85);
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 40;
        }
        .builder-heading {
            font-family: inherit;
        }
        .builder-btn {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .builder-btn:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }
        .builder-video-wrapper iframe {
            border: 0;
        }

        /* Ẩn triệt để màn hình loader / preloader trong canvas để không che mất nội dung */
        .loading__wrapper,
        .preloader,
        .page-loader,
        #preloader {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }

        /* Định vị thẻ 3D Carousel trong canvas builder trực quan */
        .lux-carousel .app {
            min-height: 520px !important;
            position: relative !important;
            overflow: visible !important;
        }
        .lux-carousel .card {
            --card-translateY-offset: 0 !important;
            cursor: pointer !important;
        }
        .lux-carousel .card.current--card {
            opacity: 1 !important;
            transform: translate(-50%, -50%) scale(1.15) !important;
            z-index: 10 !important;
        }
        .lux-carousel .card.previous--card {
            opacity: 0.55 !important;
            transform: translate(-50%, -50%) translateX(-300px) rotateY(25deg) scale(0.9) !important;
            z-index: 5 !important;
        }
        .lux-carousel .card.next--card {
            opacity: 0.55 !important;
            transform: translate(-50%, -50%) translateX(300px) rotateY(-25deg) scale(0.9) !important;
            z-index: 5 !important;
        }
        .lux-carousel .infoList {
            position: absolute !important;
            bottom: 20px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 100% !important;
            height: auto !important;
            text-align: center !important;
            z-index: 15 !important;
        }
        .lux-carousel .info.current--info {
            display: block !important;
            opacity: 1 !important;
            text-align: center !important;
            margin: 0 auto !important;
        }
        .lux-carousel .info.current--info h3 {
            color: #ffffff !important;
            font-size: 32px !important;
            font-family: "ACaslonPro", serif, sans-serif !important;
            margin: 0 !important;
        }
        .lux-carousel .info.current--info p {
            color: rgba(255, 255, 255, 0.85) !important;
            font-size: 14px !important;
            margin: 4px 0 0 0 !important;
        }

        {!! $css !!}
    </style>
</head>
<body class="{{ \App\Support\ThemeAssets::bodyClass() }} antialiased min-h-screen">
    @if(!empty($headerHtml))
        <header id="client-page-header" class="border-b border-gray-100">{!! $headerHtml !!}</header>
    @endif

    <div id="page-content" class="min-h-[400px]">
        {!! $html ?: '<section class="py-16 px-4 max-w-5xl mx-auto text-center"><div class="p-8 border-2 border-dashed border-gray-300 rounded-2xl bg-gray-50"><iconify-icon icon="solar:widget-add-bold-duotone" class="text-5xl text-primary mb-3"></iconify-icon><h3 class="text-xl font-bold text-gray-800 mb-2">Trang chưa có nội dung</h3><p class="text-gray-500 text-sm max-w-md mx-auto">Kéo các Block hoặc Section từ bảng bên trái vào đây để bắt đầu thiết kế giao diện trang của bạn.</p></div></section>' !!}
    </div>

    @if(!empty($footerHtml))
        <footer id="client-page-footer" class="border-t border-gray-100">{!! $footerHtml !!}</footer>
    @endif
</body>
</html>
