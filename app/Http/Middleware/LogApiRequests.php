<?php

namespace App\Http\Middleware;

use App\Support\LogRedactor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LogApiRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('api_log.enabled')) {
            return $next($request);
        }

        $requestId = (string) Str::uuid();
        $request->attributes->set('request_id', $requestId);
        $start = microtime(true);

        // Laravel's routing Pipeline already converts an exception thrown by a
        // deeper middleware/controller into a rendered Response (reporting it
        // through the normal exception handler) before it reaches us here, so
        // $next() never throws — the failure surfaces as $response->exception.
        $response = $next($request);
        $exception = property_exists($response, 'exception') ? $response->exception : null;

        $this->write($request, $requestId, $response->getStatusCode(), $start, $exception);

        $response->headers->set('X-Request-Id', $requestId);

        return $response;
    }

    private function write(Request $request, string $requestId, int $status, float $start, ?Throwable $exception): void
    {
        $routeName = $request->route()?->getName();

        if (in_array($routeName, config('api_log.ignored_routes', []), true)) {
            return;
        }

        $durationMs = (int) round((microtime(true) - $start) * 1000);

        $payload = LogRedactor::redact($request->except(['file', 'avatar_file']));
        $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $bodyLimit = (int) config('api_log.body_limit', 4096);
        if ($encoded !== false && strlen($encoded) > $bodyLimit) {
            $encoded = mb_substr($encoded, 0, $bodyLimit).'…(truncated)';
        }

        $context = [
            'request_id' => $requestId,
            'method' => $request->method(),
            'path' => $request->path(),
            'route_name' => $routeName,
            'status' => $status,
            'duration_ms' => $durationMs,
            'ip' => $request->ip(),
            'user_id' => $request->user()?->id,
            'user_agent' => (string) $request->userAgent(),
            'payload' => $encoded,
        ];

        Log::channel('api')->info('api_request', $context);

        if ($status >= 500 || $exception) {
            Log::channel('api_error')->error('api_request_failed', $context + [
                'exception_class' => $exception ? $exception::class : null,
                'exception_message' => $exception?->getMessage(),
                'exception_location' => $exception ? $exception->getFile().':'.$exception->getLine() : null,
            ]);
        }
    }
}
