<?php

namespace App\Services\PageImporter;

use App\Services\PageImporter\Exceptions\SecurityException;
use App\Services\PageImporter\Exceptions\ImporterException;
use Illuminate\Support\Facades\Http;

class SourceFetcher
{
    private const MAX_BODY_SIZE = 10485760; // 10MB
    private const CONNECT_TIMEOUT = 5;
    private const REQUEST_TIMEOUT = 10;

    /**
     * Read local fixture file
     */
    public function fetchFixture(string $fixturePath): string
    {
        if (! file_exists($fixturePath)) {
            throw new ImporterException("Fixture file not found: {$fixturePath}");
        }

        $content = file_get_contents($fixturePath);
        if ($content === false) {
            throw new ImporterException("Failed to read fixture file: {$fixturePath}");
        }

        return $content;
    }

    /**
     * Fetch remote URL safely with SSRF protection and redirect inspection
     */
    public function fetchRemote(string $url, int $maxRedirects = 5): string
    {
        return $this->fetchBinary($url, $maxRedirects, 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
    }

    /**
     * Fetch remote binary/image safely with SSRF protection and redirect inspection
     */
    public function fetchBinary(string $url, int $maxRedirects = 5, string $accept = '*/*'): string
    {
        $currentUrl = $url;
        $redirectCount = 0;

        while ($redirectCount <= $maxRedirects) {
            $this->validateSafeUrl($currentUrl);

            try {
                $response = Http::timeout(self::REQUEST_TIMEOUT)
                    ->connectTimeout(self::CONNECT_TIMEOUT)
                    ->withoutRedirecting()
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Antigravity-Importer/1.0',
                        'Accept' => $accept,
                    ])
                    ->get($currentUrl);

                // Handle Redirects
                if ($response->status() >= 300 && $response->status() < 400) {
                    $location = $response->header('Location');
                    if (! $location) {
                        throw new ImporterException('Redirect response missing Location header');
                    }

                    // Resolve relative redirect URL
                    if (str_starts_with($location, '/')) {
                        $parsed = parse_url($currentUrl);
                        $location = ($parsed['scheme'] ?? 'http') . '://' . ($parsed['host'] ?? '') . $location;
                    }

                    $currentUrl = $location;
                    $redirectCount++;
                    continue;
                }

                if (! $response->successful()) {
                    throw new ImporterException("Remote server responded with status: {$response->status()}");
                }

                $body = $response->body();
                if (strlen($body) > self::MAX_BODY_SIZE) {
                    throw new SecurityException('Remote payload exceeds maximum allowed size (10MB)');
                }

                return $body;
            } catch (\Throwable $e) {
                if ($e instanceof ImporterException) {
                    throw $e;
                }
                throw new ImporterException("Failed to fetch remote asset: {$e->getMessage()}", 0, $e);
            }
        }

        throw new SecurityException('Too many redirects encountered while fetching remote resource');
    }

    /**
     * SSRF Protection: Blocks private IPs, loopback, link-local, cloud metadata
     */
    public function validateSafeUrl(string $url): void
    {
        $parsed = parse_url($url);
        if (! $parsed || empty($parsed['scheme']) || empty($parsed['host'])) {
            throw new SecurityException('Invalid URL format');
        }

        $scheme = strtolower($parsed['scheme']);
        if (! in_array($scheme, ['http', 'https'], true)) {
            throw new SecurityException("Unsupported URL scheme: {$scheme}. Only http and https are permitted.");
        }

        $host = strtolower($parsed['host']);

        // Block direct loopback / localhost
        if ($host === 'localhost' || $host === '127.0.0.1' || $host === '::1') {
            throw new SecurityException('Access to localhost / loopback addresses is forbidden');
        }

        // Resolve DNS and verify IP range
        $ips = @dns_get_record($host, DNS_A + DNS_AAAA);
        $resolvedIps = [];
        if (is_array($ips)) {
            foreach ($ips as $record) {
                if (! empty($record['ip'])) $resolvedIps[] = $record['ip'];
                if (! empty($record['ipv6'])) $resolvedIps[] = $record['ipv6'];
            }
        }

        if (empty($resolvedIps)) {
            $ip = gethostbyname($host);
            if ($ip !== $host) {
                $resolvedIps[] = $ip;
            }
        }

        foreach ($resolvedIps as $ip) {
            if ($this->isPrivateOrReservedIp($ip)) {
                throw new SecurityException("Host {$host} resolves to private/reserved IP: {$ip}");
            }
        }
    }

    private function isPrivateOrReservedIp(string $ip): bool
    {
        return ! filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }
}
