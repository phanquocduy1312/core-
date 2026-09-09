<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ContactInquirySubmitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        // Support both clean field names and original Gravity Form input names (input_3, input_4, etc.)
        $this->merge([
            'name' => $this->input('name') ?: $this->input('input_3'),
            'title' => $this->input('title') ?: $this->input('input_4'),
            'company' => $this->input('company') ?: $this->input('input_5'),
            'email' => $this->input('email') ?: $this->input('input_25'),
            'phone' => $this->input('phone') ?: $this->input('input_27'),
            'enquiry_type' => $this->input('enquiry_type') ?: $this->input('input_18') ?: 'Sales Enquiry',
            'message' => $this->input('message') ?: $this->input('input_22'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'title' => ['nullable', 'string', 'max:150'],
            'company' => ['nullable', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'enquiry_type' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên của bạn.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ.',
            'message.required' => 'Vui lòng nhập nội dung tin nhắn hoặc yêu cầu của bạn.',
        ];
    }
}
