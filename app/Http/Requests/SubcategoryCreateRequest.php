<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubcategoryCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'min:2', 'max:100',
                Rule::unique('subcategories')
                    ->where(fn($query) => $query->where('category_id', $this->category_id)),],
            'description' => ['nullable', 'string', 'min:2'],
        ];
    }
}
