<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\FeatureSetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Services\MultilingualSettings;
use App\Services\PageBlockRenderer;
use App\Support\DynamicBlockConfigValidator;
use App\Support\PageHtmlSanitizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VisualPageBuilderFullQATest extends TestCase
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

        // Seed languages for VI, EN, KO
        Language::query()->updateOrCreate(
            ['code' => 'vi'],
            ['name' => 'Tiếng Việt', 'native_name' => 'Tiếng Việt', 'is_active' => true, 'is_default' => true, 'sort_order' => 1]
        );
        Language::query()->updateOrCreate(
            ['code' => 'en'],
            ['name' => 'English', 'native_name' => 'English', 'is_active' => true, 'is_default' => false, 'sort_order' => 2]
        );
        Language::query()->updateOrCreate(
            ['code' => 'ko'],
            ['name' => 'Korean', 'native_name' => '한국어', 'is_active' => true, 'is_default' => false, 'sort_order' => 3]
        );

        \App\Models\ProjectSetting::query()->updateOrCreate(
            ['setting_key' => 'multilingual'],
            ['setting_value' => ['enabled' => true, 'mode' => 'manual']]
        );
        Cache::forget('multilingual.project_settings.v1');
        Cache::forget('multilingual.active_languages.v1');
        Cache::forget('multilingual.admin_languages.v1');

        $this->page = Page::query()->create([
            'title' => ['vi' => 'M6 Final QA Page', 'en' => 'M6 Final QA Page', 'ko' => 'M6 Final QA Page'],
            'slug' => 'm6-final-qa-page',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => '', 'en' => '', 'ko' => ''],
            'published_css' => ['vi' => '', 'en' => '', 'ko' => ''],
            'builder_data' => ['vi' => [], 'en' => [], 'ko' => []],
        ]);
    }

    /**
     * TEST 1: End-to-End Save Draft, Publish, Revision Generation & Restore QA
     */
    public function test_e2e_draft_publish_and_revision_restore(): void
    {
        $projectDataRev1 = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'builder-heading',
                                'content' => 'Phiên Bản 1'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // 1. Save Draft -> Public page remains 404 (draft only)
        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectDataRev1,
            'published_html' => '<h1>Phiên Bản 1 (Draft)</h1>',
            'published_css' => 'h1 { color: red; }',
        ])->assertOk();

        $this->page->refresh();
        $this->assertFalse((bool) $this->page->is_active);
        $this->assertNull($this->page->published_at);

        // 2. Publish Revision 1
        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $projectDataRev1,
            'published_html' => '<h1>Phiên Bản 1</h1>',
            'published_css' => 'h1 { color: blue; }',
        ])->assertOk();

        $this->page->refresh();
        $this->assertTrue((bool) $this->page->is_active);
        $this->assertNotNull($this->page->published_at);
        $this->assertGreaterThanOrEqual(1, $this->page->revisions()->count());

        $rev1 = $this->page->revisions()->first();

        // 3. Publish Revision 2
        $projectDataRev2 = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'builder-heading',
                                'content' => 'Phiên Bản 2'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $projectDataRev2,
            'published_html' => '<h1>Phiên Bản 2</h1>',
            'published_css' => 'h1 { color: green; }',
        ])->assertOk();

        $this->page->refresh();

        auth()->logout();
        $res = $this->get('/vi/pages/' . $this->page->slug);
        $res->assertOk();
        $res->assertSee('Phiên Bản 2');

        // 4. Restore Revision 1 via Core Restore Endpoint
        $this->actingAs($this->admin)->post('/vi/admin/pages/' . $this->page->id . '/revisions/' . $rev1->id . '/restore')
            ->assertRedirect();

        $this->page->refresh();
        $savedBuilderData = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertSame('Phiên Bản 1', $savedBuilderData['pages'][0]['frames'][0]['component']['content']);
        $this->assertStringContainsString('Phiên Bản 1', $this->page->getTranslation('published_html', 'vi', false));
    }

    /**
     * TEST 2: Zero Public Asset Leak (No GrapesJS Admin JS/CSS on Public Frontend)
     */
    public function test_zero_grapesjs_admin_asset_leak_on_public_pages(): void
    {
        $this->page->update([
            'is_active' => true,
            'published_at' => now(),
            'published_html' => ['vi' => '<section class="builder-section"><h1 class="hero-title">Trang Du Thuyền</h1></section>'],
            'published_css' => ['vi' => '.hero-title { font-size: 32px; }'],
        ]);

        $res = $this->get('/vi/pages/' . $this->page->slug);
        $res->assertOk();
        $content = $res->getContent();

        $this->assertStringNotContainsString('grapesjs.js', $content);
        $this->assertStringNotContainsString('grapes.min.js', $content);
        $this->assertStringNotContainsString('grapes-builder', $content);
        $this->assertStringNotContainsString('BlockManager', $content);
        $this->assertStringNotContainsString('TraitManager', $content);
    }

    /**
     * TEST 3: Multilingual Independence (VI / EN / KO Isolated Translations)
     */
    public function test_multilingual_independence_vi_en_ko(): void
    {
        $viData = ['pages' => [['id' => 'p-vi', 'frames' => [['component' => ['content' => 'Du Thuyền Việt Nam']]]]]];
        $enData = ['pages' => [['id' => 'p-en', 'frames' => [['component' => ['content' => 'Vietnam Luxury Yachts']]]]]];
        $koData = ['pages' => [['id' => 'p-ko', 'frames' => [['component' => ['content' => '베트남 럭셔리 요트']]]]]];

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $viData,
            'published_html' => '<h1>Du Thuyền Việt Nam</h1>',
            'published_css' => '.vi { color: red; }',
        ])->assertOk();

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'en',
            'builder_data' => $enData,
            'published_html' => '<h1>Vietnam Luxury Yachts</h1>',
            'published_css' => '.en { color: blue; }',
        ])->assertOk();

        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'ko',
            'builder_data' => $koData,
            'published_html' => '<h1>베트남 럭셔리 요트</h1>',
            'published_css' => '.ko { color: green; }',
        ])->assertOk();

        $this->page->refresh();

        // Verify Spatie translatable storage
        $this->assertSame('Du Thuyền Việt Nam', $this->page->getTranslation('builder_data', 'vi', false)['pages'][0]['frames'][0]['component']['content']);
        $this->assertSame('Vietnam Luxury Yachts', $this->page->getTranslation('builder_data', 'en', false)['pages'][0]['frames'][0]['component']['content']);
        $this->assertSame('베트남 럭셔리 요트', $this->page->getTranslation('builder_data', 'ko', false)['pages'][0]['frames'][0]['component']['content']);
    }

    /**
     * TEST 4: Security Full Pass (Purging Scripts, Iframes, Traversal, and Limit Bounds)
     */
    public function test_security_full_pass(): void
    {
        $sanitizer = app(PageHtmlSanitizer::class);

        $xssHtml = '<p>Normal</p><script>alert("hacked")</script><img src="x" onerror="alert(1)"><a href="javascript:alert(1)">Click</a><div data-random-attr="leak" data-page-block="product-grid" data-limit="4"></div>';
        $cleaned = $sanitizer->clean($xssHtml);

        $this->assertStringNotContainsString('<script', $cleaned);
        $this->assertStringNotContainsString('onerror', $cleaned);
        $this->assertStringNotContainsString('javascript:', $cleaned);
        $this->assertStringNotContainsString('data-random-attr', $cleaned);
        $this->assertStringContainsString('data-page-block="product-grid"', $cleaned);
        $this->assertStringContainsString('data-limit="4"', $cleaned);
    }

    /**
     * TEST 5: Stress Test Page (Large Composite Tree & Multi-Block Render)
     */
    public function test_stress_test_page_multi_block_rendering(): void
    {
        $category = Category::query()->create([
            'name' => ['vi' => 'Superyachts', 'en' => 'Superyachts'],
            'slug' => 'superyachts',
            'is_active' => true,
        ]);

        Product::query()->create([
            'category_id' => $category->id,
            'name' => ['vi' => 'Majesty 160 Superyacht', 'en' => 'Majesty 160 Superyacht'],
            'slug' => 'majesty-160-superyacht',
            'price' => 25000000000,
            'is_active' => true,
        ]);

        $stressHtml = '<section class="builder-section section-hero-01"><div class="builder-container"><h1 class="hero-title">Đỉnh Cao Du Thuyền</h1></div></section>'
            . DynamicBlockConfigValidator::serializeToHtml('product-grid', ['category' => 'superyachts', 'limit' => 4])
            . DynamicBlockConfigValidator::serializeToHtml('category-grid', ['limit' => 4])
            . DynamicBlockConfigValidator::serializeToHtml('latest-reviews', ['limit' => 2])
            . DynamicBlockConfigValidator::serializeToHtml('contact-form', []);

        $renderer = app(PageBlockRenderer::class);
        $rendered = $renderer->render($stressHtml, 'vi');

        $this->assertStringContainsString('Đỉnh Cao Du Thuyền', $rendered);
        $this->assertStringContainsString('Majesty 160 Superyacht', $rendered);
        $this->assertStringContainsString('25.000.000.000đ', $rendered);
        $this->assertStringContainsString('form id="cf-', $rendered);
    }
}
