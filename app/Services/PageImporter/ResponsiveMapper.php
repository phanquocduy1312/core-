<?php

namespace App\Services\PageImporter;

class ResponsiveMapper
{
    public const BREAKPOINT_TABLET = '(max-width: 992px)';
    public const BREAKPOINT_MOBILE = '(max-width: 480px)';

    /**
     * Normalizes an arbitrary source media query toward target builder breakpoints
     */
    public function mapMediaQuery(string $rawQuery): ?string
    {
        if (preg_match('/max-width:\s*([0-9]+)px/i', $rawQuery, $m)) {
            $px = (int) $m[1];
            if ($px <= 576) {
                return self::BREAKPOINT_MOBILE;
            }
            if ($px <= 1024) {
                return self::BREAKPOINT_TABLET;
            }
        }

        return null;
    }
}
