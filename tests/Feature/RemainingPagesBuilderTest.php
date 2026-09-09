<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Services\PageBuilderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RemainingPagesBuilderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );
    }

    public function test_managed_page_routes_fallback_to_blade_when_not_in_db(): void
    {
        $slugs = [
            'hospitality-lighting-projects',
            'residential-lighting-projects',
            'commercial-lighting-projects',
            'other-lighting-projects',
            'privacy-policy',
            'terms-of-use',
        ];

        foreach ($slugs as $slug) {
            $response = $this->get("/{$slug}");
            $response->assertOk();
        }
    }

    public function test_managed_pages_render_dynamic_builder_content_when_present_in_db(): void
    {
        $service = app(PageBuilderService::class);
        $page = $service->create([
            'title' => [
                'vi' => 'Hospitality Lighting Test',
                'en' => 'Hospitality Lighting Test',
            ],
            'slug' => [
                'vi' => 'hospitality-lighting-projects',
                'en' => 'hospitality-lighting-projects',
            ],
            'meta_title' => ['vi' => 'Meta Title VI', 'en' => 'Meta Title EN'],
            'meta_description' => ['vi' => 'Meta Desc VI', 'en' => 'Meta Desc EN'],
            'published_html' => [
                'vi' => '<div class="dynamic-builder-section">Builder Content Live</div>',
                'en' => '<div class="dynamic-builder-section">Builder Content Live</div>',
            ],
            'published_css' => [
                'vi' => '.dynamic-builder-section { color: red; }',
                'en' => '.dynamic-builder-section { color: red; }',
            ],
            'is_active' => true,
        ]);

        $response = $this->get('/hospitality-lighting-projects');
        $response->assertOk();
        $response->assertSee('Builder Content Live', false);
    }
}
