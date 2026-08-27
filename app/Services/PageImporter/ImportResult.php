<?php

namespace App\Services\PageImporter;

use App\Models\Page;

class ImportResult
{
    public bool $success;
    public ?Page $page;
    public array $projectData;
    public string $publishedHtml;
    public string $publishedCss;
    public ImportReport $report;
    public ?string $errorMessage;

    public function __construct(
        bool $success,
        ?Page $page,
        array $projectData,
        string $publishedHtml,
        string $publishedCss,
        ImportReport $report,
        ?string $errorMessage = null
    ) {
        $this->success = $success;
        $this->page = $page;
        $this->projectData = $projectData;
        $this->publishedHtml = $publishedHtml;
        $this->publishedCss = $publishedCss;
        $this->report = $report;
        $this->errorMessage = $errorMessage;
    }
}
