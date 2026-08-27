<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use App\Support\PageHtmlSanitizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PageBuilderBlockTest extends TestCase
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
        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'multi_admin'],
            ['is_enabled' => true],
        );
    }

    public function test_sanitizer_keeps_iframe_from_allowlisted_host(): void
    {
        $sanitizer = app(PageHtmlSanitizer::class);

        $clean = $sanitizer->clean('<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" width="560" height="315"></iframe>');

        $this->assertStringContainsString('youtube.com/embed/dQw4w9WgXcQ', $clean);
        $this->assertStringContainsString('loading="lazy"', $clean);
        $this->assertStringContainsString('sandbox=', $clean);
    }

    public function test_sanitizer_strips_iframe_from_untrusted_host(): void
    {
        $sanitizer = app(PageHtmlSanitizer::class);

        $clean = $sanitizer->clean('<iframe src="https://evil.test/x"></iframe>');

        $this->assertSame('', trim($clean));
    }

    public function test_sanitizer_still_strips_script_and_form(): void
    {
        $sanitizer = app(PageHtmlSanitizer::class);

        $clean = $sanitizer->clean('<script>alert(1)</script><form><input type="text"></form><p>OK</p>');

        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('<form', $clean);
        $this->assertStringNotContainsString('<input', $clean);
        $this->assertStringContainsString('<p>OK</p>', $clean);
    }

    public function test_admin_can_save_page_with_allowlisted_iframe_and_it_survives_round_trip(): void
    {
        $role = Role::query()->create(['name' => 'Page editor', 'permissions' => ['manage_pages']]);
        $admin = User::factory()->create(['role_id' => $role->id]);

        $payload = [
            'title' => ['vi' => 'Trang video'],
            'slug' => ['vi' => 'trang-video'],
            'builder_data' => ['version' => 1, 'locales' => ['vi' => ['pages' => [['component' => '<div>Video</div>']]]]],
            'published_html' => [
                'vi' => '<div data-page-block="video"><iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe></div>'
                    .'<iframe src="https://evil.test/x"></iframe>',
            ],
            'published_css' => ['vi' => ''],
            'is_active' => 1,
        ];

        $response = $this->actingAs($admin)->post('/vi/admin/pages', $payload);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();

        $page = Page::query()->firstOrFail();
        $storedHtml = $page->getTranslation('published_html', 'vi', false);
        $this->assertStringContainsString('youtube.com/embed', $storedHtml);
        $this->assertStringNotContainsString('evil.test', $storedHtml);
    }

    public function test_product_grid_block_renders_active_products_on_client_page(): void
    {
        $category = Category::query()->create([
            'name' => ['vi' => 'Đồ gia dụng'],
            'slug' => 'do-gia-dung',
            'is_active' => true,
        ]);

        Product::query()->create([
            'category_id' => $category->id,
            'name' => ['vi' => 'Nồi cơm điện'],
            'slug' => 'noi-com-dien',
            'sku' => 'NCD-001',
            'price' => 890000,
            'stock_quantity' => 5,
            'is_active' => true,
        ]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang sản phẩm'],
            'slug' => 'trang-san-pham',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="product-grid" data-category="" data-limit="8"><div>Storefront sẽ render danh sách sản phẩm tại đây</div></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Nồi cơm điện')
            ->assertDontSee('Storefront sẽ render danh sách sản phẩm tại đây');
    }

    public function test_product_grid_block_shows_empty_state_for_unknown_category(): void
    {
        $page = Page::query()->create([
            'title' => ['vi' => 'Trang trống'],
            'slug' => 'trang-trong',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="product-grid" data-category="danh-muc-khong-ton-tai" data-limit="8"></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Không tìm thấy danh mục sản phẩm.');
    }

    public function test_post_list_block_renders_published_posts_on_client_page(): void
    {
        Post::create([
            'title' => ['vi' => 'Bài viết mới nhất'],
            'slug' => 'bai-viet-moi-nhat',
            'summary' => ['vi' => 'Tóm tắt bài viết.'],
            'content' => ['vi' => '<p>Nội dung</p>'],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang tin tức'],
            'slug' => 'trang-tin-tuc',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="post-list" data-limit="3"><div>Storefront sẽ render danh sách bài viết tại đây</div></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Bài viết mới nhất')
            ->assertDontSee('Storefront sẽ render danh sách bài viết tại đây');
    }

    public function test_contact_form_block_renders_a_real_form(): void
    {
        $page = Page::query()->create([
            'title' => ['vi' => 'Trang liên hệ'],
            'slug' => 'trang-lien-he',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="contact-form"><div>Form liên hệ sẽ hiển thị tại đây trên trang thật</div></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('name="phone"', false)
            ->assertSee('name="message"', false)
            ->assertDontSee('Form liên hệ sẽ hiển thị tại đây trên trang thật');
    }

    public function test_product_grid_query_type_filters_featured_products_only(): void
    {
        Product::query()->create([
            'name' => ['vi' => 'Sản phẩm thường'],
            'slug' => 'san-pham-thuong',
            'sku' => 'SP-001',
            'price' => 100000,
            'stock_quantity' => 5,
            'is_active' => true,
            'is_featured' => false,
        ]);
        Product::query()->create([
            'name' => ['vi' => 'Sản phẩm nổi bật'],
            'slug' => 'san-pham-noi-bat',
            'sku' => 'SP-002',
            'price' => 200000,
            'stock_quantity' => 5,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang nổi bật'],
            'slug' => 'trang-noi-bat',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="product-grid" data-query="featured" data-limit="8"></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Sản phẩm nổi bật')
            ->assertDontSee('Sản phẩm thường');
    }

    public function test_category_grid_block_renders_active_categories(): void
    {
        Category::query()->create(['name' => ['vi' => 'Danh mục A'], 'slug' => 'danh-muc-a', 'is_active' => true]);
        Category::query()->create(['name' => ['vi' => 'Danh mục ẩn'], 'slug' => 'danh-muc-an', 'is_active' => false]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang danh mục'],
            'slug' => 'trang-danh-muc',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="category-grid" data-limit="8"><div>Storefront sẽ render lưới danh mục tại đây</div></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Danh mục A')
            ->assertDontSee('Danh mục ẩn')
            ->assertDontSee('Storefront sẽ render lưới danh mục tại đây');
    }

    public function test_latest_reviews_block_renders_visible_reviews(): void
    {
        $product = Product::query()->create([
            'name' => ['vi' => 'Sản phẩm được đánh giá'],
            'slug' => 'san-pham-danh-gia',
            'sku' => 'SP-003',
            'price' => 150000,
            'stock_quantity' => 5,
            'is_active' => true,
        ]);
        Review::query()->create([
            'product_id' => $product->id,
            'customer_name' => 'Nguyễn Văn A',
            'customer_email' => 'a@example.test',
            'rating' => 5,
            'comment' => 'Sản phẩm rất tốt, giao hàng nhanh.',
            'is_visible' => true,
        ]);
        Review::query()->create([
            'product_id' => $product->id,
            'customer_name' => 'Ẩn danh',
            'customer_email' => 'hidden@example.test',
            'rating' => 1,
            'comment' => 'Bình luận bị ẩn.',
            'is_visible' => false,
        ]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang đánh giá'],
            'slug' => 'trang-danh-gia',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<section data-page-block="latest-reviews" data-limit="4"><div>Storefront sẽ render đánh giá khách hàng tại đây</div></section>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Nguyễn Văn A')
            ->assertSee('Sản phẩm rất tốt, giao hàng nhanh.')
            ->assertDontSee('Bình luận bị ẩn.')
            ->assertDontSee('Storefront sẽ render đánh giá khách hàng tại đây');
    }

    public function test_shared_block_referenced_inside_page_body_renders(): void
    {
        $partial = Page::query()->create([
            'type' => 'partial',
            'partial_role' => 'generic',
            'title' => ['vi' => 'CTA dùng chung'],
            'slug' => 'cta-dung-chung',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => ['vi' => '<div id="shared-cta">Đăng ký ngay hôm nay</div>'],
            'is_active' => true,
        ]);

        $page = Page::query()->create([
            'title' => ['vi' => 'Trang có khối dùng chung'],
            'slug' => 'trang-co-khoi-dung-chung',
            'builder_data' => ['version' => 1, 'locales' => []],
            'published_html' => [
                'vi' => '<div data-page-block="partial" data-partial-id="'.$partial->id.'"></div>',
            ],
            'is_active' => true,
            'published_at' => now(),
        ]);

        $this->get('/vi/pages/'.$page->slug)
            ->assertOk()
            ->assertSee('Đăng ký ngay hôm nay');
    }

    public function test_site_owner_role_can_edit_pages_but_not_settings_or_users(): void
    {
        $role = Role::query()->create([
            'name' => 'Chủ website',
            'permissions' => ['manage_pages', 'manage_posts', 'manage_banners', 'manage_media', 'view_customers', 'manage_orders'],
        ]);
        $owner = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($owner)->get('/vi/admin/pages')->assertOk();
        $this->actingAs($owner)->get('/vi/admin/settings')->assertForbidden();
        $this->actingAs($owner)->get('/vi/admin/users')->assertForbidden();
        $this->actingAs($owner)->get('/vi/admin/logs')->assertForbidden();
    }
}
