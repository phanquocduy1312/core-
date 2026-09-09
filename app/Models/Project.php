<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedSlugs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, HasLocalizedSlugs, HasTranslations;

    public array $translatable = [
        'title',
        'location',
        'summary',
        'content',
    ];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'location',
        'client',
        'completion_year',
        'summary',
        'content',
        'image_url',
        'banner_url',
        'gallery',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'gallery' => 'array',
    ];

    public const CATEGORIES = [
        'hospitality' => [
            'vi' => 'Khách sạn & Nghỉ dưỡng',
            'en' => 'Hospitality Lighting',
            'ko' => '호텔 & 리조트 조명',
            'url' => '/hospitality-lighting-projects',
        ],
        'residential' => [
            'vi' => 'Nhà ở & Căn hộ',
            'en' => 'Residential Lighting',
            'ko' => '주거 & 아파트 조명',
            'url' => '/residential-lighting-projects',
        ],
        'commercial' => [
            'vi' => 'Thương mại & Văn phòng',
            'en' => 'Commercial Lighting',
            'ko' => '상업 & 오피스 조명',
            'url' => '/commercial-lighting-projects',
        ],
        'other' => [
            'vi' => 'Dự án khác',
            'en' => 'Other Lighting Projects',
            'ko' => '기타 조명 프로젝트',
            'url' => '/other-lighting-projects',
        ],
    ];

    public function categoryLabel(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $cat = self::CATEGORIES[$this->category] ?? null;
        if (! $cat) {
            return ucfirst($this->category);
        }

        return $cat[$locale] ?? $cat['vi'] ?? ucfirst($this->category);
    }

    public function categoryUrl(): string
    {
        return self::CATEGORIES[$this->category]['url'] ?? '/projects';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
