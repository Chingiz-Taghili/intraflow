<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:50',
                Rule::unique('roles', 'name')->ignore($this->route('role')->id),],
            'description' => ['nullable', 'string', 'min:2'],
        ];
    }
}
