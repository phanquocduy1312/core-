<?php

namespace App\Http\Requests\Admin\Catalog;

use App\Http\Requests\Concerns\NormalizesLocalizedInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    use NormalizesLocalizedInput;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brandId = $this->route('brand')?->id;

        return [
            ...$this->localizedStringRules('name', true, 255),
            ...$this->localizedStringRules('slug', false, 255),
            ...$this->localizedStringRules('description'),
            'country' => ['nullable', 'string', 'max:255'],
            'website_url' => ['nullable', 'string', 'max:1000'],
            'showcase_image' => ['nullable', 'string', 'max:1000'],
            'showcase_image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'image_url' => ['nullable', 'string', 'max:1000'],
            'image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->normalizeLocalizedInput(['name', 'slug', 'description']);
    }
}
