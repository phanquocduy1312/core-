<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Page;
use App\Models\FeatureSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVisualTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        FeatureSetting::query()->create([
            'feature_code' => 'catalog',
            'is_enabled' => true,
        ]);
    }

    public function test_visual_validator_script_exists(): void
    {
        $this->assertFileExists(public_path('admin-assets/js/visual-validator.js'));
    }

    public function test_visual_validator_injected_in_local_env(): void
    {
        config(['app.env' => 'local']);

        $this->actingAs(User::factory()->create());
        $response = $this->get('/vi/admin');

        $response->assertOk();
        $response->assertSee('admin-assets/js/visual-validator.js', false);
    }

    public function test_visual_validator_not_injected_in_production_env(): void
    {
        config(['app.env' => 'production']);

        $this->actingAs(User::factory()->create());
        $response = $this->get('/vi/admin');

        $response->assertOk();
        $response->assertDontSee('admin-assets/js/visual-validator.js', false);
    }

    public function test_grapesjs_sidebar_layout_rules_applied(): void
    {
        $this->actingAs(User::factory()->create());

        $page = Page::query()->create([
            'title' => ['vi' => 'Giới thiệu'],
            'slug' => 'gioi-thieu',
            'builder_data' => ['version' => 1, 'locales' => []],
            'is_active' => true,
        ]);
        $response = $this->get("/vi/admin/pages/{$page->id}/builder");

        $response->assertOk();
        $response->assertSee('.gjs-pn-views-container', false);
        $response->assertSee('id="gjs-container"', false);
        $this->get("/vi/admin/pages/{$page->id}/edit")->assertOk()->assertSee('name="metadata_only"', false)->assertDontSee('id="page-builder-canvas"', false);
    }

    public function test_guest_cannot_access_page_previews(): void
    {
        $this->postJson('/vi/admin/pages/preview-store', [
            'html' => '<div>Test</div>',
            'locale' => 'vi',
            'title' => 'Test Page',
        ])->assertStatus(401);

        $this->get('/vi/admin/pages/preview-render?token=123')->assertRedirect();
    }

    public function test_admin_can_store_and_render_temporary_preview(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->postJson('/vi/admin/pages/preview-store', [
            'html' => '<div>Nội dung xem trước</div>',
            'css' => '.test-cls{color:red}',
            'locale' => 'vi',
            'title' => 'Trang Xem Trước Hợp Lệ',
            'header_mode' => 'none',
            'footer_mode' => 'none',
        ]);

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonStructure(['preview_url']);

        $previewUrl = $response->json('preview_url');

        $renderResponse = $this->get($previewUrl);
        $renderResponse->assertOk();
        $renderResponse->assertSee('Nội dung xem trước', false);
        $renderResponse->assertSee('.test-cls{color:red}', false);
    }
}
