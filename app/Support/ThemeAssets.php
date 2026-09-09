<?php

namespace App\Support;

/**
 * Bridge between the public site's stylesheet manifest (config/theme.php) and
 * the GrapesJS builder canvas.
 *
 * The builder iframe is a bare document, so anything the public <head> pulls in
 * has to be replayed there or the canvas renders nothing like the live page.
 * Both consumers read the same manifest through this class, which is what keeps
 * them from drifting apart.
 */
class ThemeAssets
{
    /**
     * Cache-busting token for the extracted inline stylesheet.
     */
    public static function version(): string
    {
        $path = public_path((string) config('theme.inline_css'));

        return is_file($path) ? (string) filemtime($path) : '1';
    }

    /**
     * Absolute URLs of every screen stylesheet the public site loads, in order.
     *
     * `media="print"` sheets are dropped: they never affect the on-screen
     * rendering the designer is editing, and loading them only slows the canvas.
     *
     * Pass the markup that will be rendered (page body, header, footer) to also
     * get its per-page Elementor stylesheet — see elementorStyles().
     */
    public static function canvasStyles(string ...$html): array
    {
        $styles = [];

        foreach (config('theme.stylesheets', []) as $sheet) {
            if (($sheet['media'] ?? 'all') === 'print') {
                continue;
            }
            $styles[] = $sheet['href'];
        }

        $styles[] = asset(config('theme.inline_css')).'?v='.self::version();

        // Per-page sheets load last, matching @stack('styles') in the layout.
        return array_merge($styles, self::elementorStyles($html));
    }

    /**
     * Per-page Elementor stylesheets required by a chunk of markup.
     *
     * Elementor keeps each page's widget styling — alignment, fonts, colours,
     * spacing — in its own `post-<id>.css`, which the public page pulls in via
     * @stack('styles') (home → post-184.css, gioi-thieu → post-799.css, …).
     * The shared manifest only carries the kit, header and footer sheets, so a
     * canvas without this renders every heading in the theme's fallback style:
     * left aligned, sans-serif, plain white instead of centred serif gold.
     *
     * The id is read from the markup itself (`data-elementor-id`, or the
     * `elementor-<id>` class) so a page carries its own styling with it and
     * nothing has to be registered by hand.
     *
     * @param  array<int, string|null>  $htmlChunks
     * @return array<int, string>
     */
    public static function elementorStyles(array $htmlChunks): array
    {
        $ids = [];

        foreach ($htmlChunks as $html) {
            if (! is_string($html) || $html === '') {
                continue;
            }
            preg_match_all('/data-elementor-id="(\d+)"/', $html, $byAttribute);
            preg_match_all('/class="[^"]*\belementor-(\d+)\b/', $html, $byClass);
            $ids = array_merge($ids, $byAttribute[1], $byClass[1]);
        }

        $already = array_column(config('theme.stylesheets', []), 'href');
        $styles = [];

        foreach (array_unique($ids) as $id) {
            $href = '/wp-content/uploads/elementor/css/post-'.$id.'.css';

            if (in_array($href, $already, true) || in_array($href, $styles, true)) {
                continue;
            }
            if (! is_file(public_path(ltrim($href, '/')))) {
                continue;
            }

            $styles[] = $href;
        }

        return $styles;
    }

    /**
     * Body classes the theme's CSS is scoped against (elementor-kit-7 etc.).
     */
    public static function bodyClass(): string
    {
        return (string) config('theme.body_class', '');
    }

    /**
     * Cache-busting token for the builder's own JS/CSS.
     *
     * These files are plain <script src> tags, not Vite entries, so a browser
     * happily serves a stale copy for days. That is a bad failure mode here:
     * the editor keeps loading with old behaviour and the change simply looks
     * like it did not work. Keyed on the newest mtime in the bundle directory.
     */
    public static function builderVersion(): string
    {
        static $version = null;
        if ($version !== null) {
            return $version;
        }

        $dir = public_path('admin-assets/js/grapes-builder');
        if (! is_dir($dir)) {
            return $version = '1';
        }

        $newest = 0;
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
        foreach ($files as $file) {
            $newest = max($newest, $file->getMTime());
        }

        return $version = (string) $newest;
    }

    /**
     * Class on the public site's content wrapper (<main class="site-main">).
     */
    public static function contentClass(): string
    {
        return (string) config('theme.content_class', '');
    }
}
