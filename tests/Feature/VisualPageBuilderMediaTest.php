<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VisualPageBuilderMediaTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Page $page;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );

        $role = Role::query()->create([
            'name' => 'Page & Media Manager',
            'permissions' => ['manage_pages', 'manage_media'],
        ]);

        $this->admin = User::factory()->create([
            'role_id' => $role->id,
            'is_active' => true,
        ]);

        $this->page = Page::query()->create([
            'title' => ['vi' => 'Trang kiểm thử Media GrapesJS', 'en' => 'GrapesJS Media Test Page'],
            'slug' => 'trang-kiem-thu-media-grapesjs',
            'type' => 'page',
            'is_active' => false,
            'published_at' => null,
            'published_html' => ['vi' => '<section><img src="/admin-assets/images/builder/hero-placeholder.svg" alt="Ảnh ban đầu" loading="lazy"></section>'],
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
                                            [
                                                'type' => 'image',
                                                'tagName' => 'img',
                                                'attributes' => [
                                                    'src' => '/admin-assets/images/builder/hero-placeholder.svg',
                                                    'alt' => 'Ảnh ban đầu',
                                                    'loading' => 'lazy'
                                                ],
                                                'mediaRef' => 'general/hero-placeholder'
                                            ]
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

    /**
     * TEST A: Save Draft with GrapesJS Image Component & Media Reference (mediaRef)
     */
    public function test_save_draft_with_image_component_and_media_ref(): void
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
                                    [
                                        'type' => 'image',
                                        'tagName' => 'img',
                                        'attributes' => [
                                            'src' => '/storage/general/banner-a.jpg',
                                            'alt' => 'Banner A',
                                            'loading' => 'lazy'
                                        ],
                                        'mediaRef' => 'general/banner-a'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = '<section><img src="/storage/general/banner-a.jpg" alt="Banner A" loading="lazy"></section>';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => $html,
            'published_css' => '',
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->page->refresh();
        $savedProject = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertNotNull($savedProject);

        $imgComponent = $savedProject['pages'][0]['frames'][0]['component']['components'][0];
        $this->assertSame('image', $imgComponent['type']);
        $this->assertSame('/storage/general/banner-a.jpg', $imgComponent['attributes']['src']);
        $this->assertSame('general/banner-a', $imgComponent['mediaRef']);
        $this->assertArrayNotHasKey('data-media-id', $imgComponent['attributes']);
    }

    /**
     * TEST B: Replace Image in GrapesJS Project Data
     */
    public function test_replace_image_persists_new_media_and_src(): void
    {
        $updatedProjectData = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'image',
                                        'tagName' => 'img',
                                        'attributes' => [
                                            'src' => '/storage/banners/new-hero-banner.webp',
                                            'alt' => 'Hero Banner Đã Thay Thế',
                                            'loading' => 'lazy'
                                        ],
                                        'mediaRef' => 'banners/new-hero-banner'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $html = '<section><img src="/storage/banners/new-hero-banner.webp" alt="Hero Banner Đã Thay Thế" loading="lazy"></section>';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $updatedProjectData,
            'published_html' => $html,
            'published_css' => '',
        ]);

        $response->assertOk();

        $this->page->refresh();
        $savedProject = $this->page->getTranslation('builder_data', 'vi', false);
        $imgComponent = $savedProject['pages'][0]['frames'][0]['component']['components'][0];
        $this->assertSame('/storage/banners/new-hero-banner.webp', $imgComponent['attributes']['src']);
        $this->assertSame('banners/new-hero-banner', $imgComponent['mediaRef']);
    }

    /**
     * TEST C: Upload Image via MediaController and attach to GrapesJS
     */
    public function test_upload_image_via_media_controller_and_attach(): void
    {
        $fakeFile = UploadedFile::fake()->image('yacht-test.jpg', 800, 600);

        $uploadResponse = $this->actingAs($this->admin)->post('/vi/admin/media/upload', [
            'file' => $fakeFile,
            'folder' => 'general',
            'image_only' => 1,
        ], ['Accept' => 'application/json']);

        $uploadResponse->assertOk();
        $uploadData = $uploadResponse->json();
        $this->assertTrue($uploadData['success']);
        $this->assertNotEmpty($uploadData['url']);

        // Save draft using this uploaded URL and reference
        $projectData = [
            'pages' => [
                [
                    'id' => 'page-1',
                    'frames' => [
                        [
                            'component' => [
                                'type' => 'wrapper',
                                'components' => [
                                    [
                                        'type' => 'image',
                                        'attributes' => [
                                            'src' => $uploadData['url'],
                                            'alt' => 'Yacht Test',
                                            'loading' => 'lazy'
                                        ],
                                        'mediaRef' => 'general/yacht-test'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $saveResponse = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectData,
            'published_html' => '<img src="' . $uploadData['url'] . '" alt="Yacht Test" loading="lazy">',
        ]);

        $saveResponse->assertOk();
        $this->page->refresh();
        $savedProject = $this->page->getTranslation('builder_data', 'vi', false);
        $this->assertSame($uploadData['url'], $savedProject['pages'][0]['frames'][0]['component']['components'][0]['attributes']['src']);
        $this->assertSame('general/yacht-test', $savedProject['pages'][0]['frames'][0]['component']['components'][0]['mediaRef']);
    }

    /**
     * TEST D: Publish Page with Clean Public Output (No data-media-id, no data-gjs-*, no grapesjs scripts)
     */
    public function test_publish_page_renders_clean_public_html(): void
    {
        $publishHtml = '<section class="hero-image-section"><img src="/storage/general/showcase.jpg" alt="Showcase" loading="lazy"></section>';

        $response = $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/publish', [
            'content_locale' => 'vi',
            'published_html' => $publishHtml,
            'builder_data' => $this->page->getTranslation('builder_data', 'vi', false),
        ]);

        $response->assertOk();
        $this->page->refresh();
        $this->assertTrue($this->page->is_active);

        // Public Frontend GET as guest
        auth()->logout();
        $publicResponse = $this->get('/vi/pages/' . $this->page->slug);
        $publicResponse->assertOk();
        $publicResponse->assertSee('/storage/general/showcase.jpg');
        $publicResponse->assertSee('loading="lazy"', false);
        $publicResponse->assertDontSee('data-media-id', false);
        $publicResponse->assertDontSee('data-gjs-', false);
        $publicResponse->assertDontSee('grapes.min.js', false);
        $publicResponse->assertDontSee('grapes.min.css', false);
    }

    /**
     * TEST E: Multilingual Image Isolation (VI vs EN vs KO)
     */
    public function test_multilingual_image_isolation_vi_en_ko(): void
    {
        $projectDataVi = [
            'pages' => [
                [
                    'id' => 'page-vi',
                    'frames' => [
                        [
                            'component' => [
                                'components' => [
                                    ['type' => 'image', 'attributes' => ['src' => '/storage/general/image-vi.jpg'], 'mediaRef' => 'general/image-vi']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $projectDataEn = [
            'pages' => [
                [
                    'id' => 'page-en',
                    'frames' => [
                        [
                            'component' => [
                                'components' => [
                                    ['type' => 'image', 'attributes' => ['src' => '/storage/general/image-en.jpg'], 'mediaRef' => 'general/image-en']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Save VI
        $this->actingAs($this->admin)->postJson('/vi/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'vi',
            'builder_data' => $projectDataVi,
            'published_html' => '<img src="/storage/general/image-vi.jpg">',
        ])->assertOk();

        // Save EN
        $this->actingAs($this->admin)->postJson('/en/admin/pages/' . $this->page->id . '/builder/save', [
            'content_locale' => 'en',
            'builder_data' => $projectDataEn,
            'published_html' => '<img src="/storage/general/image-en.jpg">',
        ])->assertOk();

        $this->page->refresh();

        // Check clean Spatie getTranslation API
        $this->assertSame(
            '/storage/general/image-vi.jpg',
            $this->page->getTranslation('builder_data', 'vi', false)['pages'][0]['frames'][0]['component']['components'][0]['attributes']['src']
        );
        $this->assertSame(
            '/storage/general/image-en.jpg',
            $this->page->getTranslation('builder_data', 'en', false)['pages'][0]['frames'][0]['component']['components'][0]['attributes']['src']
        );

        // Raw DB column check
        $rawBuilderData = $this->page->getRawOriginal('builder_data');
        $decoded = is_string($rawBuilderData) ? json_decode($rawBuilderData, true) : $rawBuilderData;
        $this->assertArrayHasKey('vi', $decoded);
        $this->assertArrayHasKey('en', $decoded);
        $this->assertArrayNotHasKey('locales', $decoded);
    }

    /**
     * TEST Security: Reject Non-Image Files
     */
    public function test_reject_dangerous_or_non_image_files(): void
    {
        $fakeScript = UploadedFile::fake()->create('malicious.php', 100, 'text/x-php');

        $response = $this->actingAs($this->admin)->post('/vi/admin/media/upload', [
            'file' => $fakeScript,
            'folder' => 'general',
            'image_only' => 1,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
    }
}
