<?php

namespace App\Services\PageImporter;

use App\Services\PageImporter\Exceptions\ValidationException;

class ProjectValidator
{
    private const ALLOWED_COMPONENT_TYPES = [
        'wrapper',
        'builder-section',
        'builder-container',
        'builder-columns',
        'builder-column',
        'builder-grid',
        'builder-stack',
        'builder-heading',
        'builder-paragraph',
        'builder-button',
        'image',
        'builder-divider',
        'builder-spacer',
        'builder-icon',
        'builder-video',
        'builder-dynamic-product-grid',
        'builder-dynamic-product-tabs',
        'builder-dynamic-category-grid',
        'builder-dynamic-post-list',
        'builder-dynamic-latest-reviews',
        'builder-dynamic-contact-form',
        'builder-partial',
    ];

    /**
     * Validates GrapesJS Project Data structure
     *
     * @throws ValidationException
     */
    public function validate(array $projectData): void
    {
        $errors = [];

        if (empty($projectData['pages']) || ! is_array($projectData['pages'])) {
            $errors[] = 'Project Data must contain a valid "pages" array.';
        } else {
            foreach ($projectData['pages'] as $pIdx => $page) {
                if (empty($page['frames']) || ! is_array($page['frames'])) {
                    $errors[] = "Page at index {$pIdx} must contain valid 'frames' array.";
                    continue;
                }

                foreach ($page['frames'] as $fIdx => $frame) {
                    if (empty($frame['component']) || ! is_array($frame['component'])) {
                        $errors[] = "Frame {$fIdx} on page {$pIdx} is missing root component.";
                        continue;
                    }

                    $this->validateComponentTree($frame['component'], $errors);
                }
            }
        }

        if (! empty($errors)) {
            throw new ValidationException('Project Data schema validation failed', $errors);
        }
    }

    private function validateComponentTree(array $comp, array &$errors): void
    {
        $type = $comp['type'] ?? null;
        if (! $type || ! in_array($type, self::ALLOWED_COMPONENT_TYPES, true)) {
            $errors[] = "Disallowed or unknown component type: '{$type}'.";
            return;
        }

        // Check for forbidden attributes (scripts, javascript: URLs)
        if (! empty($comp['attributes'])) {
            foreach ($comp['attributes'] as $attr => $val) {
                if (str_starts_with(strtolower($attr), 'on')) {
                    $errors[] = "Inline event handler '{$attr}' is strictly forbidden.";
                }
                if ($attr === 'href' && is_string($val) && (str_starts_with($val, 'javascript:') || str_starts_with($val, 'data:'))) {
                    $errors[] = "Dangerous URL protocol detected in href: '{$val}'.";
                }
            }
        }

        // Validate nested components
        if (! empty($comp['components']) && is_array($comp['components'])) {
            foreach ($comp['components'] as $child) {
                if (is_array($child)) {
                    $this->validateComponentTree($child, $errors);
                }
            }
        }
    }
}
