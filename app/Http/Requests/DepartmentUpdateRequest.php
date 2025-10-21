<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'min:2', 'max:100',
                Rule::unique('departments')->ignore($this->route('department')->id),],
            'leader_id' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
