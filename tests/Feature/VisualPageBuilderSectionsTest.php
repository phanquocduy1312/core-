<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisualPageBuilderSectionsTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Page $page;

    protected function setUp(): void
    {
        parent::setUp();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );

        $role = Role::query()->create([
            'name' => 'Page Manager',
            'permissions' => ['manage_pages', 'manage_media'],
        ]);

        $this->admin = User::factory()->create([
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        $this->page = Page::query()->create([
            'title' => ['vi' => 'M4 Sections Test', 'en' => 'M4 Sections Test'],
            'slug' => 'm4-sections-test',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => ''],
            'published_css' => ['vi' => ''],
            'builder_data' => ['vi' => []],
        ]);
    }

    /**
     * TEST 1: Programmatic Project Data Insertion & Role Metadata Persistence
     */
    public function test_programmatic_project_data_insertion_with_role_metadata(): void
    {
        $heroSection = [
            'type' => 'builder-section',
            'sectionType' => 'hero',
            'variant' => 'hero-01',
            'attributes' => ['id' => 'sec-hero-test'],
            'classes' => ['builder-section', 'section-hero-01'],
            'components' => [
                [
                    'type' => 'builder-container',
                    'classes' => ['builder-container'],
                    'components' => [
                        [
                            'type' => 'builder-columns',
                            'classes' => ['builder-columns-2'],
                            'components' => [
                                [
                                    'type' => 'builder-column',
                                    'components' => [
                                        [
                                            'type' => 'builder-stack',
                                            'classes' => ['builder-stack', 'builder-flex-col', 'builder-gap-5'],
                                            'components' => [
                                                [
                                                    'type' => 'builder-heading',
                                                    'tagName' => 'h1',
                                                    'role' => 'section-title',
                                                    'content' => 'Đẳng Cấp Du Thuyền Hạng Sang',
                                                    'classes' => ['hero-title']
                                                ],
                                                [
                                                    'type' => 'builder-paragraph',
                                                    'role' => 'section-description',
                                                    'content' => 'Khám phá bộ sưu tập du thuyền sang trọng hàng đầu.',
                                                    'classes' => ['section-description']
                                                ],
                                                [
                                                    'type' => 'builder-stack',
                                                    'role' => 'action-group',
                                                    'classes' => ['builder-stack', 'builder-flex-row', 'builder-gap-3', 'builder-align-center'],
                                                    'components' => [
                                                        [
                                                            'type' => 'builder-button',
                                                            'role' => 'primary-action',
                                                            'content' => 'Khám phá ngay',
                                                            'classes' => ['builder-btn', 'builder-btn-primary'],
                                                            'attributes' => ['href' => '#danh-muc']
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                [
                                    'type' => 'builder-column',
                                    'components' => [
                                        [
                                            'type' => 'image',
                                            'tagName' => 'img',
                                            'role' => 'hero-image',
                                            'classes' => ['builder-img', 'builder-rounded-2xl'],
                                            'attributes' => ['src' => '/admin-assets/images/builder/hero-placeholder.svg', 'alt' => 'Du thuyền', 'loading' => 'lazy'],
                                            'mediaRef' => 'general/hero-placeholder'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $projectData = [
            'pages' => [
                [
                    'id' => 'page-m4',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [$heroSection]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = '<section id="sec-hero-test" class="builder-section section-hero-01"><div class="builder-container"><div class="builder-columns-2"><div class="builder-stack builder-flex-col builder-gap-5"><h1 class="hero-title">Đẳng Cấp Du Thuyền Hạng Sang</h1><p class="section-description">Khám phá bộ sưu tập du thuyền sang trọng hàng đầu.</p><a href="#danh-muc" class="builder-btn builder-btn-primary">Khám phá ngay</a></div><div><img src="/admin-assets/images/builder/hero-placeholder.svg" alt="Du thuyền" loading="lazy" class="builder-img builder-rounded-2xl"></div></div></div></section>';
        $css = '.section-hero-01 { padding-top: 80px; padding-bottom: 80px; background-color: #f8fafc; }';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => $html,
            'published_css' => $css,
        ]);

        $response->assertOk();
        $this->page->refresh();
        $saved = $this->page->getTranslation('builder_data', 'vi', false);

        $savedHero = $saved['pages'][0]['frames'][0]['component']['components'][0];
        $this->assertSame('hero', $savedHero['sectionType']);
        $this->assertSame('hero-01', $savedHero['variant']);
        $this->assertSame('sec-hero-test', $savedHero['attributes']['id']);

        $heroHeading = $savedHero['components'][0]['components'][0]['components'][0]['components'][0]['components'][0];
        $this->assertSame('section-title', $heroHeading['role']);
        $this->assertSame('Đẳng Cấp Du Thuyền Hạng Sang', $heroHeading['content']);
    }

    /**
     * TEST 2: Duplicate Section & Nested Elements Regenerate Unique IDs
     */
    public function test_duplicate_section_and_nested_elements_unique_ids(): void
    {
        $hero1 = [
            'type' => 'builder-section',
            'sectionType' => 'hero',
            'variant' => 'hero-01',
            'attributes' => ['id' => 'sec-hero-orig'],
            'components' => [
                [
                    'type' => 'builder-container',
                    'components' => [
                        [
                            'type' => 'builder-stack',
                            'attributes' => ['id' => 'card-orig-1'],
                            'components' => [
                                ['type' => 'builder-heading', 'content' => 'Hero 1']
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Duplicate with unique regenerated IDs
        $hero2 = [
            'type' => 'builder-section',
            'sectionType' => 'hero',
            'variant' => 'hero-01',
            'attributes' => ['id' => 'sec-hero-copy'],
            'components' => [
                [
                    'type' => 'builder-container',
                    'components' => [
                        [
                            'type' => 'builder-stack',
                            'attributes' => ['id' => 'card-copy-1'],
                            'components' => [
                                ['type' => 'builder-heading', 'content' => 'Hero 2 (Duplicate)']
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $projectData = [
            'pages' => [
                [
                    'id' => 'page-m4',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [$hero1, $hero2]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => '<section id="sec-hero-orig"></section><section id="sec-hero-copy"></section>',
            'published_css' => '.section-hero-01 { padding: 80px 0; }',
        ])->assertOk();

        $this->page->refresh();
        $saved = $this->page->getTranslation('builder_data', 'vi', false);

        $sec1 = $saved['pages'][0]['frames'][0]['component']['components'][0];
        $sec2 = $saved['pages'][0]['frames'][0]['component']['components'][1];

        // Ensure IDs are strictly unique
        $this->assertNotSame($sec1['attributes']['id'], $sec2['attributes']['id']);
        $this->assertNotSame(
            $sec1['components'][0]['components'][0]['attributes']['id'],
            $sec2['components'][0]['components'][0]['attributes']['id']
        );
    }

    /**
     * TEST 3: Independent Instance CSS Overrides (#sec-1 vs #sec-2)
     */
    public function test_independent_instance_css_overrides(): void
    {
        $projectData = [
            'pages' => [
                [
                    'id' => 'page-m4',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'builder-section',
                                        'attributes' => ['id' => 'sec-hero-1'],
                                        'classes' => ['builder-section', 'section-hero-01']
                                    ],
                                    [
                                        'type' => 'builder-section',
                                        'attributes' => ['id' => 'sec-hero-2'],
                                        'classes' => ['builder-section', 'section-hero-01']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Shared class + instance override for #sec-hero-2 only
        $css = <<<'CSS'
.section-hero-01 { padding-top: 80px; padding-bottom: 80px; background-color: #f8fafc; }
#sec-hero-2 { background-color: #0f172a !important; }
CSS;

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => '<section id="sec-hero-1" class="builder-section section-hero-01"></section><section id="sec-hero-2" class="builder-section section-hero-01"></section>',
            'published_css' => $css,
        ])->assertOk();

        $this->page->refresh();
        $savedCss = $this->page->getTranslation('published_css', 'vi', false);

        $this->assertStringContainsString('.section-hero-01', $savedCss);
        $this->assertStringContainsString('#sec-hero-2', $savedCss);
        $this->assertStringNotContainsString('#sec-hero-1', $savedCss); // No unnecessary override generated for hero 1
    }

    /**
     * TEST 4: Self-Sufficient Semantic CSS & Clean Output Verification
     */
    public function test_self_sufficient_semantic_css_and_clean_public_output(): void
    {
        $allSectionsHtml = <<<'HTML'
<section id="sec-hero" class="builder-section section-hero-01"><div class="builder-container"><div class="builder-columns-2"><h1 class="hero-title">Hero Title</h1><a class="builder-btn builder-btn-primary" href="#cta">CTA</a></div></div></section>
<section id="sec-services" class="builder-section section-services-01"><div class="builder-container"><h2 class="section-title">Dịch vụ</h2><div class="builder-grid-3"><div class="builder-service-card"><h3 class="service-title">Dịch Vụ 1</h3></div></div></div></section>
<section id="sec-projects" class="builder-section section-projects-01"><div class="builder-container"><div class="builder-grid-3"><div class="builder-project-card"><h3 class="project-title">Dự Án 1</h3></div></div></div></section>
<section id="sec-gallery" class="builder-section section-gallery-01"><div class="builder-container"><div class="builder-grid-4"><img class="builder-gallery-img" src="/admin-assets/images/builder/hero-placeholder.svg" alt="G1"></div></div></section>
<section id="sec-cta" class="builder-section section-cta-01"><div class="builder-container builder-container-sm"><h2 class="section-title section-title-white">CTA Đặt Chỗ</h2></div></section>
<section id="sec-contact" class="builder-section section-contact-01"><div class="builder-container"><div class="builder-columns-2"><div class="contact-info-row"><p class="contact-text">Hotline 24/7</p></div></div></div></section>
HTML;

        $allSectionsCss = <<<'CSS'
.builder-section { position: relative; width: 100%; overflow: hidden; }
.builder-container { width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 20px; }
.section-hero-01 { padding: 80px 0; background-color: #f8fafc; }
.hero-title { font-size: 44px; font-weight: 800; color: #0f172a; }
.section-title { font-size: 36px; font-weight: 700; color: #0f172a; }
.builder-columns-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 40px; }
.builder-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 32px; }
.builder-grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; }
.builder-service-card { padding: 32px; background: #ffffff; border-radius: 16px; }
.builder-project-card { background: #ffffff; border-radius: 16px; overflow: hidden; }
.builder-gallery-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; border-radius: 16px; }
@media (max-width: 992px) {
  .builder-grid-3, .builder-grid-4 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
}
@media (max-width: 768px) {
  .builder-columns-2 { grid-template-columns: 1fr !important; }
  .hero-title { font-size: 36px !important; }
}
@media (max-width: 480px) {
  .builder-section { padding-top: 48px !important; padding-bottom: 48px !important; }
  .builder-grid-3, .builder-grid-4 { grid-template-columns: 1fr !important; }
}
CSS;

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $allSectionsHtml,
            'published_css' => $allSectionsCss,
        ]);

        $response->assertOk();
        $this->page->refresh();
        $this->assertTrue($this->page->is_active);

        // Guest frontend verification
        auth()->logout();
        $res = $this->get('/vi/pages/' . $this->page->slug);
        $res->assertOk();
        $res->assertSee('Hero Title');
        $res->assertSee('class="hero-title"', false);
        $res->assertSee('class="builder-service-card"', false);
        $res->assertSee('class="builder-gallery-img"', false);

        // Verify CSS is rendered inside <style id="client-page-css">
        $res->assertSee('.builder-section { position: relative;', false);
        $res->assertSee('@media (max-width: 992px)', false);
        $res->assertSee('@media (max-width: 768px)', false);
        $res->assertSee('@media (max-width: 480px)', false);

        // Verify no editor metadata leaked
        $res->assertDontSee('data-gjs-', false);
        $res->assertDontSee('sectionType', false);
        $res->assertDontSee('role="section-title"', false);
    }
}
