<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VisualPageBuilderTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Page $page;

    protected function setUp(): void
    {
        parent::setUp();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );

        $role = Role::query()->create([
            'name' => 'Page Manager',
            'permissions' => ['manage_pages', 'manage_media'],
        ]);

        $this->admin = User::factory()->create([
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        $this->page = Page::query()->create([
            'title' => ['vi' => 'Trang kiểm thử GrapesJS', 'en' => 'GrapesJS Test Page'],
            'slug' => 'trang-kiem-thu-grapesjs',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => '<section><h2>Nội dung ban đầu</h2></section>'],
            'published_css' => ['vi' => ''],
            'builder_data' => [
                'vi' => [
                    'pages' => [
                        [
                            'id' => 'page-1',
                            'frames' => [
                                [
                                    'component' => [
                                        'type' => 'wrapper',
                                        'components' => [
                                            ['type' => 'text', 'content' => 'Xin chào GrapesJS']
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ]);
    }

    public function test_guests_cannot_access_builder(): void
    {
        $response = $this->get('/vi/admin/pages/' . $this->page->id . '/builder');
        $response->assertRedirect('/vi/admin/login');
    }

    public function test_admin_can_access_grapes_builder(): void
    {
        $response = $this->actingAs($this->admin)->get('/vi/admin/pages/' . $this->page->id . '/builder');
        $response->assertOk();
        $response->assertSee('Trình thiết kế trực quan');
        $response->assertSee('grapes.min.js');
        $response->assertSee('gjs-container');
        $response->assertSee('Xin chào GrapesJS');
    }

    public function test_admin_can_save_grapesjs_project_data_draft(): void
    {
        $projectData = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    ['type' => 'text', 'content' => 'Hero Banner đã cập nhật']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = '<section><h1>Hero Banner đã cập nhật</h1></section>';
        $css = 'h1 { color: red; }';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => $html,
            'published_css' => $css,
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->page->refresh();
        $storedProjectData = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertEquals($projectData, $storedProjectData);
        $this->assertSame($html, $this->page->getTranslation('published_html', 'vi', false));
        $this->assertSame($css, $this->page->getTranslation('published_css', 'vi', false));
        $this->assertFalse($this->page->is_active);
    }

    public function test_admin_can_publish_page_with_grapesjs_project_data(): void
    {
        $projectData = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    ['type' => 'text', 'content' => 'Nội dung xuất bản hoàn chỉnh']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $publishHtml = '<section class="cta"><h2>Nội dung xuất bản hoàn chỉnh</h2></section>';
        $publishCss = '.cta { background: #e32326; color: #fff; }';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => $publishHtml,
            'published_css' => $publishCss,
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->page->refresh();
        $this->assertTrue($this->page->is_active);
        $this->assertNotNull($this->page->published_at);
        $storedProjectData = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertEquals($projectData, $storedProjectData);
        $this->assertSame($publishHtml, $this->page->getTranslation('published_html', 'vi', false));
        $this->assertSame($publishCss, $this->page->getTranslation('published_css', 'vi', false));
    }
}
