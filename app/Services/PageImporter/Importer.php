<?php

namespace App\Services\PageImporter;

use App\Models\Page;
use App\Services\PageBuilderService;
use App\Services\PageImporter\Exceptions\ImporterException;
use App\Services\PageImporter\Exceptions\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Importer
{
    private DomAnalyzer $domAnalyzer;
    private SectionClassifier $classifier;
    private SectionMapper $sectionMapper;
    private ProjectBuilder $projectBuilder;
    private ProjectValidator $projectValidator;
    private PageBuilderService $pageBuilderService;
    private StyleExtractor $styleExtractor;
    private ResponsiveMapper $responsiveMapper;

    public function __construct(
        DomAnalyzer $domAnalyzer,
        SectionClassifier $classifier,
        SectionMapper $sectionMapper,
        ProjectBuilder $projectBuilder,
        ProjectValidator $projectValidator,
        PageBuilderService $pageBuilderService,
        StyleExtractor $styleExtractor,
        ResponsiveMapper $responsiveMapper
    ) {
        $this->domAnalyzer = $domAnalyzer;
        $this->classifier = $classifier;
        $this->sectionMapper = $sectionMapper;
        $this->projectBuilder = $projectBuilder;
        $this->projectValidator = $projectValidator;
        $this->pageBuilderService = $pageBuilderService;
        $this->styleExtractor = $styleExtractor;
        $this->responsiveMapper = $responsiveMapper;
    }

    /**
     * Executes the full Import Pipeline on a source document
     */
    public function import(ImportContext $context): ImportResult
    {
        $startTime = microtime(true);
        $report = new ImportReport();
        $report->jobId = $context->jobId;
        $report->sourceUrl = $context->sourceUrl;

        Log::info("PageImporter: Starting import job [{$context->jobId}]", [
            'source_url' => $context->sourceUrl,
            'locale' => $context->locale,
            'strategy' => $context->strategy,
        ]);

        try {
            // 1. Analyze & Sanitize DOM
            $sourceDoc = $this->domAnalyzer->analyze($context->html, $context->sourceUrl, $context->baseUrl);

            // 2. Extract & Scope Styles (Stylesheet rules + Media Queries)
            $extractedRules = [];
            foreach ($sourceDoc->stylesheets as $cssText) {
                $rules = $this->styleExtractor->parseStylesheet($cssText, $this->responsiveMapper, $report);
                $extractedRules = array_merge($extractedRules, $rules);
            }

            // 3. Identify Sections
            $sectionNodes = $this->classifier->findSectionNodes($sourceDoc);
            $report->sectionsDetected = count($sectionNodes);

            if ($report->sectionsDetected === 0) {
                $report->addWarning('No distinct top-level sections found. Wrapping entire document in generic section.');
                $bodyNode = $sourceDoc->dom->getElementsByTagName('body')->item(0) ?: $sourceDoc->dom->documentElement;
                $sectionNodes = [$bodyNode];
                $report->sectionsDetected = 1;
            }

            // 4. Classify & Map Sections
            $sectionComponents = [];
            foreach ($sectionNodes as $index => $node) {
                $classification = $this->classifier->classify($node, $sourceDoc, $index);
                $sectionComponent = $this->sectionMapper->mapSection($classification, $context, $report, $index);
                $sectionComponents[] = $sectionComponent;

                // Extract inline styles for section if present
                $inlineStyle = $node->getAttribute('style');
                if ($inlineStyle) {
                    $inlineProps = $this->styleExtractor->extractInlineStyles($inlineStyle, $report);
                    if (! empty($inlineProps)) {
                        $cls = $node->getAttribute('class') ?: 'section-' . ($index + 1);
                        $extractedRules[] = [
                            'selectors' => ['.' . strtok($cls, ' ')],
                            'style' => $inlineProps,
                            'mediaText' => null,
                        ];
                    }
                }
            }

            // 5. Build Project Data, HTML & CSS
            $projectData = $this->projectBuilder->buildProjectData($sectionComponents, $extractedRules, null, $report);
            $publishedHtml = $this->projectBuilder->generateHtml($sectionComponents);
            $publishedCss = $this->projectBuilder->generateCss($projectData['styles']);

            // 6. Strict Schema Validation
            $this->projectValidator->validate($projectData);

            // 7. Save Draft Only (Never auto-publish live page)
            $page = $this->persistDraft($projectData, $publishedHtml, $publishedCss, $sourceDoc, $context);

            $report->durationMs = (microtime(true) - $startTime) * 1000;

            Log::info("PageImporter: Import job completed successfully [{$context->jobId}]", [
                'sections_detected' => $report->sectionsDetected,
                'registry_matched' => $report->registryMatched,
                'composed_generic' => $report->composedGeneric,
                'styles_mapped' => count($extractedRules),
                'duration_ms' => $report->durationMs,
            ]);

            return new ImportResult(
                true,
                $page,
                $projectData,
                $publishedHtml,
                $publishedCss,
                $report
            );
        } catch (\Throwable $e) {
            $report->durationMs = (microtime(true) - $startTime) * 1000;
            Log::error("PageImporter: Import job failed [{$context->jobId}]: {$e->getMessage()}", [
                'exception' => $e,
            ]);

            return new ImportResult(
                false,
                null,
                [],
                '',
                '',
                $report,
                $e->getMessage()
            );
        }
    }

    private function persistDraft(array $projectData, string $html, string $css, SourceDocument $sourceDoc, ImportContext $context): Page
    {
        return DB::transaction(function () use ($projectData, $html, $css, $sourceDoc, $context): Page {
            $locale = $context->locale;
            $title = $context->pageTitle ?: ($sourceDoc->title ?: 'Imported Page ' . date('Y-m-d H:i'));
            $slug = $context->pageSlug ?: Str::slug($title) . '-' . Str::random(4);

            if ($context->targetPageId && $context->strategy === ImportContext::STRATEGY_REPLACE_DRAFT) {
                $page = Page::query()->findOrFail($context->targetPageId);
                $this->pageBuilderService->updateLocale($page, $locale, [
                    'builder_data' => $projectData,
                    'published_html' => $html,
                    'published_css' => $css,
                ], $context->userId);
                return $page->fresh();
            }

            // Create new page in Draft status
            $page = new Page();
            $page->title = [$locale => $title];
            $page->slug = $slug;
            $page->type = 'page';
            $page->is_active = false; // Always Draft
            $page->published_at = null;
            $page->schema_version = 1;
            $page->builder_data = [$locale => $projectData];
            $page->published_html = [$locale => $html];
            $page->published_css = [$locale => $css];
            $page->save();

            return $page;
        });
    }
}
