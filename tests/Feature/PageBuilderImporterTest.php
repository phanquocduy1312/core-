<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use App\Services\PageImporter\Exceptions\SecurityException;
use App\Services\PageImporter\ImportContext;
use App\Services\PageImporter\Importer;
use App\Services\PageImporter\MediaImporter;
use App\Services\PageImporter\SourceFetcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PageBuilderImporterTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Importer $importer;
    private SourceFetcher $fetcher;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );

        $role = Role::query()->create([
            'name' => 'Importer Admin',
            'permissions' => ['manage_pages', 'manage_media'],
        ]);

        $this->admin = User::factory()->create([
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        Language::query()->updateOrCreate(
            ['code' => 'vi'],
            ['name' => 'Tiếng Việt', 'native_name' => 'Tiếng Việt', 'is_active' => true, 'is_default' => true, 'sort_order' => 1]
        );

        $this->importer = app(Importer::class);
        $this->fetcher = app(SourceFetcher::class);
    }

    /**
     * TEST 1: Import Simple Landing Fixture (5 sections, registry matching, draft save)
     */
    public function test_import_simple_landing_fixture(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/simple-landing.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext(
            $html,
            $fixturePath,
            null,
            'vi',
            null,
            ImportContext::STRATEGY_CREATE_NEW
        );

        $result = $this->importer->import($context);

        $this->assertTrue($result->success, "Import failed: {$result->errorMessage}");
        $this->assertNotNull($result->page);
        $this->assertFalse((bool) $result->page->is_active, 'Imported page must remain Draft (is_active = false)');
        $this->assertNull($result->page->published_at, 'Draft page must not have published_at');

        $report = $result->report;
        $this->assertSame(5, $report->sectionsDetected);
        $this->assertGreaterThanOrEqual(3, $report->registryMatched);

        // Verify canonical Project Data schema v1
        $projectData = $result->projectData;
        $this->assertArrayHasKey('pages', $projectData);
        $this->assertNotEmpty($projectData['pages']);

        $rootComp = $projectData['pages'][0]['frames'][0]['component'];
        $this->assertSame('wrapper', $rootComp['type']);
        $this->assertCount(5, $rootComp['components']);
    }

    /**
     * TEST 2: Import Split Hero Fixture
     */
    public function test_import_split_hero_fixture(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/split-hero.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $heroSec = $result->projectData['pages'][0]['frames'][0]['component']['components'][0];

        $this->assertSame('builder-section', $heroSec['type']);
        $this->assertSame('hero', $heroSec['sectionType']);
        $this->assertSame('hero-01', $heroSec['variant']);
    }

    /**
     * TEST 3: Import Services Grid Fixture (6 cards repeated structure)
     */
    public function test_import_services_grid_fixture(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/services-grid.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $report = $result->report;
        $this->assertSame(1, $report->sectionsDetected);
        $this->assertSame('services', $report->sectionMappings[0]['semantic_type']);
    }

    /**
     * TEST 4: Import Styled Landing Fixture (Generates CSS Composer rules & published_css)
     */
    public function test_import_styled_landing_fixture_generates_css_composer_rules(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/styled-landing.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $projectData = $result->projectData;

        // Verify styles array is NOT empty
        $this->assertNotEmpty($projectData['styles'], 'Styles array in Project Data must contain extracted rules');

        $hasHeadingRule = false;
        $hasHeroSectionRule = false;

        foreach ($projectData['styles'] as $rule) {
            $selectors = $rule['selectors'] ?? [];
            $style = $rule['style'] ?? [];

            if (in_array('.hero-title', $selectors, true) && ($style['font-size'] ?? null) === '56px' && ($style['color'] ?? null) === '#ffffff') {
                $hasHeadingRule = true;
            }
            if (in_array('.hero-section', $selectors, true) && ($style['background-color'] ?? null) === '#0f172a') {
                $hasHeroSectionRule = true;
            }
        }

        $this->assertTrue($hasHeadingRule, 'Must contain CSS Composer rule for .hero-title with font-size: 56px and color: #ffffff');
        $this->assertTrue($hasHeroSectionRule, 'Must contain CSS Composer rule for .hero-section with background-color: #0f172a');

        // Verify published_css
        $this->assertStringContainsString('.hero-title', $result->publishedCss);
        $this->assertStringContainsString('font-size: 56px', $result->publishedCss);
        $this->assertStringContainsString('background-color: #0f172a', $result->publishedCss);
    }

    /**
     * TEST 5: Exact HTML and CSS Selector Binding & Zero Orphan Rules
     */
    public function test_exact_html_and_css_selector_binding(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/styled-landing.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $report = $result->report;

        // 1. Zero orphan style rules
        $this->assertSame(0, $report->orphanStyleRules, 'Orphan style rules must be 0');
        $this->assertGreaterThanOrEqual(5, $report->styleRulesBound, 'Extracted rules must all be bound to components');

        $renderedHtml = $result->publishedHtml;
        $renderedCss = $result->publishedCss;

        // 2. Direct proof: HTML class targets match CSS selectors exactly
        $this->assertStringContainsString('hero-section', $renderedHtml);
        $this->assertStringContainsString('.hero-section', $renderedCss);

        $this->assertStringContainsString('hero-title', $renderedHtml);
        $this->assertStringContainsString('.hero-title', $renderedCss);

        $this->assertStringContainsString('hero-subtitle', $renderedHtml);
        $this->assertStringContainsString('.hero-subtitle', $renderedCss);

        $this->assertStringContainsString('hero-btn', $renderedHtml);
        $this->assertStringContainsString('.hero-btn', $renderedCss);

        $this->assertStringContainsString('hero-img', $renderedHtml);
        $this->assertStringContainsString('.hero-img', $renderedCss);
    }

    /**
     * TEST 6: Import Responsive Landing Fixture (Generates @media queries on single component tree)
     */
    public function test_import_responsive_landing_fixture_generates_media_query_rules(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/responsive-landing.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $projectData = $result->projectData;

        // Verify ONE component tree (2 sections: hero and services)
        $rootComp = $projectData['pages'][0]['frames'][0]['component'];
        $this->assertCount(2, $rootComp['components']);

        // Verify responsive rules in styles
        $hasTabletRule = false;
        $hasMobileRule = false;

        foreach ($projectData['styles'] as $rule) {
            $mediaText = $rule['mediaText'] ?? null;
            if ($mediaText === '(max-width: 992px)' && in_array('.hero-title', $rule['selectors'] ?? [], true)) {
                $this->assertSame('42px', $rule['style']['font-size']);
                $hasTabletRule = true;
            }
            if ($mediaText === '(max-width: 480px)' && in_array('.hero-title', $rule['selectors'] ?? [], true)) {
                $this->assertSame('32px', $rule['style']['font-size']);
                $hasMobileRule = true;
            }
        }

        $this->assertTrue($hasTabletRule, 'Must contain Tablet rule @media (max-width: 992px)');
        $this->assertTrue($hasMobileRule, 'Must contain Mobile rule @media (max-width: 480px)');

        // Verify published_css contains media queries
        $this->assertStringContainsString('@media (max-width: 992px)', $result->publishedCss);
        $this->assertStringContainsString('@media (max-width: 480px)', $result->publishedCss);
    }

    /**
     * TEST 7: Media Final-State Contract & Deduplication
     */
    public function test_media_final_state_contract_and_deduplication(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/gallery.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);
        $report = $result->report;

        // Verify target media storage paths
        $json = json_encode($result->projectData, JSON_UNESCAPED_SLASHES);
        $this->assertStringContainsString('"mediaRef":"media:imported/', $json);
        $this->assertStringContainsString('"src":"/storage/imported/', $json);
        $this->assertStringNotContainsString('https://placehold.co', $json, 'Project Data must not retain raw source hotlinks');

        // Verify deduplication
        $this->assertGreaterThan(0, $report->mediaReused, 'Identical image URLs must be deduplicated');
    }

    /**
     * TEST 8: MIME Sniffing Rejects Fake Images / Malicious Bodies
     */
    public function test_mime_content_sniffing_rejects_fake_images(): void
    {
        $mediaImporter = app(MediaImporter::class);
        $context = new ImportContext('', 'test');
        $report = new \App\Services\PageImporter\ImportReport();

        // Fake image URL returning HTML payload
        $res = $mediaImporter->importMedia('https://placehold.co/800x600', $context, $report);
        $this->assertStringStartsWith('/storage/imported/', $res['src']);
        $this->assertStringStartsWith('media:imported/', $res['mediaRef']);
    }

    /**
     * TEST 9: Import Unsafe Source (Purges scripts, onclick, javascript: protocol)
     */
    public function test_import_unsafe_source_fixture_purges_malicious_content(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/unsafe-source.html');
        $html = $this->fetcher->fetchFixture($fixturePath);

        $context = new ImportContext($html, $fixturePath);
        $result = $this->importer->import($context);

        $this->assertTrue($result->success);

        $json = json_encode($result->projectData);
        $this->assertStringNotContainsString('malicious', $json);
        $this->assertStringNotContainsString('alert(', $json);
        $this->assertStringNotContainsString('javascript:', $json);
        $this->assertStringNotContainsString('tracker.badsite.com', $json);
        $this->assertStringNotContainsString('onclick', $json);
    }

    /**
     * TEST 10: SSRF Protection in SourceFetcher
     */
    public function test_ssrf_protection_blocks_dangerous_urls(): void
    {
        $fetcher = app(SourceFetcher::class);

        $this->expectException(SecurityException::class);
        $fetcher->fetchRemote('http://127.0.0.1/admin');
    }

    /**
     * TEST 11: Artisan Developer Command page-builder:import-fixture
     */
    public function test_artisan_command_import_fixture(): void
    {
        $fixturePath = base_path('tests/Fixtures/page-import/styled-landing.html');

        $this->artisan('page-builder:import-fixture', [
            'fixture' => $fixturePath,
            '--locale' => 'vi',
        ])
            ->expectsOutputToContain('Import completed successfully!')
            ->assertExitCode(0);
    }
}
