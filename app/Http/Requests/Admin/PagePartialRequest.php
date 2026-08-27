<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class PagePartialRequest extends PageRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'partial_role' => ['required', 'string', Rule::in(['header', 'footer', 'generic'])],
        ]);
    }
}
