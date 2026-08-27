<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ApiRequestLoggingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        File::ensureDirectoryExists(storage_path('logs/api'));
        foreach (glob(storage_path('logs/api/*.log')) ?: [] as $path) {
            unlink($path);
        }
    }

    private function apiLogPath(): string
    {
        return storage_path('logs/api/api-'.now()->format('Y-m-d').'.log');
    }

    private function apiErrorLogPath(): string
    {
        return storage_path('logs/api/api-error-'.now()->format('Y-m-d').'.log');
    }

    public function test_public_api_request_is_logged_with_request_id_header(): void
    {
        config(['api_log.enabled' => true]);

        $response = $this->getJson('/api/public/health');

        $response->assertHeader('X-Request-Id');
        $requestId = $response->headers->get('X-Request-Id');

        $this->assertFileExists($this->apiLogPath());
        $log = file_get_contents($this->apiLogPath());
        $this->assertStringContainsString($requestId, $log);
        $this->assertStringContainsString('"route_name"', $log);
    }

    public function test_login_password_is_redacted_in_api_log(): void
    {
        config(['api_log.enabled' => true]);

        $this->postJson('/api/admin/login', [
            'email' => 'nobody@example.test',
            'password' => 'super-secret-password',
        ]);

        $log = file_get_contents($this->apiLogPath());
        $this->assertStringContainsString('[REDACTED]', $log);
        $this->assertStringNotContainsString('super-secret-password', $log);
    }

    public function test_server_error_is_written_to_api_error_channel(): void
    {
        config(['api_log.enabled' => true]);

        Route::middleware('api')->get('/__test/boom', function () {
            throw new \RuntimeException('boom');
        });

        $response = $this->getJson('/__test/boom');

        $response->assertServerError();
        $requestId = $response->headers->get('X-Request-Id');

        $this->assertFileExists($this->apiErrorLogPath());
        $log = file_get_contents($this->apiErrorLogPath());
        $this->assertStringContainsString($requestId, $log);
        $this->assertStringContainsString('RuntimeException', $log);
    }

    public function test_no_log_file_is_written_when_api_logging_disabled(): void
    {
        config(['api_log.enabled' => false]);

        $this->getJson('/api/public/health');

        $this->assertFileDoesNotExist($this->apiLogPath());
    }
}
