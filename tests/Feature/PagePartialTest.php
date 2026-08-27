<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\ProjectSetting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PagePartialTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Page/partial render caching is keyed by auto-incrementing ids that
        // reset with each fresh in-memory test database, so a stale entry
        // from an earlier test method could otherwise leak into this one.
        Cache::flush();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );
        $role = Role::query()->create(['name' => 'Page editor', 'permissions' => ['manage_pages']]);
        $this->admin = User::factory()->create(['role_id' => $role->id]);
    }

    private function makePartial(array $overrides = []): Page
    {
        return Page::query()->create(array_merge([
            'type' => 'partial',
            'partial_role' => 'header',
            'title' => ['vi' => 'Header chính'],
            'slug' => 'header-chinh-'.uniqid(),
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<div id="site-header">Header thật</div>'],
            'is_active' => true,
        ], $overrides));
    }

    private function makePage(array $overrides = []): Page
    {
        return Page::query()->create(array_merge([
            'title' => ['vi' => 'Trang test'],
            'slug' => 'trang-test-'.uniqid(),
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<p>Nội dung trang</p>'],
            'is_active' => true,
            'published_at' => now(),
        ], $overrides));
    }

    public function test_admin_can_crud_a_shared_block(): void
    {
        $this->actingAs($this->admin);

        $this->post('/vi/admin/partials', [
            'title' => ['vi' => 'Footer chính'],
            'partial_role' => 'footer',
            'builder_data' => ['version' => 1, 'locales' => ['vi' => ['pages' => [['component' => '<div>Footer</div>']]]]],
            'published_html' => ['vi' => '<footer id="site-footer">Footer thật</footer>'],
            'published_css' => ['vi' => ''],
            'is_active' => 1,
        ])->assertRedirect();

        $partial = Page::query()->partials()->firstOrFail();
        $this->assertSame('footer', $partial->partial_role);
        $this->assertStringContainsString('Footer thật', $partial->getTranslation('published_html', 'vi', false));

        $this->get("/vi/admin/partials/{$partial->id}/edit")->assertOk();

        $this->put("/vi/admin/partials/{$partial->id}", [
            'title' => ['vi' => 'Footer chính 2'],
            'partial_role' => 'footer',
            'builder_data' => ['version' => 1, 'locales' => ['vi' => ['pages' => [['component' => '<div>Footer</div>']]]]],
            'published_html' => ['vi' => '<footer id="site-footer">Footer đã sửa</footer>'],
            'published_css' => ['vi' => ''],
            'is_active' => 1,
        ])->assertRedirect();

        $this->assertSame('Footer chính 2', $partial->fresh()->getTranslation('title', 'vi'));

        $this->delete("/vi/admin/partials/{$partial->id}")->assertRedirect();
        $this->assertSoftDeleted('pages', ['id' => $partial->id]);
    }

    public function test_shared_block_does_not_leak_as_a_public_page(): void
    {
        $partial = $this->makePartial();

        $this->get('/vi/pages/'.$partial->slug)->assertNotFound();
        $this->getJson('/api/public/pages/'.$partial->slug)->assertNotFound();

        $this->actingAs($this->admin)
            ->get('/vi/admin/pages')
            ->assertOk()
            ->assertDontSee('Header chính');
    }

    public function test_page_can_choose_between_inherit_custom_and_none_header(): void
    {
        $defaultHeader = $this->makePartial(['published_html' => ['vi' => '<div id="site-header">Header mặc định</div>']]);
        $customHeader = $this->makePartial(['published_html' => ['vi' => '<div id="site-header">Header riêng</div>']]);

        ProjectSetting::query()->updateOrCreate(
            ['setting_key' => 'layout_partials'],
            ['setting_value' => ['header_id' => $defaultHeader->id, 'footer_id' => null]],
        );

        $inheritPage = $this->makePage(['header_mode' => 'inherit']);
        $this->get('/vi/pages/'.$inheritPage->slug)
            ->assertOk()
            ->assertSee('Header mặc định', false);

        $customPage = $this->makePage(['header_mode' => 'custom', 'header_partial_id' => $customHeader->id]);
        $this->get('/vi/pages/'.$customPage->slug)
            ->assertOk()
            ->assertSee('Header riêng', false)
            ->assertDontSee('Header mặc định', false);

        $nonePage = $this->makePage(['header_mode' => 'none']);
        $this->get('/vi/pages/'.$nonePage->slug)
            ->assertOk()
            ->assertDontSee('Header mặc định', false)
            ->assertDontSee('Header riêng', false);
    }

    public function test_editing_a_shared_block_immediately_updates_pages_using_it(): void
    {
        $header = $this->makePartial(['published_html' => ['vi' => '<div id="site-header">Phiên bản 1</div>']]);
        ProjectSetting::query()->updateOrCreate(
            ['setting_key' => 'layout_partials'],
            ['setting_value' => ['header_id' => $header->id, 'footer_id' => null]],
        );
        $page = $this->makePage(['header_mode' => 'inherit']);

        $this->get('/vi/pages/'.$page->slug)->assertSee('Phiên bản 1', false);

        $response = $this->actingAs($this->admin)->put("/vi/admin/partials/{$header->id}", [
            'title' => ['vi' => 'Header chính'],
            'partial_role' => 'header',
            'builder_data' => ['version' => 1, 'locales' => ['vi' => ['pages' => [['component' => '<div>Header</div>']]]]],
            'published_html' => ['vi' => '<div id="site-header">Phiên bản 2</div>'],
            'published_css' => ['vi' => ''],
            'is_active' => 1,
        ]);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Phiên bản 2', false)
            ->assertDontSee('Phiên bản 1', false);
    }

    public function test_a_shared_block_that_references_itself_does_not_hang(): void
    {
        $partial = $this->makePartial();
        $partial->update([
            'published_html' => ['vi' => '<div data-page-block="partial" data-partial-id="'.$partial->id.'"></div>'],
        ]);

        $page = $this->makePage(['header_mode' => 'custom', 'header_partial_id' => $partial->id]);

        $this->get('/vi/pages/'.$page->slug)->assertOk();
    }

    public function test_disabled_shared_block_does_not_break_the_page(): void
    {
        $header = $this->makePartial(['is_active' => false]);
        $page = $this->makePage(['header_mode' => 'custom', 'header_partial_id' => $header->id]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertDontSee('Header thật', false);
    }

    public function test_site_owner_role_can_manage_shared_blocks_but_lacking_permission_cannot(): void
    {
        $ownerRole = Role::query()->create([
            'name' => 'Chủ website',
            'permissions' => ['manage_pages', 'manage_media'],
        ]);
        $owner = User::factory()->create(['role_id' => $ownerRole->id]);

        $this->actingAs($owner)->get('/vi/admin/partials')->assertOk();

        $noPermissionRole = Role::query()->create(['name' => 'Không có quyền', 'permissions' => []]);
        $noPermissionUser = User::factory()->create(['role_id' => $noPermissionRole->id]);
        $this->actingAs($noPermissionUser)->get('/vi/admin/partials')->assertForbidden();
    }

}
