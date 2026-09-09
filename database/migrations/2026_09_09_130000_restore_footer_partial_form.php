<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    public function up(): void
    {
        $footer = Page::query()->partials()->where('partial_role', 'footer')->first();
        if (! $footer) {
            return;
        }

        $enHtml = (string) $footer->getTranslation('published_html', 'en', false);

        // If English translation has the complete footer markup with the form, restore it to Vietnamese
        if ($enHtml !== '' && str_contains($enHtml, 'gform_wrapper_4')) {
            $footer->setTranslation('published_html', 'vi', $enHtml);
            $footer->saveQuietly();
        }

        Cache::forget('site_default_footer_id');
        Cache::increment('page-partials-version');
    }

    public function down(): void
    {
        // No-op
    }
};
