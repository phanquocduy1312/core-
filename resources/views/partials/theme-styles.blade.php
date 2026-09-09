{{--
    Frontend stylesheet manifest.

    Rendered into the public <head> by layouts/app.blade.php, and the same list
    (config/theme.php) is handed to the GrapesJS builder as `canvas.styles`
    so the builder canvas and the live site resolve identical CSS.

    Do not add <link> tags here — add them to config/theme.php instead.
--}}
@foreach(config('theme.stylesheets', []) as $sheet)
<link rel="stylesheet" href="{{ $sheet['href'] }}"@isset($sheet['id']) id="{{ $sheet['id'] }}"@endisset media="{{ $sheet['media'] ?? 'all' }}">
@endforeach
<link rel="stylesheet" href="{{ asset(config('theme.inline_css')) }}?v={{ \App\Support\ThemeAssets::version() }}" id="luxlight-site-inline-css" media="all">
