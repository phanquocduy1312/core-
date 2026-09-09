<?php

namespace App\Http\Requests\Admin;

use App\Models\ContactInquiry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactInquiryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(array_keys(ContactInquiry::STATUSES))],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
