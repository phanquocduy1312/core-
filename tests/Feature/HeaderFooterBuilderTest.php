<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\ProjectSetting;
use App\Models\Role;
use App\Models\User;
use App\Services\PagePartialResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class HeaderFooterBuilderTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );
        $role = Role::query()->create(['name' => 'Page editor', 'permissions' => ['manage_pages']]);
        $this->admin = User::factory()->create(['role_id' => $role->id]);
    }

    public function test_admin_can_access_builder_for_header_and_footer_partial(): void
    {
        $this->actingAs($this->admin);

        $headerPartial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'header',
            'title' => ['vi' => 'Header tùy biến'],
            'slug' => 'header-custom-test',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<header id="custom-test-header">Logo & Menu</header>'],
            'published_css' => ['vi' => ''],
            'is_active' => true,
        ]);

        $response = $this->get("/vi/admin/pages/{$headerPartial->id}/builder");
        $response->assertOk();
        $response->assertViewIs('admin.pages.builder');
        $response->assertViewHas('page', fn ($p) => $p->id === $headerPartial->id);

        $canvasResponse = $this->get("/vi/admin/pages/{$headerPartial->id}/builder/canvas");
        $canvasResponse->assertOk();
        $canvasResponse->assertViewIs('admin.pages.builder-canvas');
    }

    public function test_admin_can_save_and_publish_header_partial_in_builder(): void
    {
        $this->actingAs($this->admin);

        $headerPartial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'header',
            'title' => ['vi' => 'Header tùy biến'],
            'slug' => 'header-custom-test-2',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<header id="custom-test-header">Ban đầu</header>'],
            'is_active' => true,
        ]);

        $saveResponse = $this->postJson("/vi/admin/pages/{$headerPartial->id}/builder/save", [
            'content_locale' => 'vi',
            'published_html' => '<header id="custom-test-header">Bản nháp mới</header>',
            'published_css' => '#custom-test-header { color: red; }',
            'builder_data' => [
                'pages' => [
                    [
                        'component' => [
                            'type' => 'wrapper',
                            'components' => [
                                ['type' => 'text', 'content' => 'Bản nháp mới'],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $saveResponse->assertOk();
        $saveResponse->assertJsonPath('success', true);

        $publishResponse = $this->postJson("/vi/admin/pages/{$headerPartial->id}/builder/publish", [
            'content_locale' => 'vi',
            'published_html' => '<header id="custom-test-header">Nội dung đã xuất bản</header>',
            'published_css' => '#custom-test-header { background: #000; }',
            'builder_data' => [
                'pages' => [
                    [
                        'component' => [
                            'type' => 'wrapper',
                            'components' => [
                                ['type' => 'text', 'content' => 'Nội dung đã xuất bản'],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $publishResponse->assertOk();
        $publishResponse->assertJsonPath('success', true);

        $this->assertStringContainsString('Nội dung đã xuất bản', $headerPartial->fresh()->getTranslation('published_html', 'vi'));
    }

    public function test_published_header_partial_renders_in_storefront_layout(): void
    {
        $headerPartial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'header',
            'title' => ['vi' => 'Header trang chủ'],
            'slug' => 'header-home',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<div id="unique-builder-header">Header từ Builder</div>'],
            'is_active' => true,
        ]);

        ProjectSetting::query()->updateOrCreate(
            ['setting_key' => 'layout_partials'],
            ['setting_value' => ['header_id' => $headerPartial->id]],
        );

        $response = $this->get('/vi/gioi-thieu');
        $response->assertOk();
        $response->assertSee('unique-builder-header');
        $response->assertSee('Header từ Builder');
    }

    public function test_ensure_default_partials_exist_initializes_header_and_footer(): void
    {
        $this->assertSame(0, Page::query()->partials()->count());

        $resolver = app(PagePartialResolver::class);
        $result = $resolver->ensureDefaultPartialsExist();

        $this->assertArrayHasKey('header_id', $result);
        $this->assertArrayHasKey('footer_id', $result);
        $this->assertSame(2, Page::query()->partials()->count());

        $header = Page::query()->find($result['header_id']);
        $this->assertNotNull($header);
        $this->assertSame('header', $header->partial_role);
        $this->assertTrue($header->is_active);

        $footer = Page::query()->find($result['footer_id']);
        $this->assertNotNull($footer);
        $this->assertSame('footer', $footer->partial_role);
        $this->assertTrue($footer->is_active);
    }

    public function test_admin_can_access_and_publish_footer_partial_in_builder(): void
    {
        $this->actingAs($this->admin);

        $footerPartial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'footer',
            'title' => ['vi' => 'Footer tùy biến'],
            'slug' => 'footer-custom-test',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<footer id="custom-test-footer">Copyright 2026</footer>'],
            'published_css' => ['vi' => ''],
            'is_active' => true,
        ]);

        $response = $this->get("/vi/admin/pages/{$footerPartial->id}/builder");
        $response->assertOk();
        $response->assertViewIs('admin.pages.builder');
        $response->assertViewHas('canvasFooterHtml', '');

        $publishResponse = $this->postJson("/vi/admin/pages/{$footerPartial->id}/builder/publish", [
            'content_locale' => 'vi',
            'published_html' => '<footer id="custom-test-footer">Footer đã được xuất bản mới</footer>',
            'published_css' => '#custom-test-footer { color: #fff; }',
            'builder_data' => ['version' => 1, 'locales' => []],
        ]);
        $publishResponse->assertOk();
        $this->assertStringContainsString('Footer đã được xuất bản mới', $footerPartial->fresh()->getTranslation('published_html', 'vi'));
    }

    public function test_regular_page_builder_provides_header_and_footer_builder_urls(): void
    {
        $this->actingAs($this->admin);

        $resolver = app(PagePartialResolver::class);
        $partials = $resolver->ensureDefaultPartialsExist();

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang bài viết'],
            'slug' => 'trang-bai-viet',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<p>Thân trang</p>'],
            'is_active' => true,
        ]);

        $response = $this->get("/vi/admin/pages/{$page->id}/builder");
        $response->assertOk();
        $response->assertViewHas('headerBuilderUrl', fn ($url) => str_contains($url, (string) $partials['header_id']));
        $response->assertViewHas('footerBuilderUrl', fn ($url) => str_contains($url, (string) $partials['footer_id']));
    }

    public function test_partials_index_displays_builder_button(): void
    {
        $this->actingAs($this->admin);

        $resolver = app(PagePartialResolver::class);
        $resolver->ensureDefaultPartialsExist();

        $response = $this->get('/vi/admin/partials');
        $response->assertOk();
        $response->assertSee('Thiết kế (Builder)');
    }

    public function test_deeply_nested_builder_data_can_be_saved_and_published(): void
    {
        $this->actingAs($this->admin);

        $footerPartial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'footer',
            'title' => ['vi' => 'Footer sâu'],
            'slug' => 'footer-deep-test',
            'builder_data' => ['vi' => [], 'en' => [], 'ko' => []],
            'published_html' => ['vi' => '<footer>Ban đầu</footer>'],
            'is_active' => true,
        ]);

        // Build a deeply nested structure (40+ levels) resembling complex GrapesJS DOM
        $deepTree = ['type' => 'text', 'content' => 'Deep node'];
        for ($i = 0; $i < 45; $i++) {
            $deepTree = [
                'type' => 'block',
                'components' => [$deepTree],
            ];
        }

        $publishResponse = $this->postJson("/vi/admin/pages/{$footerPartial->id}/builder/publish", [
            'content_locale' => 'vi',
            'published_html' => '<footer>Nội dung footer sâu đã xuất bản</footer>',
            'published_css' => 'footer { margin: 0; }',
            'builder_data' => [
                'pages' => [
                    [
                        'component' => $deepTree,
                    ],
                ],
            ],
        ]);

        $publishResponse->assertOk();
        $publishResponse->assertJsonPath('success', true);

        $fresh = $footerPartial->fresh();
        $this->assertStringContainsString('Nội dung footer sâu đã xuất bản', $fresh->getTranslation('published_html', 'vi'));
        $this->assertIsArray($fresh->getTranslation('builder_data', 'vi'));
    }
}

