<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PruneApiLogs extends Command
{
    protected $signature = 'logs:prune-api';

    protected $description = 'Delete API log files older than their configured retention window';

    public function handle(): int
    {
        $this->pruneDirectory(storage_path('logs/api/api-*.log'), (int) config('logging.channels.api.days', 30));
        $this->pruneDirectory(storage_path('logs/api/api-error-*.log'), (int) config('logging.channels.api_error.days', 90));

        return self::SUCCESS;
    }

    private function pruneDirectory(string $pattern, int $days): void
    {
        $cutoff = now()->subDays($days)->getTimestamp();
        $deleted = 0;

        foreach (glob($pattern) ?: [] as $path) {
            if (filemtime($path) < $cutoff) {
                unlink($path);
                $deleted++;
            }
        }

        if ($deleted > 0) {
            $this->info("Deleted {$deleted} log file(s) matching {$pattern}.");
        }
    }
}
