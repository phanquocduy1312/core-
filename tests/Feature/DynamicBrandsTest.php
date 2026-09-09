<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\FeatureSetting;
use App\Models\User;
use App\Services\Catalog\BrandService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DynamicBrandsTest extends TestCase
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

    public function test_storefront_brands_page_renders_active_brands_dynamically(): void
    {
        $brand1 = Brand::query()->create([
            'name' => 'Acolyte LED',
            'slug' => 'acolyte-led',
            'country' => 'America',
            'showcase_image' => '/wp-content/uploads/2021/12/Acolyte_800x1072.png',
            'image_url' => '/wp-content/uploads/2022/01/acolyte_png_re-1.png',
            'description' => 'Acolyte is one of the worlds leading architectural LED providers.',
            'website_url' => 'https://genledbrands.com/acolyte/',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $brand2 = Brand::query()->create([
            'name' => 'Aldabra Lights',
            'slug' => 'aldabra-lights',
            'country' => 'Italy',
            'showcase_image' => '/wp-content/uploads/2021/12/Aldabra_800x1072.png',
            'image_url' => '/wp-content/uploads/2022/01/aldabra_png_re-1.png',
            'description' => 'Aldabra manufactures high quality architectural outdoor luminaires.',
            'website_url' => 'https://aldabra.it/',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // Inactive brand should NOT appear
        $inactive = Brand::query()->create([
            'name' => 'Hidden Secret Brand',
            'slug' => 'hidden-secret-brand',
            'country' => 'SecretLand',
            'is_active' => false,
        ]);

        // Test /thuong-hieu
        $responseVi = $this->get('/thuong-hieu');
        $responseVi->assertOk();
        $responseVi->assertSee('Acolyte LED');
        $responseVi->assertSee('America');
        $responseVi->assertSee('https://genledbrands.com/acolyte/');
        $responseVi->assertSee('Aldabra Lights');
        $responseVi->assertSee('Italy');
        $responseVi->assertDontSee('Hidden Secret Brand');

        // Test /luxlight-lighting-brands
        $responseEn = $this->get('/luxlight-lighting-brands');
        $responseEn->assertOk();
        $responseEn->assertSee('Acolyte LED');
        $responseEn->assertSee('America');
        $responseEn->assertDontSee('Hidden Secret Brand');
    }

    public function test_admin_can_create_brand_with_luxlight_fields(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/vi/admin/brands', [
            'name' => 'Modu LED Lighting',
            'slug' => 'modu-led-lighting',
            'country' => 'Korea',
            'website_url' => 'https://moduled.com',
            'showcase_image' => 'https://example.com/showcase.jpg',
            'description' => 'Korean architectural LED solutions',
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 5,
        ]);

        $response->assertRedirect('/vi/admin/brands');

        $this->assertDatabaseHas('brands', [
            'slug' => 'modu-led-lighting',
            'country' => 'Korea',
            'website_url' => 'https://moduled.com',
            'showcase_image' => 'https://example.com/showcase.jpg',
            'is_featured' => true,
            'sort_order' => 5,
        ]);
    }

    public function test_admin_can_upload_showcase_image_and_logo(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/vi/admin/brands', [
            'name' => 'Uploaded Brand Test',
            'slug' => 'uploaded-brand-test',
            'country' => 'Germany',
            'website_url' => 'https://brand-test.de',
            'image_file' => UploadedFile::fake()->image('logo.png'),
            'showcase_image_file' => UploadedFile::fake()->image('showcase.jpg'),
            'is_active' => true,
        ]);

        $response->assertRedirect('/vi/admin/brands');

        $brand = Brand::query()->where('slug', 'uploaded-brand-test')->firstOrFail();
        $this->assertSame('Germany', $brand->country);
        $this->assertNotNull($brand->image_url);
        $this->assertNotNull($brand->showcase_image);
    }

    public function test_admin_can_update_brand_luxlight_fields(): void
    {
        $admin = User::factory()->create();

        $brand = Brand::query()->create([
            'name' => 'Original Brand',
            'slug' => 'original-brand',
            'country' => 'China',
            'website_url' => 'https://old.com',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->put("/vi/admin/brands/{$brand->id}", [
            'name' => 'Updated Brand Name',
            'slug' => 'original-brand',
            'country' => 'Japan',
            'website_url' => 'https://new-website.jp',
            'showcase_image' => 'https://cdn.example.com/new-showcase.png',
            'is_active' => true,
            'is_featured' => true,
        ]);

        $response->assertRedirect('/vi/admin/brands');

        $brand->refresh();
        $this->assertSame('Japan', $brand->country);
        $this->assertSame('https://new-website.jp', $brand->website_url);
        $this->assertSame('https://cdn.example.com/new-showcase.png', $brand->showcase_image);
        $this->assertTrue($brand->is_featured);
    }

    public function test_admin_can_filter_brands_by_country(): void
    {
        $admin = User::factory()->create();

        Brand::query()->create([
            'name' => 'Italian Master',
            'slug' => 'italian-master',
            'country' => 'Italy',
            'is_active' => true,
        ]);

        Brand::query()->create([
            'name' => 'Spanish Light',
            'slug' => 'spanish-light',
            'country' => 'Spain',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/vi/admin/brands?q=Italy');
        $response->assertOk();
        $response->assertSee('Italian Master');
        $response->assertDontSee('Spanish Light');
    }
}
