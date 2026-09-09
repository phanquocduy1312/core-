<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Project;
use App\Services\LocalizedSlugService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\View;

class ProjectPagesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Page 1: Our Projects (Showcase 3D Carousel)
        $this->seedDuAnPage();

        // 2. Page 2: Hospitality Lighting Projects (Projects Grid & Filter)
        $this->seedHospitalityPage();

        // 3. Page 3: Project Detail - Dusit Thani Laguna Singapore
        $this->seedDusitThaniPage();
    }

    protected function upsertPage(string $slug, array $data, array $slugs, array $titles): Page
    {
        $page = Page::withTrashed()->where('slug', $slug)->first();
        if ($page) {
            if ($page->trashed()) {
                $page->restore();
            }
            $page->update($data);
        } else {
            $page = Page::query()->create(array_merge($data, ['slug' => $slug]));
        }

        app(LocalizedSlugService::class)->sync($page, $slugs, $titles);

        return $page;
    }

    protected function seedDuAnPage(): void
    {
        $blade = file_get_contents(resource_path('views/pages/du-an.blade.php'));

        $html = '';
        if (preg_match('/@section\([\'"]content[\'"]\)(.*?)@endsection/is', $blade, $bm)) {
            $html = trim($bm[1]);
            $html = str_replace([
                "{{ route('projects.hospitality') }}",
                "{{ route('projects.residential') }}",
                "{{ route('projects.commercial') }}",
            ], [
                '/hospitality-lighting-projects',
                '/residential-lighting-projects',
                '/commercial-lighting-projects',
            ], $html);
        }

        $css = '';
        if (preg_match('/<style[^>]*>(.*?)<\/style>/is', $blade, $cm)) {
            $css = trim($cm[1]);
        }

        $css .= <<<'EXTRA_CSS'

/* Ẩn preloader */
.loading__wrapper { display: none !important; }

/* Trình diễn 3D Carousel đẹp mắt trong builder */
.lux-carousel .app { min-height: 520px; position: relative; overflow: visible; }
.lux-carousel .card { --card-translateY-offset: 0 !important; cursor: pointer; }
.lux-carousel .card.current--card { opacity: 1 !important; transform: translate(-50%, -50%) scale(1.15) !important; z-index: 10 !important; }
.lux-carousel .card.previous--card { opacity: 0.55 !important; transform: translate(-50%, -50%) translateX(-300px) rotateY(25deg) scale(0.9) !important; z-index: 5 !important; }
.lux-carousel .card.next--card { opacity: 0.55 !important; transform: translate(-50%, -50%) translateX(300px) rotateY(-25deg) scale(0.9) !important; z-index: 5 !important; }
.lux-carousel .infoList { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); width: 100%; height: auto; text-align: center; z-index: 15; }
.lux-carousel .info.current--info { display: block; opacity: 1; text-align: center; margin: 0 auto; }
EXTRA_CSS;


        $titles = [
            'vi' => 'Dự án - Our Projects',
            'en' => 'Our Projects - Lighting Projects in Asia',
            'ko' => '프로젝트 - Our Projects',
        ];
        $slugs = [
            'vi' => 'du-an',
            'en' => 'lighting-projects-in-asia',
            'ko' => 'projects',
        ];

        $this->upsertPage(
            'du-an',
            [
                'type' => 'page',
                'title' => $titles,
                'meta_title' => [
                    'vi' => 'Dự án Chiếu sáng Kiến trúc - LuxLight',
                    'en' => 'Lighting Projects in Asia - LuxLight',
                    'ko' => '아시아 조명 프로젝트 - LuxLight',
                ],
                'meta_description' => [
                    'vi' => 'Hàng loạt dự án chiếu sáng quy mô lớn thuộc các lĩnh vực Nghỉ dưỡng, Nhà ở và Thương mại - LuxLight.',
                    'en' => 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore.',
                    'ko' => '호텔, 주거 및 상업 분야에 걸친 수많은 대규모 조명 프로젝트 - LuxLight.',
                ],
                'builder_data' => ['version' => 1, 'locales' => []],
                'published_html' => [
                    'vi' => $html,
                    'en' => $html,
                    'ko' => $html,
                ],
                'published_css' => [
                    'vi' => $css,
                    'en' => $css,
                    'ko' => $css,
                ],
                'is_active' => true,
                'published_at' => now(),
                'header_mode' => 'inherit',
                'footer_mode' => 'inherit',
            ],
            $slugs,
            $titles
        );
    }

    protected function seedHospitalityPage(): void
    {
        $projects = Project::query()
            ->where('is_active', true)
            ->where('category', 'hospitality')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12);

        $renderedView = View::make('pages.du-an-hospitality', compact('projects'))->render();
        
        $html = '';
        if (preg_match('/<div class="elementor elementor-5335".*?<\/div>\s*<\/main>/is', $renderedView, $m)) {
            $html = trim(str_replace('</main>', '', $m[0]));
        } elseif (preg_match('/<div class="elementor elementor-5335".*$/is', $renderedView, $m2)) {
            $html = trim(preg_replace('/<\/body>.*$/is', '', $m2[0]));
            $html = trim(preg_replace('/<\/div>\s*<\/div>\s*<\/section>\s*<\/div>.*$/is', '</div></div></section></div>', $html));
        }

        if (empty($html)) {
            $blade = file_get_contents(resource_path('views/pages/du-an-hospitality.blade.php'));
            if (preg_match('/@section\([\'"]content[\'"]\)(.*?)@endsection/is', $blade, $bm)) {
                $html = trim($bm[1]);
            }
        }

        $css = '';
        $blade = file_get_contents(resource_path('views/pages/du-an-hospitality.blade.php'));
        if (preg_match('/<style[^>]*>(.*?)<\/style>/is', $blade, $cm)) {
            $css = trim($cm[1]);
        }

        $titles = [
            'vi' => 'Dự án Nghỉ dưỡng - Hospitality Lighting Projects',
            'en' => 'Hospitality Lighting Projects - LuxLight',
            'ko' => '호텔 및 리조트 조명 프로젝트 - LuxLight',
        ];
        $slugs = [
            'vi' => 'hospitality-lighting-projects',
            'en' => 'hospitality-lighting-projects',
            'ko' => 'hospitality-lighting-projects',
        ];

        $this->upsertPage(
            'hospitality-lighting-projects',
            [
                'type' => 'page',
                'title' => $titles,
                'meta_title' => [
                    'vi' => 'Dự án Chiếu sáng Nghỉ dưỡng (Hospitality) - LuxLight',
                    'en' => 'Hospitality Lighting Projects - LuxLight',
                    'ko' => '호텔 조명 프로젝트 - LuxLight',
                ],
                'meta_description' => [
                    'vi' => 'Dự án chiếu sáng kiến trúc cao cấp cho các khu nghỉ dưỡng, khách sạn 5 sao quốc tế - LuxLight.',
                    'en' => 'Numerous Sizable Lighting Projects across Hospitality, Residential and Commercial Sectors - LuxLight Singapore.',
                    'ko' => '호텔, 리조트 조명 프로젝트 - LuxLight.',
                ],
                'builder_data' => ['version' => 1, 'locales' => []],
                'published_html' => [
                    'vi' => $html,
                    'en' => $html,
                    'ko' => $html,
                ],
                'published_css' => [
                    'vi' => $css,
                    'en' => $css,
                    'ko' => $css,
                ],
                'is_active' => true,
                'published_at' => now(),
                'header_mode' => 'inherit',
                'footer_mode' => 'inherit',
            ],
            $slugs,
            $titles
        );
    }

    protected function seedDusitThaniPage(): void
    {
        $blade = file_get_contents(resource_path('views/pages/projects/dusit-thani-laguna.blade.php'));

        $html = '';
        if (preg_match('/@section\([\'"]content[\'"]\)(.*?)@endsection/is', $blade, $bm)) {
            $html = trim($bm[1]);
        }

        $css = <<<'CSS'
.elementor-7892 {
    font-family: "DIN", sans-serif;
}
.elementor-7892 h2.elementor-heading-title {
    font-family: "ACaslonPro", serif, sans-serif !important;
}
.elementor-7892 .elementor-element-847e6fb {
    padding: 30px 20px;
}
CSS;

        $titles = [
            'vi' => 'Dự án Dusit Thani Laguna, Singapore - LuxLight',
            'en' => 'Dusit Thani Laguna, Singapore - LuxLight Project',
            'ko' => '두싯 타니 라구나 싱가포르 프로젝트 - LuxLight',
        ];
        $slugs = [
            'vi' => 'dusit-thani-laguna',
            'en' => 'dusit-thani-laguna',
            'ko' => 'dusit-thani-laguna',
        ];

        $this->upsertPage(
            'dusit-thani-laguna',
            [
                'type' => 'page',
                'title' => $titles,
                'meta_title' => [
                    'vi' => 'Dusit Thani Laguna, Singapore - Dự án Chiếu sáng Kiến trúc LuxLight',
                    'en' => 'Dusit Thani Laguna, Singapore - LuxLight Project',
                    'ko' => 'Dusit Thani Laguna, Singapore - LuxLight',
                ],
                'meta_description' => [
                    'vi' => 'Khu nghỉ dưỡng phong cách resort đô thị cao cấp nằm ngay trong khuôn viên Laguna National Golf & Country Club.',
                    'en' => 'Urban resort style luxury located in the grounds of Laguna National Golf & Country Club.',
                    'ko' => '라구나 내셔널 골프 & 컨트리 클럽 내에 위치한 고급 어반 리조트 조명 프로젝트.',
                ],
                'builder_data' => ['version' => 1, 'locales' => []],
                'published_html' => [
                    'vi' => $html,
                    'en' => $html,
                    'ko' => $html,
                ],
                'published_css' => [
                    'vi' => $css,
                    'en' => $css,
                    'ko' => $css,
                ],
                'is_active' => true,
                'published_at' => now(),
                'header_mode' => 'inherit',
                'footer_mode' => 'inherit',
            ],
            $slugs,
            $titles
        );
    }
}
