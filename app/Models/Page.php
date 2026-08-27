<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedSlugs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasLocalizedSlugs, HasTranslations, SoftDeletes;

    public array $translatable = [
        'title',
        'builder_data',
        'published_html',
        'published_css',
        'meta_title',
        'meta_description',
    ];

    protected $fillable = [
        'type',
        'partial_role',
        'title',
        'slug',
        'schema_version',
        'builder_data',
        'published_html',
        'published_css',
        'meta_title',
        'meta_description',
        'is_active',
        'published_at',
        'header_mode',
        'header_partial_id',
        'footer_mode',
        'footer_partial_id',
    ];

    protected $casts = [
        'builder_data' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePages(Builder $query): Builder
    {
        return $query->where('type', 'page');
    }

    public function scopePartials(Builder $query): Builder
    {
        return $query->where('type', 'partial');
    }

    public function isPartial(): bool
    {
        return $this->type === 'partial';
    }

    public function headerPartial()
    {
        return $this->belongsTo(self::class, 'header_partial_id');
    }

    public function footerPartial()
    {
        return $this->belongsTo(self::class, 'footer_partial_id');
    }

    public function revisions()
    {
        return $this->hasMany(PageRevision::class)->latest('created_at');
    }
}
