<?php

namespace Tests\Feature;

use App\Models\FeatureSetting;
use App\Models\NewsletterSubscriber;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsletterSubscriberTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        $role = Role::query()->create([
            'name' => 'Editor',
            'permissions' => ['manage_pages'],
            'is_system' => false,
        ]);

        return User::factory()->create(['role_id' => $role->id, 'is_active' => true]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );
    }

    public function test_guest_can_subscribe_to_newsletter(): void
    {
        $payload = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'company' => 'Acme Lighting Inc',
            'referral' => 'Search Engine',
        ];

        $response = $this->postJson('/newsletter/subscribe', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('newsletter_subscribers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'company' => 'Acme Lighting Inc',
            'referral' => 'Search Engine',
            'is_active' => true,
        ]);
    }

    public function test_subscribing_again_with_same_email_is_idempotent_and_reactivates(): void
    {
        $subscriber = NewsletterSubscriber::factory()->create([
            'email' => 'repeat@example.com',
            'is_active' => false,
            'unsubscribed_at' => now()->subDay(),
        ]);

        $payload = [
            'first_name' => 'Repeat',
            'last_name' => 'User',
            'email' => 'repeat@example.com',
            'company' => 'Re-subscribed Co',
            'referral' => 'Social Media',
        ];

        $response = $this->postJson('/newsletter/subscribe', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $subscriber->refresh();
        $this->assertTrue($subscriber->is_active);
        $this->assertNull($subscriber->unsubscribed_at);
        $this->assertSame('Re-subscribed Co', $subscriber->company);
    }

    public function test_subscription_validation_fails_on_invalid_email(): void
    {
        $response = $this->postJson('/newsletter/subscribe', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_admin_can_view_subscribers_list_and_metrics(): void
    {
        $admin = $this->createAdmin();

        NewsletterSubscriber::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/vi/admin/newsletter-subscribers');

        $response->assertOk()
            ->assertSeeText('Jane Smith')
            ->assertSeeText('jane.smith@example.com');
    }

    public function test_admin_can_filter_subscribers_by_referral_and_status(): void
    {
        $admin = $this->createAdmin();

        NewsletterSubscriber::factory()->create([
            'email' => 'social@example.com',
            'referral' => 'Social Media',
            'is_active' => true,
        ]);

        NewsletterSubscriber::factory()->create([
            'email' => 'other@example.com',
            'referral' => 'Other',
            'is_active' => false,
        ]);

        $response = $this->actingAs($admin)->get('/vi/admin/newsletter-subscribers?referral=Social+Media&status=1');

        $response->assertOk()
            ->assertSeeText('social@example.com')
            ->assertDontSeeText('other@example.com');
    }

    public function test_admin_can_toggle_subscriber_status(): void
    {
        $admin = $this->createAdmin();

        $sub = NewsletterSubscriber::factory()->create(['is_active' => true]);

        $toggleResponse = $this->actingAs($admin)->patch("/vi/admin/newsletter-subscribers/{$sub->id}/toggle-status");
        $toggleResponse->assertRedirect();

        $this->assertFalse($sub->fresh()->is_active);

        // Toggle back to active
        $this->actingAs($admin)->patch("/vi/admin/newsletter-subscribers/{$sub->id}/toggle-status");
        $this->assertTrue($sub->fresh()->is_active);
    }

    public function test_admin_can_delete_subscriber(): void
    {
        $admin = $this->createAdmin();

        $sub = NewsletterSubscriber::factory()->create(['email' => 'todelete@example.com']);

        $deleteResponse = $this->actingAs($admin)->delete("/vi/admin/newsletter-subscribers/{$sub->id}");
        $deleteResponse->assertRedirect('/vi/admin/newsletter-subscribers');

        $this->assertDatabaseMissing('newsletter_subscribers', ['id' => $sub->id]);
    }

    public function test_admin_can_perform_bulk_actions_and_export_csv(): void
    {
        $admin = $this->createAdmin();

        $s1 = NewsletterSubscriber::factory()->create(['is_active' => true]);
        $s2 = NewsletterSubscriber::factory()->create(['is_active' => true]);

        // Bulk deactivate
        $bulkResponse = $this->actingAs($admin)->patch('/vi/admin/newsletter-subscribers/bulk', [
            'ids' => [$s1->id, $s2->id],
            'action' => 'deactivate',
        ]);
        $bulkResponse->assertRedirect();

        $this->assertFalse($s1->fresh()->is_active);
        $this->assertFalse($s2->fresh()->is_active);

        // Export CSV
        $exportResponse = $this->actingAs($admin)->get('/vi/admin/newsletter-subscribers/export');
        $exportResponse->assertOk();
        $this->assertStringContainsString('text/csv', $exportResponse->headers->get('content-type'));
    }

    public function test_guest_cannot_access_admin_subscribers(): void
    {
        $response = $this->get('/vi/admin/newsletter-subscribers');
        $response->assertRedirect('/vi/admin/login');
    }
}
