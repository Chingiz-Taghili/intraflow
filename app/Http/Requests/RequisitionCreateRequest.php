<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'integer', 'exists:subcategories,id'],
            'item_name' => ['required', 'string', 'min:2', 'max:100'],
            'notes' => ['nullable', 'string', 'min:2'],
            'parent_request_id' => ['nullable', 'integer', 'exists:requisitions,id'],
        ];
    }
}
