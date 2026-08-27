<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class LogViewerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        File::ensureDirectoryExists(storage_path('logs/api'));
        File::put(storage_path('logs/api/api-2026-01-01.log'), "{\"message\":\"api_request\",\"context\":{\"request_id\":\"abc\"}}\n");
    }

    protected function tearDown(): void
    {
        File::delete(storage_path('logs/api/api-2026-01-01.log'));

        parent::tearDown();
    }

    public function test_user_without_audit_permission_cannot_view_system_logs(): void
    {
        $role = Role::query()->create(['name' => 'Staff', 'permissions' => ['manage_orders']]);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user)->get('/vi/admin/logs')->assertForbidden();
    }

    public function test_authorized_admin_can_list_and_view_log_files(): void
    {
        $role = Role::query()->create(['name' => 'Auditor', 'permissions' => ['view_audit_log']]);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user)
            ->get('/vi/admin/logs')
            ->assertOk()
            ->assertSee('api/api-2026-01-01.log');

        $this->actingAs($user)
            ->get('/vi/admin/logs/'.'api/api-2026-01-01.log')
            ->assertOk()
            ->assertSee('api_request');
    }

    public function test_path_traversal_in_file_parameter_cannot_leak_files_outside_log_directory(): void
    {
        $role = Role::query()->create(['name' => 'Auditor', 'permissions' => ['view_audit_log']]);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user)
            ->get('/vi/admin/logs/../../.env')
            ->assertNotFound();
    }

    public function test_only_superadmin_can_download_log_files(): void
    {
        $auditorRole = Role::query()->create(['name' => 'Auditor', 'permissions' => ['view_audit_log']]);
        $auditor = User::factory()->create(['role_id' => $auditorRole->id]);

        $this->actingAs($auditor)
            ->get('/vi/admin/logs-download/'.'api/api-2026-01-01.log')
            ->assertForbidden();

        $superRole = Role::query()->create(['name' => 'Superadmin', 'permissions' => ['*'], 'is_system' => true]);
        $super = User::factory()->create(['role_id' => $superRole->id]);

        $this->actingAs($super)
            ->get('/vi/admin/logs-download/'.'api/api-2026-01-01.log')
            ->assertOk();
    }
}
