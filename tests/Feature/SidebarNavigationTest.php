<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Role;
use App\Models\User;
use DOMDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SidebarNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (config('features.codes', []) as $featureCode) {
            FeatureSetting::query()->updateOrCreate(
                ['feature_code' => $featureCode],
                ['is_enabled' => false],
            );
        }
    }

    public function test_sidebar_hides_links_the_admin_cannot_open(): void
    {
        config(['admin.show_all_sidebar_tabs' => true]);

        $role = Role::query()->create([
            'name' => 'Settings only',
            'permissions' => ['manage_settings'],
        ]);
        $admin = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($admin)->get('/vi/admin');
        $links = $this->adminLinks($response->getContent());

        $response->assertOk();
        $this->assertNotContains('/vi/admin/products', $links);
        $this->assertNotContains('/vi/admin/posts', $links);
        $this->assertNotContains('/vi/admin/banners', $links);
        $this->assertNotContains('/vi/admin/users', $links);
        $this->assertNotContains('/vi/admin/media', $links);
        $this->assertContains('/vi/admin/settings', $links);
        $this->assertContains('/vi/admin/shipping-partners', $links);
        $this->assertContains('/vi/admin/payment-methods', $links);
        $this->assertContains('/vi/admin/notification-settings', $links);
        $response->assertSee('data-sidebar-settings-menu', false);
        $response->assertSeeText('Cấu hình chung');
        $response->assertDontSeeText('Cấu hình tính năng');
    }

    public function test_sidebar_hides_ecommerce_and_system_tabs_by_default(): void
    {
        $role = Role::query()->create([
            'name' => 'Superadmin',
            'permissions' => ['*'],
            'is_system' => true,
        ]);
        $superadmin = User::factory()->create(['role_id' => $role->id]);

        $response = $this->actingAs($superadmin)->get('/vi/admin');
        $links = $this->adminLinks($response->getContent());

        $response->assertOk();
        // Visible tabs by default
        $this->assertContains('/vi/admin/pages', $links);
        $this->assertContains('/vi/admin/partials', $links);
        $this->assertContains('/vi/admin/projects', $links);
        $this->assertContains('/vi/admin/brands', $links);
        $this->assertContains('/vi/admin/contact-inquiries', $links);
        $this->assertContains('/vi/admin/newsletter-subscribers', $links);
        $this->assertContains('/vi/admin/media', $links);

        // Hidden tabs by default (the photographed 10 sections)
        $this->assertNotContains('/vi/admin/orders', $links);
        $this->assertNotContains('/vi/admin/customers', $links);
        $this->assertNotContains('/vi/admin/products', $links);
        $this->assertNotContains('/vi/admin/reviews', $links);
        $this->assertNotContains('/vi/admin/vouchers', $links);
        $this->assertNotContains('/vi/admin/promotions', $links);
        $this->assertNotContains('/vi/admin/banners', $links);
        $this->assertNotContains('/vi/admin/posts', $links);
        $this->assertNotContains('/vi/admin/users', $links);
        $this->assertNotContains('/vi/admin/settings', $links);
        $this->assertNotContains('/vi/admin/activity-logs', $links);
        $this->assertNotContains('/vi/admin/logs', $links);

        foreach ($links as $link) {
            $linkResponse = $this->get($link);
            $this->assertFalse(
                $linkResponse->isRedirect('/vi/admin'),
                "Sidebar link [{$link}] redirected to the dashboard.",
            );
            $this->assertLessThan(500, $linkResponse->getStatusCode(), "Sidebar link [{$link}] returned a server error.");
        }
    }

    public function test_every_rendered_superadmin_sidebar_link_opens_without_dashboard_feature_redirect(): void
    {
        config(['admin.show_all_sidebar_tabs' => true]);

        $role = Role::query()->create([
            'name' => 'Superadmin',
            'permissions' => ['*'],
            'is_system' => true,
        ]);
        $superadmin = User::factory()->create(['role_id' => $role->id]);

        $sidebar = $this->actingAs($superadmin)->get('/vi/admin')->assertOk();
        $links = $this->adminLinks($sidebar->getContent());

        $this->assertContains('/vi/admin/products', $links);
        $this->assertContains('/vi/admin/posts', $links);
        $this->assertContains('/vi/admin/banners', $links);
        $this->assertContains('/vi/admin/users', $links);
        $this->assertContains('/vi/admin/media', $links);
        $this->assertContains('/vi/admin/settings', $links);
        $this->assertContains('/vi/admin/shipping-partners', $links);
        $this->assertContains('/vi/admin/payment-methods', $links);
        $this->assertContains('/vi/admin/notification-settings', $links);
        $this->assertContains('/vi/admin/languages', $links);
        $this->assertContains('/vi/admin/features', $links);
        $sidebar->assertSee('data-sidebar-settings-menu', false);

        foreach ($links as $link) {
            $response = $this->get($link);

            $this->assertFalse(
                $response->isRedirect('/vi/admin'),
                "Sidebar link [{$link}] redirected to the dashboard.",
            );
            $this->assertLessThan(500, $response->getStatusCode(), "Sidebar link [{$link}] returned a server error.");
        }
    }

    /** @return list<string> */
    private function adminLinks(string $html): array
    {
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML($html);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $links = [];
        $sidebar = $document->getElementById('sidebarnav');
        if (! $sidebar) {
            return [];
        }

        foreach ($sidebar->getElementsByTagName('a') as $anchor) {
            $href = $anchor->getAttribute('href');
            $path = parse_url($href, PHP_URL_PATH);
            if (is_string($path) && str_starts_with($path, '/vi/admin')) {
                $links[] = $path;
            }
        }

        return array_values(array_unique($links));
    }
}
