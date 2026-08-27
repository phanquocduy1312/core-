<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\PageBlockRenderer;
use App\Services\PageBuilderService;
use App\Support\DynamicBlockConfigValidator;
use App\Support\PageHtmlSanitizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VisualPageBuilderDynamicBlocksTest extends TestCase
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
            'title' => ['vi' => 'M5 Dynamic Test', 'en' => 'M5 Dynamic Test'],
            'slug' => 'm5-dynamic-test',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => ''],
            'published_css' => ['vi' => ''],
            'builder_data' => ['vi' => []],
        ]);
    }

    /**
     * TEST 1: Centralized Validator & Strict data-* Sanitizer
     */
    public function test_centralized_validator_and_strict_data_sanitizer(): void
    {
        $sanitizer = app(PageHtmlSanitizer::class);

        // 1. Strict data-* whitelist test
        $dirtyHtml = '<div data-page-block="product-grid" data-limit="4" data-random-test="malicious" data-gjs-type="custom" data-editor-config="leak" onclick="alert(1)">Test Content</div>';
        $cleaned = $sanitizer->clean($dirtyHtml);

        $this->assertStringContainsString('data-page-block="product-grid"', $cleaned);
        $this->assertStringContainsString('data-limit="4"', $cleaned);
        $this->assertStringNotContainsString('data-random-test', $cleaned);
        $this->assertStringNotContainsString('data-gjs-type', $cleaned);
        $this->assertStringNotContainsString('data-editor-config', $cleaned);
        $this->assertStringNotContainsString('onclick', $cleaned);

        // 2. Centralized Config -> HTML Serializer test
        $serializedHtml = DynamicBlockConfigValidator::serializeToHtml('product-grid', [
            'category' => 'luxury-yachts',
            'limit' => 4,
            'query' => 'featured',
            'columns' => 4,
            'gap' => 20,
            'align' => 'center'
        ]);

        $this->assertSame(
            '<div data-page-block="product-grid" data-category="luxury-yachts" data-limit="4" data-query="featured" data-columns="4" data-gap="20" data-align="center"></div>',
            $serializedHtml
        );
    }

    /**
     * TEST 2: Runtime Clamping & Public Validation on Malicious Stored HTML
     */
    public function test_runtime_clamping_and_validation_on_malicious_stored_html(): void
    {
        $renderer = app(PageBlockRenderer::class);

        // 1. Limit 999999999 clamped, negative columns clamped, malicious query sanitized
        $maliciousHtml = '<div data-page-block="product-grid" data-limit="999999999" data-columns="-5" data-query="DROP TABLE users;"></div>';
        $rendered = $renderer->render($maliciousHtml, 'vi');
        $this->assertNotEmpty($rendered);

        // 2. Malicious page block type rejected safely
        $evilBlockHtml = '<div data-page-block="../../evil-block">Evil</div>';
        $renderedEvil = $renderer->render($evilBlockHtml, 'vi');
        $this->assertStringContainsString('data-page-block="../../evil-block"', $renderedEvil); // Not processed by any dynamic resolver

        // 3. Negative partial ID safe failure
        $invalidPartialHtml = '<div data-page-block="partial" data-partial-id="-1"></div>';
        $renderedPartial = $renderer->render($invalidPartialHtml, 'vi');
        $this->assertSame('<div data-page-block="partial" data-partial-id="-1"></div>', trim($renderedPartial));
    }

    /**
     * TEST 3: Canonical Dynamic Config in builder_data (NO Snapshot Data, NO Duplicated Attributes)
     */
    public function test_canonical_dynamic_config_in_builder_data(): void
    {
        $category = Category::query()->create([
            'name' => ['vi' => 'Du Thuyền Cao Cấp', 'en' => 'Luxury Yachts'],
            'slug' => 'luxury-yachts',
            'is_active' => true,
        ]);

        $product = Product::query()->create([
            'category_id' => $category->id,
            'name' => ['vi' => 'Majesty 120 Vàng', 'en' => 'Majesty 120 Gold'],
            'slug' => 'majesty-120-vang',
            'price' => 5000000000,
            'is_active' => true,
        ]);

        // Canonical Project Data has only { type, dynamicType, config }
        $canonicalProjectData = [
            'pages' => [
                [
                    'id' => 'page-m5',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'builder-dynamic-product-grid',
                                        'dynamicType' => 'product-grid',
                                        'config' => [
                                            'category' => 'luxury-yachts',
                                            'limit' => 4,
                                            'query' => 'latest',
                                            'columns' => 4,
                                            'align' => 'left',
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $generatedHtml = DynamicBlockConfigValidator::serializeToHtml(
            'product-grid',
            $canonicalProjectData['pages'][0]['frames'][0]['component']['components'][0]['config']
        );

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $canonicalProjectData,
            'published_html' => $generatedHtml,
            'published_css' => '',
        ])->assertOk();

        // 1. Stage A: Project Data inspection
        $this->page->refresh();
        $saved = $this->page->getTranslation('builder_data', 'vi', false);
        $block = $saved['pages'][0]['frames'][0]['component']['components'][0];
        $this->assertSame('builder-dynamic-product-grid', $block['type']);
        $this->assertSame('product-grid', $block['dynamicType']);
        $this->assertSame('luxury-yachts', $block['config']['category']);
        $this->assertSame(4, $block['config']['limit']);
        $this->assertArrayNotHasKey('attributes', $block); // No duplicate runtime attributes stored
        $this->assertArrayNotHasKey('components', $block); // No ephemeral preview DOM stored

        // 2. Stage B: Stored published_html inspection
        $storedHtml = $this->page->getTranslation('published_html', 'vi', false);
        $this->assertStringContainsString('data-page-block="product-grid"', $storedHtml);
        $this->assertStringContainsString('data-category="luxury-yachts"', $storedHtml);
        $this->assertStringContainsString('data-limit="4"', $storedHtml);

        // 3. Stage C: Page after PageBlockRenderer
        auth()->logout();
        $res = $this->get('/vi/pages/' . $this->page->slug);
        $res->assertOk();
        $res->assertSee('Majesty 120 Vàng');
        $res->assertSee('5.000.000.000đ');

        // 4. Live DB update proof
        $product->update([
            'name' => ['vi' => 'Majesty 120 Bạch Kim', 'en' => 'Majesty 120 Platinum'],
            'price' => 9000000000,
        ]);
        Cache::flush();

        $res2 = $this->get('/vi/pages/' . $this->page->slug);
        $res2->assertOk();
        $res2->assertSee('Majesty 120 Bạch Kim');
        $res2->assertSee('9.000.000.000đ');
        $res2->assertDontSee('Majesty 120 Vàng');
    }

    /**
     * TEST 4: Post List Live Data Proof & Partial Reference Propagation
     */
    public function test_post_list_and_partial_live_updates(): void
    {
        $postCategory = PostCategory::query()->create([
            'name' => ['vi' => 'Tin Tức Du Thuyền', 'en' => 'Yacht News'],
            'slug' => 'tin-tuc-du-thuyen',
            'is_active' => true,
        ]);

        $post = Post::query()->create([
            'category_id' => $postCategory->id,
            'title' => ['vi' => 'Tin A: Khám Phá Du Thuyền Mới', 'en' => 'News A'],
            'slug' => 'tin-a-kham-pha-du-thuyen-moi',
            'summary' => ['vi' => 'Tóm tắt tin A', 'en' => 'Summary A'],
            'content' => ['vi' => 'Nội dung chi tiết', 'en' => 'Detail content'],
            'is_active' => true,
            'published_at' => now()->subDay(),
        ]);

        $partial = Page::query()->create([
            'title' => ['vi' => 'Banner Giảm Giá', 'en' => 'Discount Banner'],
            'slug' => 'partial-banner',
            'type' => 'partial',
            'partial_role' => 'generic',
            'is_active' => true,
            'published_html' => ['vi' => '<div class="banner-box">Ưu Đãi Mùa Hè 2026 - Giảm 10%</div>'],
        ]);

        $canonicalProjectData = [
            'pages' => [
                [
                    'id' => 'page-m5',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'builder-dynamic-post-list',
                                        'dynamicType' => 'post-list',
                                        'config' => [
                                            'category' => 'tin-tuc-du-thuyen',
                                            'limit' => 3,
                                            'columns' => 3,
                                        ]
                                    ],
                                    [
                                        'type' => 'builder-dynamic-partial',
                                        'dynamicType' => 'partial',
                                        'config' => [
                                            'partialId' => $partial->id,
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = DynamicBlockConfigValidator::serializeToHtml('post-list', ['category' => 'tin-tuc-du-thuyen', 'limit' => 3, 'columns' => 3])
            . DynamicBlockConfigValidator::serializeToHtml('partial', ['partialId' => $partial->id]);

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $canonicalProjectData,
            'published_html' => $html,
            'published_css' => '',
        ])->assertOk();

        // 1. Verify Guest sees initial data
        auth()->logout();
        $res1 = $this->get('/vi/pages/' . $this->page->slug);
        $res1->assertOk();
        $res1->assertSee('Tin A: Khám Phá Du Thuyền Mới');
        $res1->assertSee('Ưu Đãi Mùa Hè 2026 - Giảm 10%');

        // 2. Update Post directly in DB
        $post->update([
            'title' => ['vi' => 'Tin B: Siêu Du Thuyền Cập Bến Sài Gòn', 'en' => 'News B'],
        ]);
        Cache::flush();

        // 3. Update Partial via PageBuilderService
        app(PageBuilderService::class)->updateLocale($partial, 'vi', [
            'published_html' => '<div class="banner-box">Ưu Đãi Mùa Thu 2026 - Giảm 30%</div>',
            'content_locale' => 'vi',
        ], $this->admin->id);

        // 4. Reload page without republishing - Must automatically reflect both updates!
        $res2 = $this->get('/vi/pages/' . $this->page->slug);
        $res2->assertOk();
        $res2->assertSee('Tin B: Siêu Du Thuyền Cập Bến Sài Gòn');
        $res2->assertDontSee('Tin A: Khám Phá Du Thuyền Mới');
        $res2->assertSee('Ưu Đãi Mùa Thu 2026 - Giảm 30%');
        $res2->assertDontSee('Ưu Đãi Mùa Hè 2026 - Giảm 10%');
    }

    /**
     * TEST 5: Product Tabs Integration & Contact Form Safe Endpoint
     */
    public function test_product_tabs_and_contact_form(): void
    {
        $category = Category::query()->create([
            'name' => ['vi' => 'Yacht Tabs Cat', 'en' => 'Yacht Tabs Cat'],
            'slug' => 'yacht-tabs-cat',
            'is_active' => true,
        ]);

        Product::query()->create([
            'category_id' => $category->id,
            'name' => ['vi' => 'Yacht In Tab', 'en' => 'Yacht In Tab'],
            'slug' => 'yacht-in-tab',
            'price' => 1200000000,
            'is_active' => true,
        ]);

        $html = DynamicBlockConfigValidator::serializeToHtml('product-tabs', ['limit' => 8, 'columns' => 4])
            . DynamicBlockConfigValidator::serializeToHtml('contact-form', []);

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => ['pages' => []],
            'published_html' => $html,
            'published_css' => '',
        ])->assertOk();

        auth()->logout();
        $res = $this->get('/vi/pages/' . $this->page->slug);
        $res->assertOk();
        $res->assertSee('Yacht In Tab');
        $res->assertSee('1.200.000.000đ');
        $res->assertSee('form id="cf-', false);
        $res->assertSee('api\/public\/contact', false);
    }
}
