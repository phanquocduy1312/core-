<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\ProjectSetting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuilderWorkflowRegressionTest extends TestCase
{
    use RefreshDatabase;

    private User $editor;

    protected function setUp(): void
    {
        parent::setUp();
        FeatureSetting::updateOrCreate(['feature_code' => 'cms_page'], ['is_enabled' => true]);
        $role = Role::create(['name' => 'Editor', 'permissions' => ['manage_pages', 'manage_media']]);
        $this->editor = User::factory()->create(['role_id' => $role->id]);
    }

    private function page(array $overrides = []): Page
    {
        return Page::create(array_replace([
            'title' => ['vi' => 'Trang nghiệp vụ'], 'slug' => 'gioi-thieu', 'type' => 'page',
            'is_active' => true, 'published_at' => now()->subDay(),
            'published_html' => ['vi' => '<h1 id="workflow-live">Nội dung công khai</h1>'],
            'published_css' => ['vi' => '#workflow-live{color:blue}'], 'builder_data' => ['vi' => []],
        ], $overrides));
    }

    private function payload(string $text = 'Bản thiết kế mới'): array
    {
        return ['content_locale' => 'vi', 'published_html' => '<h1 id="workflow-draft">'.$text.'</h1>',
            'published_css' => '#workflow-draft{color:red}',
            'builder_data' => ['pages' => [['component' => ['type' => 'wrapper', 'components' => [['tagName' => 'h1', 'content' => $text]]]]]],
        ];
    }

    public function test_saving_draft_keeps_live_html_css_and_preview_reopens_draft(): void
    {
        $page = $this->page();
        $this->actingAs($this->editor)->postJson("/vi/admin/pages/{$page->id}/builder/save", $this->payload())->assertOk();
        $this->assertStringContainsString('Nội dung công khai', $page->fresh()->getTranslation('published_html', 'vi'));
        $this->assertSame('#workflow-live{color:blue}', $page->fresh()->getTranslation('published_css', 'vi'));
        $this->get("/vi/admin/pages/{$page->id}/preview")->assertOk()->assertSee('Bản thiết kế mới');
        $this->get("/vi/admin/pages/{$page->id}/builder")->assertOk()->assertSee('Bản thiết kế mới');
        $this->postJson("/vi/admin/pages/{$page->id}/builder/publish", $this->payload())->assertOk();
        $this->assertStringContainsString('Bản thiết kế mới', $page->fresh()->getTranslation('published_html', 'vi'));
    }

    public function test_named_site_routes_render_published_builder_content(): void
    {
        $page = $this->page();
        foreach (['/gioi-thieu', '/about-luxlight', '/vi/gioi-thieu', '/vi/pages/gioi-thieu'] as $url) {
            $this->get($url)->assertOk()->assertSee('workflow-live');
        }
        $this->actingAs($this->editor)->postJson("/vi/admin/pages/{$page->id}/builder/publish", $this->payload())->assertOk();
        foreach (['/gioi-thieu', '/about-luxlight', '/vi/gioi-thieu', '/vi/pages/gioi-thieu'] as $url) {
            $this->get($url)->assertOk()->assertSee('workflow-draft')->assertDontSee('workflow-live');
        }
    }

    public function test_custom_header_builder_link_and_css_match_selected_partial(): void
    {
        $first = $this->page(['type' => 'partial', 'partial_role' => 'header', 'slug' => 'first-header']);
        $custom = $this->page(['type' => 'partial', 'partial_role' => 'header', 'slug' => 'custom-header',
            'published_html' => ['vi' => '<header id="custom-header">Header riêng</header>'],
            'published_css' => ['vi' => '#custom-header{background:purple}']]);
        ProjectSetting::updateOrCreate(['setting_key' => 'layout_partials'], ['setting_value' => ['header_id' => $first->id]]);
        $page = $this->page(['header_mode' => 'custom', 'header_partial_id' => $custom->id]);
        $this->actingAs($this->editor)->get("/vi/admin/pages/{$page->id}/builder")
            ->assertOk()->assertViewHas('headerBuilderUrl', fn ($url) => str_contains($url, "/pages/{$custom->id}/builder"));
        $this->get('/vi/pages/gioi-thieu')->assertOk()->assertSee('#custom-header{background:purple}', false);
    }

    public function test_none_header_mode_has_no_edit_header_shortcut(): void
    {
        $header = $this->page(['type' => 'partial', 'partial_role' => 'header', 'slug' => 'header']);
        $page = $this->page(['header_mode' => 'none']);
        $this->actingAs($this->editor)->get("/vi/admin/pages/{$page->id}/builder")
            ->assertOk()->assertViewHas('headerBuilderUrl', null);
    }

    public function test_save_draft_of_shared_header_does_not_change_public_header(): void
    {
        $header = $this->page(['type' => 'partial', 'partial_role' => 'header', 'slug' => 'header']);
        ProjectSetting::updateOrCreate(['setting_key' => 'layout_partials'], ['setting_value' => ['header_id' => $header->id]]);
        $this->page(['published_html' => ['vi' => '<p>Thân trang</p>']]);
        $this->actingAs($this->editor)->postJson("/vi/admin/pages/{$header->id}/builder/save", $this->payload())->assertOk();
        $this->get('/vi/pages/gioi-thieu')->assertOk()->assertSee('workflow-live')->assertDontSee('workflow-draft');
    }

    public function test_invalid_content_locale_does_not_overwrite_default_locale(): void
    {
        $page = $this->page();
        $this->actingAs($this->editor)->postJson("/vi/admin/pages/{$page->id}/builder/save", array_replace($this->payload(), ['content_locale' => 'xx']))->assertUnprocessable();
        $this->assertStringContainsString('Nội dung công khai', $page->fresh()->getTranslation('published_html', 'vi'));
    }

    public function test_dynamic_alignment_cannot_inject_event_attributes(): void
    {
        \App\Models\Category::create(['name' => ['vi' => 'Danh mục'], 'slug' => 'category', 'is_active' => true]);
        $page = $this->page();
        $payload = $this->payload();
        $payload['published_html'] = '<section data-page-block="category-grid" data-align="left&quot; onmouseover=&quot;alert(1)&quot; data-a=&quot;"></section>';
        $this->actingAs($this->editor)->postJson("/vi/admin/pages/{$page->id}/builder/publish", $payload)->assertOk();
        $html = $this->get('/vi/pages/gioi-thieu')->assertOk()->getContent();
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $this->assertSame(0, (new \DOMXPath($dom))->query('//*[@onmouseover]')->length);
    }

    public function test_unsaved_preview_sanitizes_html_and_rejects_css_breakout(): void
    {
        $this->actingAs($this->editor);
        $data = ['locale' => 'vi', 'title' => 'Xem trước', 'html' => '<h1>Hợp lệ</h1><script>alert(1)</script><img src="/x.png" onerror="alert(2)">', 'css' => ''];
        $url = $this->postJson('/vi/admin/pages/preview-store', $data)->assertOk()->json('preview_url');
        $this->get($url)->assertOk()->assertSee('Hợp lệ')->assertDontSee('<script>alert(1)</script>', false)->assertDontSee('onerror="alert(2)"', false);
        $data['css'] = '</style><script>alert(3)</script>';
        $this->postJson('/vi/admin/pages/preview-store', $data)->assertUnprocessable();
    }

    public function test_nested_shared_block_styles_are_rendered(): void
    {
        $partial = $this->page(['type' => 'partial', 'partial_role' => 'generic', 'slug' => 'shared-cta',
            'published_html' => ['vi' => '<aside id="shared-cta">Tư vấn</aside>'],
            'published_css' => ['vi' => '#shared-cta{background:orange}']]);
        $page = $this->page(['published_html' => ['vi' => '<div data-page-block="partial" data-partial-id="'.$partial->id.'"></div>']]);
        $this->get('/vi/pages/gioi-thieu')->assertOk()->assertSee('#shared-cta{background:orange}', false);
    }

    public function test_metadata_save_preserves_all_editor_projects_and_drafts(): void
    {
        $page = $this->page(['builder_data' => ['vi' => ['pages' => [['component' => 'VI']], '_draft' => ['html' => '<h1>Draft</h1>', 'css' => '']], 'en' => ['pages' => [['component' => 'EN']]]]]);
        $before = $page->getTranslations('builder_data');
        $this->actingAs($this->editor)->put("/vi/admin/pages/{$page->id}", [
            'metadata_only' => true, 'title' => ['vi' => 'SEO đã sửa'], 'slug' => ['vi' => $page->slug],
            'is_active' => true, 'meta_title' => ['vi' => 'SEO title'],
        ])->assertRedirect()->assertSessionHasNoErrors();
        $this->assertSame($before, $page->fresh()->getTranslations('builder_data'));
        $this->assertSame('SEO title', $page->fresh()->getTranslation('meta_title', 'vi'));
        $this->get("/vi/admin/pages/{$page->id}/edit")->assertOk()->assertSee('name="metadata_only"', false)->assertDontSee('id="page-builder-canvas"', false);
    }

    public function test_legacy_locale_projects_are_preserved_when_new_builder_saves(): void
    {
        $page = $this->page(['builder_data' => ['version' => 1, 'locales' => ['vi' => ['pages' => [['component' => '<h1>Legacy VI</h1>']]], 'en' => ['pages' => [['component' => '<h1>Legacy EN</h1>']]]]]]);
        $this->actingAs($this->editor)->get("/vi/admin/pages/{$page->id}/builder")->assertOk()->assertViewHas('builderData', fn ($d) => isset($d['pages']));
        $this->postJson("/vi/admin/pages/{$page->id}/builder/save", $this->payload())->assertOk();
        $this->assertSame('<h1>Legacy EN</h1>', $page->fresh()->getTranslations('builder_data')['en']['pages'][0]['component']);
    }

    public function test_builder_public_page_keeps_theme_runtime_and_single_content_region(): void
    {
        $page = $this->page(['header_mode' => 'none', 'footer_mode' => 'none']);
        $response = $this->get('/gioi-thieu')->assertOk();
        $response->assertSee('/wp-content/plugins/elementor/assets/js/frontend.min.js', false);
        $this->assertSame(1, substr_count($response->getContent(), 'id="client-page-'.$page->id.'"'));
        $response->assertDontSee('elementor-location-header', false)->assertDontSee('elementor-location-footer', false);
    }
}
