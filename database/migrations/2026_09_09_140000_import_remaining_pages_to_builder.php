<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (app()->environment('testing')) {
            return;
        }

        $pages = [
            [
                'slug' => 'hospitality-lighting-projects',
                'title_vi' => 'Dự án Khách sạn & Nghỉ dưỡng - Hospitality Lighting',
                'title_en' => 'Hospitality Lighting Projects - LuxLight',
                'file' => 'resources/views/pages/du-an-hospitality.blade.php',
                'meta_title_vi' => 'Dự án Chiếu sáng Khách sạn & Resort - LuxLight',
                'meta_title_en' => 'Hospitality Lighting Projects - LuxLight Singapore',
                'meta_desc_vi' => 'Các dự án chiếu sáng khách sạn và resort 5 sao tiêu biểu do LuxLight cung cấp.',
                'meta_desc_en' => 'Numerous Sizable Lighting Projects across Hospitality Sectors - LuxLight Singapore',
            ],
            [
                'slug' => 'residential-lighting-projects',
                'title_vi' => 'Dự án Nhà ở & Căn hộ - Residential Lighting',
                'title_en' => 'Residential Lighting Projects - LuxLight',
                'file' => 'resources/views/pages/du-an-residential.blade.php',
                'meta_title_vi' => 'Dự án Chiếu sáng Khu dân cư & Biệt thự - LuxLight',
                'meta_title_en' => 'Residential Lighting Projects - LuxLight Singapore',
                'meta_desc_vi' => 'Các dự án chiếu sáng căn hộ cao cấp, biệt thự và khu dân cư.',
                'meta_desc_en' => 'Luxury Residential Lighting Projects - LuxLight Singapore',
            ],
            [
                'slug' => 'commercial-lighting-projects',
                'title_vi' => 'Dự án Thương mại & Văn phòng - Commercial Lighting',
                'title_en' => 'Commercial Lighting Projects - LuxLight',
                'file' => 'resources/views/pages/du-an-commercial.blade.php',
                'meta_title_vi' => 'Dự án Chiếu sáng Thương mại & Văn phòng - LuxLight',
                'meta_title_en' => 'Commercial Lighting Projects - LuxLight Singapore',
                'meta_desc_vi' => 'Các dự án chiếu sáng văn phòng, trung tâm thương mại, nhà hàng.',
                'meta_desc_en' => 'Commercial Lighting Projects in Asia - LuxLight Singapore',
            ],
            [
                'slug' => 'other-lighting-projects',
                'title_vi' => 'Dự án Khác - Other Lighting Projects',
                'title_en' => 'Other Lighting Projects - LuxLight',
                'file' => 'resources/views/pages/du-an-other.blade.php',
                'meta_title_vi' => 'Dự án Chiếu sáng Công cộng & Di sản - LuxLight',
                'meta_title_en' => 'Other Lighting Projects - LuxLight Singapore',
                'meta_desc_vi' => 'Các dự án chiếu sáng di sản, nhà thờ, không gian cộng đồng.',
                'meta_desc_en' => 'Other Lighting Projects in Asia - LuxLight Singapore',
            ],
            [
                'slug' => 'privacy-policy',
                'title_vi' => 'Chính sách quyền riêng tư - Privacy Policy',
                'title_en' => 'Privacy Policy - LuxLight',
                'file' => 'resources/views/pages/privacy-policy.blade.php',
                'meta_title_vi' => 'Chính sách quyền riêng tư - LuxLight',
                'meta_title_en' => 'Privacy Policy - LuxLight',
                'meta_desc_vi' => 'Chính sách bảo mật và quyền riêng tư thông tin của LuxLight.',
                'meta_desc_en' => 'Privacy Policy - LuxLight Singapore',
            ],
            [
                'slug' => 'terms-of-use',
                'title_vi' => 'Điều khoản sử dụng - Terms of Use',
                'title_en' => 'Terms of Use - LuxLight',
                'file' => 'resources/views/pages/terms-of-use.blade.php',
                'meta_title_vi' => 'Điều khoản sử dụng - LuxLight',
                'meta_title_en' => 'Terms of Use - LuxLight',
                'meta_desc_vi' => 'Điều khoản sử dụng website và dịch vụ của LuxLight.',
                'meta_desc_en' => 'Terms of Use - LuxLight Singapore',
            ],
        ];

        foreach ($pages as $item) {
            $existing = Page::query()->where('slug', $item['slug'])->first();
            if ($existing) {
                continue;
            }

            $html = '';
            $css = '';
            $filepath = base_path($item['file']);
            if (file_exists($filepath)) {
                $content = file_get_contents($filepath);
                if (preg_match('/@section\(\'content\'\)(.*?)@endsection/s', $content, $mHtml)) {
                    $html = trim($mHtml[1]);
                }
                if (preg_match('/<style>(.*?)<\/style>/s', $content, $mCss)) {
                    $css = trim($mCss[1]);
                }
            }

            $page = new Page();
            $page->type = 'page';
            $page->slug = $item['slug'];
            $page->schema_version = 3;
            $page->is_active = true;
            $page->published_at = now();
            $page->header_mode = 'inherit';
            $page->footer_mode = 'inherit';

            $page->setTranslation('title', 'vi', $item['title_vi']);
            $page->setTranslation('title', 'en', $item['title_en']);
            $page->setTranslation('title', 'ko', $item['title_en']);

            $page->setTranslation('published_html', 'vi', $html);
            $page->setTranslation('published_html', 'en', $html);
            $page->setTranslation('published_html', 'ko', $html);

            $page->setTranslation('published_css', 'vi', $css);
            $page->setTranslation('published_css', 'en', $css);
            $page->setTranslation('published_css', 'ko', $css);

            $page->setTranslation('builder_data', 'vi', []);
            $page->setTranslation('builder_data', 'en', []);
            $page->setTranslation('builder_data', 'ko', []);

            $page->setTranslation('meta_title', 'vi', $item['meta_title_vi']);
            $page->setTranslation('meta_title', 'en', $item['meta_title_en']);
            $page->setTranslation('meta_title', 'ko', $item['meta_title_en']);

            $page->setTranslation('meta_description', 'vi', $item['meta_desc_vi']);
            $page->setTranslation('meta_description', 'en', $item['meta_desc_en']);
            $page->setTranslation('meta_description', 'ko', $item['meta_desc_en']);

            $page->save();

            // Register localized slugs
            foreach (['vi', 'en', 'ko'] as $locale) {
                DB::table('localized_slugs')->updateOrInsert(
                    [
                        'sluggable_type' => Page::class,
                        'sluggable_id' => $page->id,
                        'locale' => $locale,
                    ],
                    [
                        'slug' => $item['slug'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }

    public function down(): void
    {
        $slugs = [
            'hospitality-lighting-projects',
            'residential-lighting-projects',
            'commercial-lighting-projects',
            'other-lighting-projects',
            'privacy-policy',
            'terms-of-use',
        ];

        $pages = Page::query()->whereIn('slug', $slugs)->get();
        foreach ($pages as $page) {
            DB::table('localized_slugs')
                ->where('sluggable_type', Page::class)
                ->where('sluggable_id', $page->id)
                ->delete();
            $page->forceDelete();
        }
    }
};
