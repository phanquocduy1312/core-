<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );

        $role = Role::query()->create([
            'name' => 'Admin Manager',
            'permissions' => ['manage_pages'],
        ]);

        $this->admin = User::factory()->create([
            'role_id' => $role->id,
            'is_active' => true,
        ]);
    }

    public function test_project_model_can_be_persisted_with_translations(): void
    {
        $project = Project::query()->create([
            'title' => [
                'vi' => 'Khách sạn Constance Lemuria',
                'en' => 'Constance Lemuria Praslin',
            ],
            'slug' => 'constance-lemuria-praslin',
            'category' => 'hospitality',
            'location' => [
                'vi' => 'Seychelles',
                'en' => 'Seychelles',
            ],
            'client' => 'Constance Hotels',
            'completion_year' => '2016',
            'summary' => [
                'vi' => 'Khách sạn 5 sao cao cấp ven biển',
                'en' => '5-star luxury beachfront hotel',
            ],
            'content' => [
                'vi' => 'Cung cấp toàn bộ đèn trang trí phòng khách',
                'en' => 'All Decorative Lighting in guest rooms',
            ],
            'image_url' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
            'banner_url' => '/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg',
            'gallery' => [
                '/wp-content/uploads/elementor/thumbs/Costance_1280x800.jpg',
                '/wp-content/uploads/elementor/thumbs/Costance_965x603.jpg',
            ],
            'sort_order' => 1,
            'is_active' => true,
            'is_featured' => true,
        ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'category' => 'hospitality',
            'client' => 'Constance Hotels',
            'completion_year' => '2016',
            'is_active' => true,
        ]);

        $this->assertSame('Khách sạn Constance Lemuria', $project->getTranslation('title', 'vi'));
        $this->assertSame('Constance Lemuria Praslin', $project->getTranslation('title', 'en'));
        $this->assertSame('/hospitality-lighting-projects', $project->categoryUrl());
        $this->assertCount(2, $project->gallery);
    }

    public function test_admin_can_access_projects_index(): void
    {
        $response = $this->actingAs($this->admin)->get('/vi/admin/projects');
        $response->assertOk();
    }

    public function test_admin_can_create_project(): void
    {
        $response = $this->actingAs($this->admin)->post('/vi/admin/projects', [
            'title' => [
                'vi' => 'Dự án Khách sạn Mới',
                'en' => 'New Hotel Project',
            ],
            'category' => 'hospitality',
            'location' => [
                'vi' => 'Đà Nẵng',
                'en' => 'Da Nang',
            ],
            'client' => 'Resort Corp',
            'completion_year' => '2024',
            'summary' => [
                'vi' => 'Mô tả dự án',
                'en' => 'Project summary',
            ],
            'content' => [
                'vi' => 'Chi tiết chiếu sáng',
                'en' => 'Lighting scope',
            ],
            'image_url' => 'https://example.com/thumb.jpg',
            'sort_order' => 5,
            'is_active' => 1,
        ]);

        $response->assertRedirect('/vi/admin/projects');
        $this->assertDatabaseHas('projects', [
            'category' => 'hospitality',
            'client' => 'Resort Corp',
        ]);
    }

    public function test_project_validation_rejects_missing_title(): void
    {
        $response = $this->actingAs($this->admin)->post('/vi/admin/projects', [
            'title' => ['vi' => ''],
            'category' => 'invalid-category',
        ]);

        $response->assertSessionHasErrors(['title.vi', 'category']);
    }

    public function test_admin_can_update_project(): void
    {
        $project = Project::query()->create([
            'title' => ['vi' => 'Dự án Cũ', 'en' => 'Old Project'],
            'slug' => 'du-an-cu',
            'category' => 'commercial',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->put("/vi/admin/projects/{$project->id}", [
            'title' => ['vi' => 'Dự án Đã Cập Nhật', 'en' => 'Updated Project'],
            'category' => 'commercial',
            'client' => 'Updated Client',
            'is_active' => 1,
        ]);

        $response->assertRedirect('/vi/admin/projects');
        $project->refresh();
        $this->assertSame('Dự án Đã Cập Nhật', $project->getTranslation('title', 'vi'));
        $this->assertSame('Updated Client', $project->client);
    }

    public function test_admin_can_delete_project(): void
    {
        $project = Project::query()->create([
            'title' => ['vi' => 'Dự án Cần Xoá', 'en' => 'Delete Project'],
            'slug' => 'du-an-can-xoa',
            'category' => 'other',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->admin)->delete("/vi/admin/projects/{$project->id}");
        $response->assertRedirect('/vi/admin/projects');
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_page_block_renderer_renders_project_grid(): void
    {
        Project::query()->create([
            'title' => ['vi' => 'Dự án Render Block Test', 'en' => 'Render Block Test'],
            'slug' => 'render-block-test',
            'category' => 'hospitality',
            'location' => ['vi' => 'Nha Trang', 'en' => 'Nha Trang'],
            'is_active' => true,
        ]);

        $renderer = app(\App\Services\PageBlockRenderer::class);
        $html = '<div data-page-block="project-grid" data-category="hospitality" data-limit="4" data-columns="3"></div>';
        $rendered = $renderer->render($html, 'vi');

        $this->assertStringContainsString('Dự án Render Block Test', $rendered);
        $this->assertStringContainsString('/projects/render-block-test', $rendered);
        $this->assertStringContainsString('Nha Trang', $rendered);
    }
}

