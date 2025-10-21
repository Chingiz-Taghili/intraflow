<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionImageUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'path' => ['sometimes', 'string', 'max:255', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
            'sort_order' => ['sometimes', 'nullable', 'integer', 'min:0'],
        ];
    }
}
