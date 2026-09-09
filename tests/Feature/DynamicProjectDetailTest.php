<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DynamicProjectDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_dynamic_project_detail_renders_project_data(): void
    {
        $project = Project::query()->create([
            'title' => [
                'vi' => 'Dự án Khách sạn Biển Đông',
                'en' => 'East Sea Resort & Spa',
            ],
            'slug' => 'east-sea-resort-spa',
            'category' => 'hospitality',
            'location' => [
                'vi' => 'Phú Quốc, Việt Nam',
                'en' => 'Phu Quoc, Vietnam',
            ],
            'client' => 'Vinpearl Luxury',
            'completion_year' => '2023',
            'summary' => [
                'vi' => 'Khu nghỉ dưỡng 5 sao ven biển cao cấp',
                'en' => '5-star luxury beachfront resort',
            ],
            'content' => [
                'vi' => 'Cung cấp toàn bộ đèn trang trí và cảnh quan',
                'en' => 'Provided all decorative and landscape lighting',
            ],
            'image_url' => '/wp-content/uploads/sample-project.jpg',
            'banner_url' => '/wp-content/uploads/sample-banner.jpg',
            'gallery' => [
                '/wp-content/uploads/gallery-1.jpg',
                '/wp-content/uploads/gallery-2.jpg',
            ],
            'is_active' => true,
        ]);

        $response = $this->get('/projects/east-sea-resort-spa');
        $response->assertOk();
        $response->assertSee('Dự án Khách sạn Biển Đông', false);
        $response->assertSee('Phú Quốc, Việt Nam', false);
        $response->assertSee('/hospitality-lighting-projects', false);
        $response->assertSee('Back to List', false);
        $response->assertSee('/wp-content/uploads/gallery-1.jpg', false);
    }

    public function test_legacy_blade_view_fallback_works_when_not_in_database(): void
    {
        $response = $this->get('/projects/church-of-the-blessed-sacrament');
        $response->assertOk();
        $response->assertSee('Church of the Blessed Sacrament', false);
        $response->assertSee('/other-lighting-projects', false);
    }

    public function test_non_existent_project_redirects_to_projects_list(): void
    {
        $response = $this->get('/projects/non-existent-project-xyz');
        $response->assertRedirect('/projects');
    }
}
