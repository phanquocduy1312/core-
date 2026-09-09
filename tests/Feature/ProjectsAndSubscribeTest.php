<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsAndSubscribeTest extends TestCase
{
    public function test_projects_list_route_accessible(): void
    {
        $response = $this->get('/projects');
        $response->assertOk();
        $response->assertSee('Lighting Projects in Asia', false);
    }

    public function test_project_detail_route_renders_post_7892_css_and_banner(): void
    {
        $response = $this->get('/projects/constance-lemuria-praslin');
        $response->assertOk();
        $response->assertSee('post-7892.css');
        $response->assertSee('Constance Lemuria Praslin', false);
        $response->assertSee('Back to List', false);
        $response->assertSee('/hospitality-lighting-projects', false);
        $response->assertSee('style="background-image: url(\'/wp-content/uploads/2021/12/Costance-Lemuria-Praslin_599x599.jpg\')', false);
    }

    public function test_fixed_project_detail_routes_have_valid_back_links(): void
    {
        $artyzen = $this->get('/projects/artyzen-cuscaden-hotel');
        $artyzen->assertOk();
        $artyzen->assertSee('/hospitality-lighting-projects', false);

        $church = $this->get('/projects/church-of-the-blessed-sacrament');
        $church->assertOk();
        $church->assertSee('/other-lighting-projects', false);
    }

    public function test_subscribe_modal_is_included_in_pages(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('id="pum-11677"', false);
        $response->assertSee('Sign Up for eNewsletter Now!', false);
        $response->assertSee('Submit Now', false);
    }

    public function test_newsletter_subscribe_success(): void
    {
        $response = $this->postJson('/newsletter/subscribe', [
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'email' => 'alice.smith@example.com',
            'company' => 'Design Studio',
            'referral' => 'Social Media',
            'agree' => '1',
        ]);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'message' => 'Thank you for subscribing to LuxLight!',
        ]);
    }

    public function test_newsletter_subscribe_validation(): void
    {
        $response = $this->postJson('/newsletter/subscribe', [
            'first_name' => '',
            'last_name' => '',
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'errors']);
    }

    public function test_hospitality_lighting_projects_route(): void
    {
        $response = $this->get('/hospitality-lighting-projects');
        $response->assertOk();
        $response->assertSee('post-5335.css');
        $response->assertSee('Hospitality Lighting Projects', false);
    }

    public function test_residential_lighting_projects_route(): void
    {
        $response = $this->get('/residential-lighting-projects');
        $response->assertOk();
        $response->assertSee('post-10034.css');
        $response->assertSee('Residential Lighting Projects', false);
    }

    public function test_commercial_lighting_projects_route(): void
    {
        $response = $this->get('/commercial-lighting-projects');
        $response->assertOk();
        $response->assertSee('post-10020.css');
        $response->assertSee('Commercial Lighting Projects', false);
    }

    public function test_other_lighting_projects_route(): void
    {
        $response = $this->get('/other-lighting-projects');
        $response->assertOk();
        $response->assertSee('post-10052.css');
        $response->assertSee('Other Lighting Projects', false);
    }

    public function test_privacy_policy_route(): void
    {
        $response = $this->get('/privacy-policy');
        $response->assertOk();
        $response->assertSee('post-4817.css');
        $response->assertSee('Privacy Policy', false);
    }

    public function test_terms_of_use_route(): void
    {
        $response = $this->get('/terms-of-use');
        $response->assertOk();
        $response->assertSee('post-4963.css');
        $response->assertSee('Terms of Use', false);
    }
}


