<?php

namespace App\Support;

class LogRedactor
{
    private const SENSITIVE_KEYS = [
        'password',
        'secret',
        'token',
        'api_key',
        'hash_secret',
        'webhook_secret',
        'access_token',
        'refresh_token',
        'authorization',
        'cookie',
        'vnp_securehash',
        'card',
        'cvv',
        'otp',
    ];

    public static function redact(array $values): array
    {
        foreach ($values as $key => $value) {
            $normalizedKey = strtolower((string) $key);
            if (is_array($value)) {
                $values[$key] = self::redact($value);
                continue;
            }

            foreach (self::SENSITIVE_KEYS as $sensitiveKey) {
                if (str_contains($normalizedKey, $sensitiveKey)) {
                    $values[$key] = '[REDACTED]';
                    break;
                }
            }
        }

        return $values;
    }
}
