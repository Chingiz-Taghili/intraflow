<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'subcategory_id' => ['sometimes', 'nullable', 'integer', 'exists:subcategories,id'],
            'item_name' => ['sometimes', 'string', 'min:2', 'max:100'],
            'notes' => ['sometimes', 'nullable', 'string', 'min:2'],
            'parent_request_id' => ['sometimes', 'nullable', 'integer', 'exists:requisitions,id'],
        ];
    }
}
