<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SplFileObject;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LogViewerController extends Controller
{
    private const MAX_TAIL_LINES = 2000;
    private const DEFAULT_TAIL_LINES = 500;

    public function index()
    {
        $files = collect($this->availableFiles())
            ->map(fn (string $path, string $name) => [
                'name' => $name,
                'size' => filesize($path),
                'modified_at' => filemtime($path),
            ])
            ->sortByDesc('modified_at')
            ->values();

        return view('admin.logs.index', ['files' => $files]);
    }

    public function show(Request $request, string $locale, string $file)
    {
        $path = $this->resolveFile($file);

        $limit = min(self::MAX_TAIL_LINES, max(50, $request->integer('lines', self::DEFAULT_TAIL_LINES)));
        $lines = $this->tail($path, $limit);

        $keyword = trim((string) $request->query('q', ''));
        $requestId = trim((string) $request->query('request_id', ''));
        $status = trim((string) $request->query('status', ''));
        $userId = trim((string) $request->query('user_id', ''));

        if ($keyword !== '') {
            $lines = array_values(array_filter($lines, fn (string $line) => str_contains($line, $keyword)));
        }
        if ($requestId !== '') {
            $lines = array_values(array_filter($lines, fn (string $line) => str_contains($line, '"request_id":"'.$requestId.'"')));
        }
        if ($status !== '') {
            $lines = array_values(array_filter($lines, fn (string $line) => str_contains($line, '"status":'.$status)));
        }
        if ($userId !== '') {
            $lines = array_values(array_filter($lines, fn (string $line) => str_contains($line, '"user_id":'.$userId)));
        }

        return view('admin.logs.show', [
            'file' => $file,
            'lines' => $lines,
            'filters' => compact('keyword', 'requestId', 'status', 'userId'),
            'limit' => $limit,
        ]);
    }

    public function download(string $locale, string $file): BinaryFileResponse
    {
        $path = $this->resolveFile($file);

        return response()->download($path, basename($file), ['Content-Type' => 'text/plain']);
    }

    /** @return array<string, string> */
    private function availableFiles(): array
    {
        $files = [];

        foreach (glob(storage_path('logs/*.log')) ?: [] as $path) {
            $files[basename($path)] = $path;
        }

        foreach (glob(storage_path('logs/api/*.log')) ?: [] as $path) {
            $files['api/'.basename($path)] = $path;
        }

        return $files;
    }

    private function resolveFile(string $file): string
    {
        $safeName = str_starts_with($file, 'api/')
            ? 'api/'.basename($file)
            : basename($file);

        $path = $this->availableFiles()[$safeName] ?? null;

        abort_if($path === null, 404);

        return $path;
    }

    /** @return array<int, string> */
    private function tail(string $path, int $lines): array
    {
        $file = new SplFileObject($path, 'r');
        $file->seek(PHP_INT_MAX);
        $totalLines = $file->key();

        $start = max(0, $totalLines - $lines);
        $file->seek($start);

        $result = [];
        while (! $file->eof()) {
            $line = $file->fgets();
            if ($line !== false && trim($line) !== '') {
                $result[] = rtrim($line, "\r\n");
            }
        }

        return $result;
    }
}
