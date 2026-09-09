<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_REPLIED = 'replied';
    public const STATUS_ARCHIVED = 'archived';

    public const STATUSES = [
        self::STATUS_NEW => 'Mới tiếp nhận',
        self::STATUS_PROCESSING => 'Đang xử lý',
        self::STATUS_REPLIED => 'Đã phản hồi',
        self::STATUS_ARCHIVED => 'Lưu trữ',
    ];

    public const ENQUIRY_TYPES = [
        'Sales Enquiry',
        'Technical Enquiry',
        'Feedback',
        'Other',
    ];

    protected $fillable = [
        'name',
        'title',
        'company',
        'email',
        'phone',
        'enquiry_type',
        'message',
        'status',
        'admin_notes',
        'ip_address',
        'user_agent',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['q'] ?? null, function (Builder $query, string $q) {
                $query->where(function (Builder $sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('company', 'like', "%{$q}%")
                        ->orWhere('title', 'like', "%{$q}%");
                });
            })
            ->when($filters['status'] ?? null, function (Builder $query, string $status) {
                $query->where('status', $status);
            })
            ->when($filters['enquiry_type'] ?? null, function (Builder $query, string $type) {
                $query->where('enquiry_type', $type);
            });
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-blue-100 text-blue-800 border-blue-200',
            self::STATUS_PROCESSING => 'bg-amber-100 text-amber-800 border-amber-200',
            self::STATUS_REPLIED => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-700 border-gray-200',
            default => 'bg-gray-100 text-gray-800 border-gray-200',
        };
    }
}
