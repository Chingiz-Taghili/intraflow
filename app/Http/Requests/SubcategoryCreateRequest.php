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
            'name' => ['required', 'string', 'max:255',
                Rule::unique('subcategories', 'name')
                    ->where(fn($query) => $query->where('category_id', $this->category_id)),],
            'description' => ['nullable', 'string'],
        ];
    }
}
