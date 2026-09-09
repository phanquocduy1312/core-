<?php

namespace Tests\Feature;

use App\Models\ContactInquiry;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInquiryTest extends TestCase
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

        \App\Models\FeatureSetting::query()->updateOrCreate(
            ['feature_code' => 'cms_page'],
            ['is_enabled' => true],
        );
    }

    public function test_guest_can_submit_contact_form_successfully(): void
    {
        $payload = [
            'name' => 'Nguyen Van A',
            'title' => 'Lighting Designer',
            'company' => 'A&A Architecture Studio',
            'email' => 'designer.a@example.com',
            'phone' => '+84 901 234 567',
            'enquiry_type' => 'Sales Enquiry',
            'message' => 'We are designing a luxury resort in Danang and would like a product catalog and lighting quote.',
        ];

        $response = $this->postJson('/contact/submit', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_inquiries', [
            'name' => 'Nguyen Van A',
            'title' => 'Lighting Designer',
            'company' => 'A&A Architecture Studio',
            'email' => 'designer.a@example.com',
            'phone' => '+84 901 234 567',
            'enquiry_type' => 'Sales Enquiry',
            'status' => ContactInquiry::STATUS_NEW,
        ]);
    }

    public function test_guest_can_submit_contact_form_with_gravity_form_field_names(): void
    {
        $payload = [
            'input_3' => 'Tran Thi B',
            'input_4' => 'Project Director',
            'input_5' => 'VinGroup Partners',
            'input_25' => 'director.b@example.com',
            'input_27' => '0987654321',
            'input_18' => 'Technical Enquiry',
            'input_22' => 'Need DMX lighting controllers compatibility info.',
        ];

        $response = $this->postJson('/contact/submit', $payload);

        $response->assertOk()
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('contact_inquiries', [
            'name' => 'Tran Thi B',
            'title' => 'Project Director',
            'company' => 'VinGroup Partners',
            'email' => 'director.b@example.com',
            'phone' => '0987654321',
            'enquiry_type' => 'Technical Enquiry',
            'status' => ContactInquiry::STATUS_NEW,
        ]);
    }

    public function test_contact_form_validation_fails_on_missing_required_fields(): void
    {
        $response = $this->postJson('/contact/submit', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'phone', 'message']);
    }

    public function test_admin_can_view_contact_inquiries_list(): void
    {
        $admin = $this->createAdmin();

        ContactInquiry::factory()->create([
            'name' => 'Hoang Minh',
            'status' => ContactInquiry::STATUS_NEW,
            'enquiry_type' => 'Sales Enquiry',
        ]);

        $response = $this->actingAs($admin)->get('/vi/admin/contact-inquiries');

        $response->assertOk()
            ->assertSeeText('Hoang Minh')
            ->assertSeeText('Mới tiếp nhận');
    }

    public function test_admin_can_filter_inquiries_by_status_and_type(): void
    {
        $admin = $this->createAdmin();

        ContactInquiry::factory()->create([
            'name' => 'Customer New',
            'status' => ContactInquiry::STATUS_NEW,
            'enquiry_type' => 'Sales Enquiry',
        ]);

        ContactInquiry::factory()->create([
            'name' => 'Customer Replied',
            'status' => ContactInquiry::STATUS_REPLIED,
            'enquiry_type' => 'Technical Enquiry',
        ]);

        $response = $this->actingAs($admin)->get('/vi/admin/contact-inquiries?status=new&enquiry_type=Sales+Enquiry');

        $response->assertOk()
            ->assertSeeText('Customer New')
            ->assertDontSeeText('Customer Replied');
    }

    public function test_admin_can_view_and_update_contact_inquiry_detail(): void
    {
        $admin = $this->createAdmin();

        $inquiry = ContactInquiry::factory()->create([
            'name' => 'Le Van C',
            'status' => ContactInquiry::STATUS_NEW,
            'admin_notes' => null,
        ]);

        $detailResponse = $this->actingAs($admin)->get("/vi/admin/contact-inquiries/{$inquiry->id}");
        $detailResponse->assertOk()
            ->assertSeeText('Le Van C');

        $updateResponse = $this->actingAs($admin)->put("/vi/admin/contact-inquiries/{$inquiry->id}", [
            'status' => ContactInquiry::STATUS_PROCESSING,
            'admin_notes' => 'Đã gọi điện trao đổi bước đầu với anh C, hẹn gửi báo giá thứ 6.',
        ]);

        $updateResponse->assertRedirect("/vi/admin/contact-inquiries/{$inquiry->id}");

        $inquiry->refresh();
        $this->assertSame(ContactInquiry::STATUS_PROCESSING, $inquiry->status);
        $this->assertStringContainsString('Đã gọi điện trao đổi', $inquiry->admin_notes);
    }

    public function test_admin_can_perform_bulk_actions_and_export_csv(): void
    {
        $admin = $this->createAdmin();

        $inq1 = ContactInquiry::factory()->create(['status' => ContactInquiry::STATUS_NEW]);
        $inq2 = ContactInquiry::factory()->create(['status' => ContactInquiry::STATUS_NEW]);

        // Bulk mark replied
        $bulkResponse = $this->actingAs($admin)->patch('/vi/admin/contact-inquiries/bulk', [
            'ids' => [$inq1->id, $inq2->id],
            'action' => 'mark_replied',
        ]);
        $bulkResponse->assertRedirect();

        $this->assertSame(ContactInquiry::STATUS_REPLIED, $inq1->fresh()->status);
        $this->assertSame(ContactInquiry::STATUS_REPLIED, $inq2->fresh()->status);

        // Export CSV
        $exportResponse = $this->actingAs($admin)->get('/vi/admin/contact-inquiries/export');
        $exportResponse->assertOk();
        $this->assertStringContainsString('text/csv', $exportResponse->headers->get('content-type'));
    }

    public function test_guest_cannot_access_admin_contact_inquiries(): void
    {
        $response = $this->get('/vi/admin/contact-inquiries');
        $response->assertRedirect('/vi/admin/login');
    }
}
