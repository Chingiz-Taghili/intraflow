<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionImageCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'requisition_id' => ['required', 'integer', 'exists:requisitions,id'],
            'path' => ['required', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
