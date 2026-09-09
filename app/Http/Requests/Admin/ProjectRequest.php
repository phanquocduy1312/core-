<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.vi' => ['required', 'string', 'max:255'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.ko' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:hospitality,residential,commercial,other'],
            'client' => ['nullable', 'string', 'max:255'],
            'completion_year' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'array'],
            'location.vi' => ['nullable', 'string', 'max:255'],
            'location.en' => ['nullable', 'string', 'max:255'],
            'location.ko' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'array'],
            'summary.vi' => ['nullable', 'string'],
            'summary.en' => ['nullable', 'string'],
            'summary.ko' => ['nullable', 'string'],
            'content' => ['nullable', 'array'],
            'content.vi' => ['nullable', 'string'],
            'content.en' => ['nullable', 'string'],
            'content.ko' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'banner_url' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'banner' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['nullable', 'string'],
            'gallery_images.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }
}
