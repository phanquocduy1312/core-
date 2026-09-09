<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DynamicProjectsCrudFrontendTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_projects_pages_render_dynamic_database_records(): void
    {
        // 1. Create projects across categories
        $p1 = Project::query()->create([
            'title' => ['vi' => 'Dự án Khách Sạn Biển', 'en' => 'Ocean Resort Project'],
            'slug' => 'ocean-resort-project',
            'category' => 'hospitality',
            'image_url' => '/wp-content/uploads/2021/12/Dusit-Thani-Laguna@05x.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $p2 = Project::query()->create([
            'title' => ['vi' => 'Căn hộ Cao Cấp Masterise', 'en' => 'Masterise Luxury Condo'],
            'slug' => 'masterise-condo',
            'category' => 'residential',
            'image_url' => '/wp-content/uploads/2021/12/Residential_663x854.jpg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $p3 = Project::query()->create([
            'title' => ['vi' => 'Tòa Nhà Văn Phòng Landmark', 'en' => 'Landmark Office Tower'],
            'slug' => 'landmark-office',
            'category' => 'commercial',
            'image_url' => '/wp-content/uploads/2021/12/The-Work-Project_03@03x.jpg',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $p4 = Project::query()->create([
            'title' => ['vi' => 'Công Viên Ánh Sáng', 'en' => 'Light Heritage Park'],
            'slug' => 'light-heritage-park',
            'category' => 'other',
            'image_url' => '/wp-content/uploads/2021/12/The-Enabling-Village@25x.jpg',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // Inactive project should not be visible
        $pInactive = Project::query()->create([
            'title' => ['vi' => 'Dự án Ẩn', 'en' => 'Hidden Secret Project'],
            'slug' => 'hidden-secret-project',
            'category' => 'hospitality',
            'is_active' => false,
        ]);

        // Verify /du-an renders active projects dynamically
        $duAnRes = $this->get('/du-an');
        $duAnRes->assertOk();
        $duAnRes->assertSee('Dự án Khách Sạn Biển', false);
        $duAnRes->assertSee('Căn hộ Cao Cấp Masterise', false);
        $duAnRes->assertSee('Tòa Nhà Văn Phòng Landmark', false);
        $duAnRes->assertSee('Công Viên Ánh Sáng', false);
        $duAnRes->assertDontSee('Hidden Secret Project', false);

        // Verify /hospitality-lighting-projects filters only hospitality
        $hospRes = $this->get('/hospitality-lighting-projects');
        $hospRes->assertOk();
        $hospRes->assertSee('Dự án Khách Sạn Biển', false);
        $hospRes->assertDontSee('Căn hộ Cao Cấp Masterise', false);
        $hospRes->assertDontSee('Tòa Nhà Văn Phòng Landmark', false);

        // Verify /residential-lighting-projects filters only residential
        $resRes = $this->get('/residential-lighting-projects');
        $resRes->assertOk();
        $resRes->assertSee('Căn hộ Cao Cấp Masterise', false);
        $resRes->assertDontSee('Dự án Khách Sạn Biển', false);

        // Verify /commercial-lighting-projects filters only commercial
        $commRes = $this->get('/commercial-lighting-projects');
        $commRes->assertOk();
        $commRes->assertSee('Tòa Nhà Văn Phòng Landmark', false);
        $commRes->assertDontSee('Dự án Khách Sạn Biển', false);

        // Verify /other-lighting-projects filters only other
        $otherRes = $this->get('/other-lighting-projects');
        $otherRes->assertOk();
        $otherRes->assertSee('Công Viên Ánh Sáng', false);
        $otherRes->assertDontSee('Dự án Khách Sạn Biển', false);
    }

    public function test_crud_mutations_immediately_reflect_on_public_pages_without_page_builder(): void
    {
        $project = Project::query()->create([
            'title' => ['vi' => 'Tên Ban Đầu', 'en' => 'Initial Title'],
            'slug' => 'du-an-ban-dau',
            'category' => 'hospitality',
            'is_active' => true,
        ]);

        $res1 = $this->get('/hospitality-lighting-projects');
        $res1->assertSee('Tên Ban Đầu', false);

        // Update project
        $project->update([
            'title' => ['vi' => 'Tên Mới Sau Khi Sửa Admin', 'en' => 'Updated Title From Admin'],
        ]);

        $res2 = $this->get('/hospitality-lighting-projects');
        $res2->assertDontSee('Tên Ban Đầu', false);
        $res2->assertSee('Tên Mới Sau Khi Sửa Admin', false);

        // Delete project
        $project->delete();

        $res3 = $this->get('/hospitality-lighting-projects');
        $res3->assertDontSee('Tên Mới Sau Khi Sửa Admin', false);
    }
}
