<?php

namespace App\Services\PageImporter;

class ImportReport
{
    public string $jobId = '';
    public ?string $sourceUrl = null;
    public int $sectionsDetected = 0;
    public int $registryMatched = 0;
    public int $composedGeneric = 0;
    public int $unsupportedRegions = 0;
    public int $mediaImported = 0;
    public int $mediaReused = 0;
    public int $mediaFailed = 0;
    public int $stylesExtracted = 0;
    public int $stylesMapped = 0;
    public int $stylesDropped = 0;
    public int $responsiveRulesMapped = 0;
    public int $styleRulesGenerated = 0;
    public int $styleRulesBound = 0;
    public int $orphanStyleRules = 0;
    public int $styledComponents = 0;
    public int $dynamicCandidates = 0;
    public array $sectionMappings = [];
    public array $warnings = [];
    public array $unsupportedIssues = [];
    public array $visualFidelityNotes = [];
    public float $durationMs = 0.0;

    public function addSectionMapping(string $sourceSelector, string $semanticType, ?string $variant, float $score, string $reason): void
    {
        $this->sectionMappings[] = [
            'source' => $sourceSelector,
            'semantic_type' => $semanticType,
            'variant' => $variant,
            'match_score' => round($score, 2),
            'reason' => $reason,
        ];
    }

    public function addWarning(string $message, array $context = []): void
    {
        $this->warnings[] = [
            'message' => $message,
            'context' => $context,
            'timestamp' => microtime(true),
        ];
    }

    public function addUnsupportedIssue(string $type, string $sourcePath, string $reason, string $suggestion): void
    {
        $this->unsupportedRegions++;
        $this->unsupportedIssues[] = [
            'type' => $type,
            'source_path' => $sourcePath,
            'reason' => $reason,
            'suggestion' => $suggestion,
        ];
    }

    public function toArray(): array
    {
        return [
            'job_id' => $this->jobId,
            'source_url' => $this->sourceUrl,
            'sections_detected' => $this->sectionsDetected,
            'registry_matched' => $this->registryMatched,
            'composed_generic' => $this->composedGeneric,
            'unsupported_regions' => $this->unsupportedRegions,
            'media_imported' => $this->mediaImported,
            'media_reused' => $this->mediaReused,
            'media_failed' => $this->mediaFailed,
            'styles_extracted' => $this->stylesExtracted,
            'styles_mapped' => $this->stylesMapped,
            'styles_dropped' => $this->stylesDropped,
            'responsive_rules_mapped' => $this->responsiveRulesMapped,
            'style_rules_generated' => $this->styleRulesGenerated,
            'style_rules_bound' => $this->styleRulesBound,
            'orphan_style_rules' => $this->orphanStyleRules,
            'styled_components' => $this->styledComponents,
            'dynamic_candidates' => $this->dynamicCandidates,
            'section_mappings' => $this->sectionMappings,
            'warnings' => $this->warnings,
            'unsupported_issues' => $this->unsupportedIssues,
            'visual_fidelity_notes' => $this->visualFidelityNotes,
            'duration_ms' => round($this->durationMs, 2),
        ];
    }
}
