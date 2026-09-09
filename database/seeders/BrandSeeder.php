<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Services\LocalizedSlugService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/luxlight_brands.json');
        if (file_exists($jsonPath)) {
            $luxlightBrands = json_decode(file_get_contents($jsonPath), true);
            $localizedSlugs = app(LocalizedSlugService::class);

            foreach ($luxlightBrands as $b) {
                $nameStr = $b['name'];
                $slug = Str::slug($nameStr);

                $brand = Brand::query()->updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => ['vi' => $nameStr, 'en' => $nameStr],
                        'country' => $b['country'] ?? null,
                        'description' => [
                            'vi' => $b['description'] ?? '',
                            'en' => $b['description'] ?? '',
                        ],
                        'website_url' => $b['website_url'] ?? null,
                        'image_url' => $b['image_url'] ?? null,
                        'showcase_image' => $b['showcase_image'] ?? null,
                        'sort_order' => $b['sort_order'] ?? 0,
                        'is_active' => true,
                    ]
                );

                $localizedSlugs->sync($brand, ['vi' => $slug, 'en' => $slug], $brand->getTranslations('name'));
            }

            return;
        }
    }
}
