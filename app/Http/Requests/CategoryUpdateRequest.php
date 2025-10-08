<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories,name,'
                . $this->route('category')->id . '|max:255',
            'description' => 'nullable|string',
        ];
    }
}
