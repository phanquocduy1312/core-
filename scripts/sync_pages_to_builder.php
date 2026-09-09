<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;
use App\Services\LocalizedSlugService;
use App\Services\LanguageRegistry;
use Illuminate\Support\Str;

$slugService = app(LocalizedSlugService::class);
$langRegistry = app(LanguageRegistry::class);

$pagesConfig = [
    [
        'slug' => 'trang-chu',
        'slugs' => [
            'vi' => 'trang-chu',
            'en' => 'home',
            'ko' => 'home-ko',
        ],
        'title' => [
            'vi' => 'Trang chủ - LuxLight | Multinational Lighting Project Supplier',
            'en' => 'Home - LuxLight | Multinational Lighting Project Supplier',
            'ko' => '홈 - LuxLight | 다국적 조명 프로젝트 공급업체',
        ],
        'file' => __DIR__ . '/../resources/views/pages/home.blade.php',
    ],
    [
        'slug' => 'gioi-thieu',
        'slugs' => [
            'vi' => 'gioi-thieu',
            'en' => 'about-us',
            'ko' => 'about-ko',
        ],
        'title' => [
            'vi' => 'Giới thiệu - LuxLight | Về chúng tôi',
            'en' => 'About Us - LuxLight | Company Overview',
            'ko' => '회사 소개 - LuxLight',
        ],
        'file' => __DIR__ . '/../resources/views/pages/gioi-thieu.blade.php',
    ],
    [
        'slug' => 'thuong-hieu',
        'slugs' => [
            'vi' => 'thuong-hieu',
            'en' => 'brands',
            'ko' => 'brands-ko',
        ],
        'title' => [
            'vi' => 'Thương hiệu - LuxLight | Đối tác thương hiệu chiếu sáng hàng đầu',
            'en' => 'Brands - LuxLight | Leading Lighting Brand Partners',
            'ko' => '브랜드 - LuxLight',
        ],
        'file' => __DIR__ . '/../resources/views/pages/thuong-hieu.blade.php',
    ],
    [
        'slug' => 'du-an',
        'slugs' => [
            'vi' => 'du-an',
            'en' => 'projects',
            'ko' => 'projects-ko',
        ],
        'title' => [
            'vi' => 'Dự án - LuxLight | Các dự án chiếu sáng tiêu biểu',
            'en' => 'Projects - LuxLight | Featured Lighting Projects',
            'ko' => '프로젝트 - LuxLight',
        ],
        'file' => __DIR__ . '/../resources/views/pages/du-an.blade.php',
    ],
    [
        'slug' => 'lien-he',
        'slugs' => [
            'vi' => 'lien-he',
            'en' => 'contact',
            'ko' => 'contact-ko',
        ],
        'title' => [
            'vi' => 'Liên hệ - LuxLight | Văn phòng khu vực & Dịch vụ khách hàng',
            'en' => 'Contact - LuxLight | Regional Offices & Customer Support',
            'ko' => '문의하기 - LuxLight',
        ],
        'file' => __DIR__ . '/../resources/views/pages/lien-he.blade.php',
    ],
];

echo "Bắt đầu đồng bộ các trang vào hệ thống Page Builder...\n";

foreach ($pagesConfig as $cfg) {
    $rawBlade = file_exists($cfg['file']) ? file_get_contents($cfg['file']) : '';
    
    // Extract HTML inside @section('content') ... @endsection
    $htmlContent = '';
    if (preg_match('/@section\(\'content\'\)(.*?)@endsection/s', $rawBlade, $matches)) {
        $htmlContent = trim($matches[1]);
    } else {
        $htmlContent = $rawBlade;
    }

    // Extract CSS inside @push('styles') ... @endpush
    $cssContent = '';
    if (preg_match('/@push\(\'styles\'\)\s*<style>(.*?)<\/style>\s*@endpush/s', $rawBlade, $styleMatches)) {
        $cssContent = trim($styleMatches[1]);
    }

    // Find or create Page
    $page = Page::query()->where('slug', $cfg['slug'])
        ->orWhere('slug', 'like', $cfg['slug'] . '%')
        ->first();

    // If ID 1 exists and is the only home page, update it
    if (!$page && $cfg['slug'] === 'trang-chu') {
        $page = Page::query()->find(1);
    }

    if (!$page) {
        $page = new Page();
        $page->slug = $cfg['slug'];
    }

    $page->type = 'page';
    $page->schema_version = 1;
    $page->is_active = true;
    $page->published_at = now();
    $page->header_mode = 'inherit';
    $page->footer_mode = 'inherit';

    // Set multilingual attributes
    $publishedHtml = [];
    $publishedCss = [];
    $builderData = [];

    foreach (['vi', 'en', 'ko'] as $loc) {
        $page->setTranslation('title', $loc, $cfg['title'][$loc]);
        $page->setTranslation('published_html', $loc, $htmlContent);
        $page->setTranslation('published_css', $loc, $cssContent);
        $page->setTranslation('meta_title', $loc, $cfg['title'][$loc]);
        $page->setTranslation('meta_description', $loc, $cfg['title'][$loc]);
    }

    $page->save();

    // Sync localized slugs
    $slugService->sync($page, $cfg['slugs'], $cfg['title']);

    echo " [OK] Đã đồng bộ trang: {$cfg['slug']} (ID: {$page->id}) - Tiêu đề: {$cfg['title']['vi']}\n";
    echo "      Builder URL: https://revoluxasia796.mbws.vn/vi/admin/pages/{$page->id}/builder\n";
}

echo "\n Hoàn tất! Tất cả các trang đã sẵn sàng trong UI/UX Builder.\n";
