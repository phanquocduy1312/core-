<?php

namespace App\Console\Commands;

use App\Services\PageImporter\Exceptions\ImporterException;
use App\Services\PageImporter\ImportContext;
use App\Services\PageImporter\Importer;
use App\Services\PageImporter\SourceFetcher;
use Illuminate\Console\Command;

class PageBuilderImportFixtureCommand extends Command
{
    protected $signature = 'page-builder:import-fixture 
                            {fixture : Path to local HTML fixture}
                            {--locale=vi : Content locale (vi, en, ko)}
                            {--page= : Target Page ID to replace draft}
                            {--threshold=0.7 : Confidence threshold for section matching}';

    protected $description = 'Import a local HTML fixture into validated GrapesJS Project Data (Draft mode)';

    public function handle(Importer $importer, SourceFetcher $fetcher): int
    {
        $fixturePath = $this->argument('fixture');
        $locale = $this->option('locale');
        $targetPageId = $this->option('page') ? (int) $this->option('page') : null;
        $threshold = (float) $this->option('threshold');

        $this->info("PageImporter: Reading fixture [{$fixturePath}]...");

        try {
            $html = $fetcher->fetchFixture($fixturePath);
        } catch (ImporterException $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $strategy = $targetPageId ? ImportContext::STRATEGY_REPLACE_DRAFT : ImportContext::STRATEGY_CREATE_NEW;

        $context = new ImportContext(
            $html,
            $fixturePath,
            null,
            $locale,
            $targetPageId,
            $strategy,
            true,
            $threshold
        );

        $this->info("PageImporter: Executing Import Pipeline [Job ID: {$context->jobId}]...");

        $result = $importer->import($context);

        if (! $result->success) {
            $this->error("Import failed: {$result->errorMessage}");
            return 1;
        }

        $report = $result->report;
        $this->table(
            ['Metric', 'Value'],
            [
                ['Job ID', $report->jobId],
                ['Status', 'Success (Draft Saved)'],
                ['Page ID', $result->page?->id],
                ['Page Slug', $result->page?->slug],
                ['Sections Detected', $report->sectionsDetected],
                ['Registry Matched', $report->registryMatched],
                ['Composed Generic', $report->composedGeneric],
                ['Duration (ms)', $report->durationMs],
            ]
        );

        if (! empty($report->sectionMappings)) {
            $this->info("\n--- Section Mappings ---");
            $rows = array_map(fn ($m) => [$m['source'], $m['semantic_type'], $m['variant'] ?: '(Generic)', $m['match_score'], $m['reason']], $report->sectionMappings);
            $this->table(['Source', 'Semantic Type', 'Variant', 'Score', 'Reason'], $rows);
        }

        $this->info("\nImport completed successfully! Open GrapesJS to review the draft page.");
        return 0;
    }
}
