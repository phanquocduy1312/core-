<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisualPageBuilderComponentsTest extends TestCase
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
            'title' => ['vi' => 'M3 Component Test', 'en' => 'M3 Component Test'],
            'slug' => 'm3-component-test',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => ''],
            'published_css' => ['vi' => ''],
            'builder_data' => ['vi' => []],
        ]);
    }

    /**
     * Test saving and reloading full nested component tree:
     * Section -> Container -> Heading, Paragraph, Button, Columns (Column[Image] + Column[Heading, Paragraph]), Divider, Spacer
     */
    public function test_nested_component_tree_save_draft_and_reload(): void
    {
        $nestedTree = [
            'pages' => [
                [
                    'id' => 'page-m3',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'builder-section',
                                        'tagName' => 'section',
                                        'classes' => ['relative', 'w-full'],
                                        'components' => [
                                            [
                                                'type' => 'builder-container',
                                                'tagName' => 'div',
                                                'classes' => ['mx-auto', 'max-w-7xl'],
                                                'components' => [
                                                    [
                                                        'type' => 'builder-heading',
                                                        'tagName' => 'h2',
                                                        'content' => 'Kiến Tạo Giá Trị Mới'
                                                    ],
                                                    [
                                                        'type' => 'builder-paragraph',
                                                        'tagName' => 'p',
                                                        'content' => 'Giải pháp linh hoạt và hiện đại cho doanh nghiệp của bạn.'
                                                    ],
                                                    [
                                                        'type' => 'builder-button',
                                                        'tagName' => 'a',
                                                        'content' => 'Tìm hiểu thêm',
                                                        'attributes' => [
                                                            'href' => 'https://example.com/services',
                                                            'target' => '_blank'
                                                        ]
                                                    ],
                                                    [
                                                        'type' => 'builder-columns',
                                                        'tagName' => 'div',
                                                        'components' => [
                                                            [
                                                                'type' => 'builder-column',
                                                                'components' => [
                                                                    [
                                                                        'type' => 'image',
                                                                        'tagName' => 'img',
                                                                        'attributes' => [
                                                                            'src' => '/admin-assets/images/builder/hero-placeholder.svg',
                                                                            'alt' => 'Hero Demo',
                                                                            'loading' => 'lazy'
                                                                        ],
                                                                        'mediaRef' => 'general/hero-placeholder'
                                                                    ]
                                                                ]
                                                            ],
                                                            [
                                                                'type' => 'builder-column',
                                                                'components' => [
                                                                    [
                                                                        'type' => 'builder-heading',
                                                                        'tagName' => 'h3',
                                                                        'content' => 'Tính năng vượt trội'
                                                                    ],
                                                                    [
                                                                        'type' => 'builder-paragraph',
                                                                        'tagName' => 'p',
                                                                        'content' => 'Chi tiết tính năng được mô tả ở đây.'
                                                                    ]
                                                                ]
                                                            ]
                                                        ]
                                                    ],
                                                    [
                                                        'type' => 'builder-divider',
                                                        'tagName' => 'hr'
                                                    ],
                                                    [
                                                        'type' => 'builder-spacer',
                                                        'tagName' => 'div'
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = '<section class="relative w-full"><div class="mx-auto max-w-7xl"><h2>Kiến Tạo Giá Trị Mới</h2><p>Giải pháp linh hoạt và hiện đại cho doanh nghiệp của bạn.</p><a href="https://example.com/services" target="_blank">Tìm hiểu thêm</a><div class="grid grid-cols-2 gap-8"><div><img src="/admin-assets/images/builder/hero-placeholder.svg" alt="Hero Demo" loading="lazy"></div><div><h3>Tính năng vượt trội</h3><p>Chi tiết tính năng được mô tả ở đây.</p></div></div><hr><div style="height:32px"></div></div></section>';
        $css = 'section { padding: 80px 0; } h2 { font-size: 36px; }';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $nestedTree,
            'published_html' => $html,
            'published_css' => $css,
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->page->refresh();
        $saved = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertNotNull($saved);

        // Verify root section
        $section = $saved['pages'][0]['frames'][0]['component']['components'][0];
        $this->assertSame('builder-section', $section['type']);

        // Verify container
        $container = $section['components'][0];
        $this->assertSame('builder-container', $container['type']);
        $this->assertCount(6, $container['components']);

        // Verify components inside container
        $this->assertSame('builder-heading', $container['components'][0]['type']);
        $this->assertSame('builder-paragraph', $container['components'][1]['type']);
        $this->assertSame('builder-button', $container['components'][2]['type']);
        $this->assertSame('builder-columns', $container['components'][3]['type']);
        $this->assertSame('builder-divider', $container['components'][4]['type']);
        $this->assertSame('builder-spacer', $container['components'][5]['type']);

        // Verify Columns & nested Column children
        $columns = $container['components'][3];
        $this->assertCount(2, $columns['components']);
        $col1 = $columns['components'][0];
        $col2 = $columns['components'][1];
        $this->assertSame('builder-column', $col1['type']);
        $this->assertSame('image', $col1['components'][0]['type']);
        $this->assertSame('general/hero-placeholder', $col1['components'][0]['mediaRef']);
        $this->assertSame('builder-column', $col2['type']);
        $this->assertSame('builder-heading', $col2['components'][0]['type']);
        $this->assertSame('builder-paragraph', $col2['components'][1]['type']);
    }

    /**
     * TEST M3.1: Responsive Styles & Media Queries Persistence (CSS Composer)
     * Desktop: 80px, Tablet: 48px, Mobile: 24px
     */
    public function test_responsive_styles_and_media_queries_persistence(): void
    {
        $projectDataWithResponsiveStyles = [
            'pages' => [
                [
                    'id' => 'page-responsive',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'builder-section',
                                        'attributes' => ['id' => 'sec-hero']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'styles' => [
                [
                    'selectors' => ['#sec-hero'],
                    'style' => [
                        'padding-top' => '80px',
                        'padding-bottom' => '80px'
                    ]
                ],
                [
                    'selectors' => ['#sec-hero'],
                    'mediaText' => '(max-width: 992px)',
                    'style' => [
                        'padding-top' => '48px',
                        'padding-bottom' => '48px'
                    ]
                ],
                [
                    'selectors' => ['#sec-hero'],
                    'mediaText' => '(max-width: 480px)',
                    'style' => [
                        'padding-top' => '24px',
                        'padding-bottom' => '24px'
                    ]
                ]
            ]
        ];

        $css = <<<'CSS'
#sec-hero {
  padding-top: 80px;
  padding-bottom: 80px;
}
@media (max-width: 992px) {
  #sec-hero {
    padding-top: 48px;
    padding-bottom: 48px;
  }
}
@media (max-width: 480px) {
  #sec-hero {
    padding-top: 24px;
    padding-bottom: 24px;
  }
}
CSS;

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectDataWithResponsiveStyles,
            'published_html' => '<section id="sec-hero">Content</section>',
            'published_css' => $css,
        ]);

        $response->assertOk();
        $this->page->refresh();

        $savedProject = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertCount(3, $savedProject['styles']);
        $this->assertSame('80px', $savedProject['styles'][0]['style']['padding-top']);
        $this->assertSame('(max-width: 992px)', $savedProject['styles'][1]['mediaText']);
        $this->assertSame('48px', $savedProject['styles'][1]['style']['padding-top']);
        $this->assertSame('(max-width: 480px)', $savedProject['styles'][2]['mediaText']);
        $this->assertSame('24px', $savedProject['styles'][2]['style']['padding-top']);

        // Assert CSS contains media queries
        $savedCss = $savedProject['_draft']['css'];
        $this->assertStringContainsString('@media (max-width: 992px)', $savedCss);
        $this->assertStringContainsString('@media (max-width: 480px)', $savedCss);
        $this->assertStringContainsString('padding-top: 80px', $savedCss);
        $this->assertStringContainsString('padding-top: 48px', $savedCss);
        $this->assertStringContainsString('padding-top: 24px', $savedCss);
    }

    /**
     * TEST M3.1: Responsive Typography Media Queries
     * Desktop: 48px, Tablet: 38px, Mobile: 30px
     */
    public function test_responsive_typography_media_queries(): void
    {
        $css = <<<'CSS'
.hero-heading {
  font-size: 48px;
}
@media (max-width: 992px) {
  .hero-heading {
    font-size: 38px;
  }
}
@media (max-width: 480px) {
  .hero-heading {
    font-size: 30px;
  }
}
CSS;

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => '<h1 class="hero-heading">Tiêu đề lớn</h1>',
            'published_css' => $css,
        ]);

        $response->assertOk();
        $this->page->refresh();

        $savedCss = $this->page->getTranslation('published_css', 'vi', false);
        $this->assertStringContainsString('font-size: 48px', $savedCss);
        $this->assertStringContainsString('@media (max-width: 992px)', $savedCss);
        $this->assertStringContainsString('font-size: 38px', $savedCss);
        $this->assertStringContainsString('@media (max-width: 480px)', $savedCss);
        $this->assertStringContainsString('font-size: 30px', $savedCss);
    }

    /**
     * TEST M3.1: Responsive Grid & Columns Layout
     */
    public function test_responsive_grid_and_columns_layout(): void
    {
        $css = <<<'CSS'
.builder-grid-3 {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 24px;
}
@media (max-width: 992px) {
  .builder-grid-3 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}
@media (max-width: 480px) {
  .builder-grid-3 {
    grid-template-columns: 1fr;
  }
}
.builder-columns-2 {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 32px;
}
@media (max-width: 768px) {
  .builder-columns-2 {
    grid-template-columns: 1fr;
  }
}
CSS;

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => '<div class="builder-grid-3"><div>A</div><div>B</div><div>C</div></div><div class="builder-columns-2"><div>Col 1</div><div>Col 2</div></div>',
            'published_css' => $css,
        ]);

        $response->assertOk();
        $this->page->refresh();

        $savedCss = $this->page->getTranslation('published_css', 'vi', false);
        $this->assertStringContainsString('grid-template-columns: repeat(3, minmax(0, 1fr))', $savedCss);
        $this->assertStringContainsString('grid-template-columns: 1fr', $savedCss);
    }

    /**
     * TEST M3.1: Video Security Whitelist (YouTube & Vimeo allowed, malicious iframe stripped)
     */
    public function test_video_security_whitelist(): void
    {
        $validHtml = '<div class="video-box"><iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe><iframe src="https://player.vimeo.com/video/123456" allowfullscreen></iframe></div>';

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $validHtml,
            'published_css' => '',
        ])->assertOk();

        $this->page->refresh();
        $savedHtml = $this->page->getTranslation('published_html', 'vi', false);
        $this->assertStringContainsString('https://www.youtube.com/embed/dQw4w9WgXcQ', $savedHtml);
        $this->assertStringContainsString('https://player.vimeo.com/video/123456', $savedHtml);

        // Untrusted / Malicious iframe host
        $maliciousHtml = '<div class="video-box"><iframe src="https://attacker.com/exploit.html"></iframe><iframe src="javascript:alert(1)"></iframe></div>';

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $maliciousHtml,
            'published_css' => '',
        ])->assertOk();

        $this->page->refresh();
        $cleanHtml = $this->page->getTranslation('published_html', 'vi', false);
        $this->assertStringNotContainsString('attacker.com', $cleanHtml);
        $this->assertStringNotContainsString('javascript:', $cleanHtml);
    }

    /**
     * TEST M3.1: Clean Public Output & Icon Rendering Strategy
     */
    public function test_publish_m3_page_and_verify_clean_semantic_html(): void
    {
        $html = '<section class="relative w-full"><div class="mx-auto max-w-7xl"><h2>Kiến Tạo Giá Trị Mới</h2><p>Giải pháp linh hoạt.</p><a href="https://example.com/services" target="_blank">Tìm hiểu thêm</a><iconify-icon icon="solar:star-bold" class="text-primary"></iconify-icon></div></section>';
        $css = 'section { background-color: #ffffff; }';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $html,
            'published_css' => $css,
        ]);

        $response->assertOk();
        $this->page->refresh();
        $this->assertTrue($this->page->is_active);

        // Verify public guest rendering
        auth()->logout();
        $publicRes = $this->get('/vi/pages/' . $this->page->slug);
        $publicRes->assertOk();
        $publicRes->assertSee('Kiến Tạo Giá Trị Mới');
        $publicRes->assertSee('https://example.com/services');
        $publicRes->assertSee('iconify-icon icon="solar:star-bold"', false);
        $publicRes->assertDontSee('data-gjs-', false);
        $publicRes->assertDontSee('grapes.min.js', false);
    }

    /**
     * TEST Security: Sanitize XSS attributes in published HTML
     */
    public function test_security_sanitizes_xss_in_published_components(): void
    {
        $maliciousHtml = '<section onclick="alert(1)"><div class="container"><h2 onmouseover="stealCookies()">Tiêu đề</h2><a href="javascript:alert(1)">Nút bấm độc hại</a><script>alert(1)</script></div></section>';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $maliciousHtml,
            'published_css' => '',
        ]);

        $response->assertOk();
        $this->page->refresh();

        $savedHtml = $this->page->getTranslation('published_html', 'vi', false);
        $this->assertStringNotContainsString('onclick', $savedHtml);
        $this->assertStringNotContainsString('onmouseover', $savedHtml);
        $this->assertStringNotContainsString('<script', $savedHtml);
        $this->assertStringNotContainsString('javascript:', $savedHtml);
    }
}
