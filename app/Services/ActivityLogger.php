<?php

namespace App\Services;

use App\Models\AdminActivityLog;
use App\Support\LogRedactor;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    public static function log(string $action, ?Model $subject, string $description, array $changes = []): void
    {
        AdminActivityLog::query()->create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $subject ? $subject::class : null,
            'subject_id' => $subject?->getKey(),
            'description' => $description,
            'changes' => $changes ? LogRedactor::redact($changes) : null,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
