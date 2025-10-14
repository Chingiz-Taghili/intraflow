<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubcategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:100',
                Rule::unique('subcategories')->where(fn($query) => $query
                    ->where('category_id', $this->route('category')->id))
                    ->ignore($this->route('subcategory')->id),],
            'description' => ['nullable', 'string', 'min:2'],
        ];
    }
}
