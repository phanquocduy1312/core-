<?php

namespace App\Services\Catalog;

use App\Models\Brand;
use App\Support\HtmlSanitizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\LanguageRegistry;
use App\Services\LocalizedSlugService;
use Illuminate\Support\Facades\DB;

class BrandService
{
    public function __construct(
        private readonly \App\Services\CloudinaryService $cloudinaryService,
        private readonly HtmlSanitizer $htmlSanitizer,
        private readonly LocalizedSlugService $localizedSlugs,
        private readonly LanguageRegistry $languages,
    )
    {
    }
    public function create(array $data): Brand
    {
        return DB::transaction(function () use ($data) {
            $brand = Brand::query()->create($this->payload($data));
            $this->localizedSlugs->sync($brand, $this->localizedValues($data['slug'] ?? []), $brand->getTranslations('name'));
            return $brand->refresh();
        });
    }

    public function update(Brand $brand, array $data): Brand
    {
        return DB::transaction(function () use ($brand, $data) {
            $brand->update($this->payload($data, $brand));
            $this->localizedSlugs->sync($brand, $this->localizedValues($data['slug'] ?? []), $brand->getTranslations('name'));
            return $brand->refresh();
        });
    }

    public function delete(Brand $brand): void
    {
        $brand->delete();
    }

    public function reorder(array $ids, int $startOrder = 0): void
    {
        foreach (array_values($ids) as $index => $id) {
            Brand::query()
                ->whereKey($id)
                ->update(['sort_order' => $startOrder + $index]);
        }
    }

    private function payload(array $data, ?Brand $brand = null): array
    {
        $name = $this->translationValue($data['name'] ?? null, $brand, 'name');
        $submittedSlugs = $this->localizedValues($data['slug'] ?? []);
        $baseSlug = $submittedSlugs[$this->languages->defaultLocale()] ?? $submittedSlugs[app()->getLocale()] ?? ($name[$this->languages->defaultLocale()] ?? $name[$this->fallbackLocale()] ?? reset($name));

        $imageUrl = $this->imageUrl($data['image_file'] ?? null, $data['image_url'] ?? null, $brand, !empty($data['remove_image']));
        $showcaseImage = $this->showcaseImageUrl($data['showcase_image_file'] ?? null, $data['showcase_image'] ?? null, $brand, !empty($data['remove_showcase_image']));

        $country = array_key_exists('country', $data)
            ? (filled($data['country']) ? trim($data['country']) : null)
            : $brand?->country;

        $websiteUrl = array_key_exists('website_url', $data)
            ? $this->normalizeUrl($data['website_url'] ?? null)
            : $brand?->website_url;

        return [
            'name' => $name,
            'slug' => $this->uniqueSlug((string) $baseSlug, $brand?->id),
            'country' => $country,
            'description' => $this->translationValue($data['description'] ?? null, $brand, 'description'),
            'image_url' => $imageUrl,
            'showcase_image' => $showcaseImage,
            'website_url' => $websiteUrl,
            'sort_order' => (int) ($data['sort_order'] ?? $brand?->sort_order ?? 0),
            'is_active' => (bool) ($data['is_active'] ?? false),
            'is_featured' => (bool) ($data['is_featured'] ?? false),
        ];
    }

    private function imageUrl(?UploadedFile $file, ?string $selectedUrl, ?Brand $brand, bool $remove = false): ?string
    {
        if ($remove) {
            return null;
        }

        if ($file) {
            return $this->cloudinaryService->uploadFile($file, 'brands');
        }

        return filled($selectedUrl) ? trim($selectedUrl) : $brand?->image_url;
    }

    private function showcaseImageUrl(?UploadedFile $file, ?string $selectedUrl, ?Brand $brand, bool $remove = false): ?string
    {
        if ($remove) {
            return null;
        }

        if ($file) {
            return $this->cloudinaryService->uploadFile($file, 'brands');
        }

        return filled($selectedUrl) ? trim($selectedUrl) : $brand?->showcase_image;
    }

    private function normalizeUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $url = trim($url);
        if (! preg_match('~^https?://~i', $url)) {
            return 'https://' . $url;
        }

        return $url;
    }

    private function translationValue(string|array|null $value, ?Brand $brand, string $attribute): array
    {
        $translations = $brand?->getTranslations($attribute) ?? [];
        $locale = app()->getLocale() ?: $this->fallbackLocale();
        $fallbackLocale = $this->fallbackLocale();

        if (is_array($value)) {
            foreach ($value as $lang => $translation) {
                if ($this->languages->supports((string) $lang)) {
                    $text = is_string($translation) ? trim($translation) : '';
                    if ($attribute === 'description') {
                        if ($text === '<p><br></p>' || $text === '<p></p>' || $text === '<br>') {
                            $text = '';
                        } elseif ($text !== '') {
                            $text = $this->htmlSanitizer->clean($text);
                        }
                    }
                    if ($text !== '') {
                        $translations[$lang] = $text;
                    } else {
                        unset($translations[$lang]);
                    }
                }
            }
        } else {
            $text = is_string($value) ? trim($value) : '';
            if ($attribute === 'description') {
                if ($text === '<p><br></p>' || $text === '<p></p>' || $text === '<br>') {
                    $text = '';
                } elseif ($text !== '') {
                    $text = $this->htmlSanitizer->clean($text);
                }
            }
            if ($text !== '') {
                $translations[$locale] = $text;
                if ($locale !== $fallbackLocale && empty($translations[$fallbackLocale])) {
                    $translations[$fallbackLocale] = $text;
                }
            } else {
                unset($translations[$locale]);
            }
        }

        return array_filter($translations, fn ($translation) => $translation !== null && $translation !== '');
    }

    private function fallbackLocale(): string
    {
        return $this->languages->fallbackLocale();
    }

    private function localizedValues(string|array|null $value): array
    {
        if (is_array($value)) return collect($value)->filter(fn ($item, $locale) => $this->languages->supports((string) $locale) && is_string($item) && trim($item) !== '')->map(fn (string $item) => trim($item))->all();
        return is_string($value) && trim($value) !== '' ? [app()->getLocale() => trim($value)] : [];
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $slug = Str::slug($value) ?: Str::random(8);
        $base = $slug;
        $counter = 2;

        while (Brand::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
