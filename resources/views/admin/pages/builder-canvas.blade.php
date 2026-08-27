<!DOCTYPE html>
<html lang="{{ $contentLocale ?? 'vi' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Canvas' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind & Site Styles -->
    <link rel="stylesheet" href="{{ asset('build/assets/builder.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/admin.css') }}">

    <!-- Icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>

    <style id="page-custom-css">
        body {
            font-family: 'Quicksand', sans-serif;
            color: #1f2937;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        *, *::before, *::after {
            box-sizing: border-box;
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
            pointer-events: none;
            z-index: 40;
        }
        {!! $css !!}
    </style>
</head>
<body class="antialiased min-h-screen">
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
