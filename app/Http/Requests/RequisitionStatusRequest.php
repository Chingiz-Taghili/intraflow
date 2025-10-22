<?php

namespace App\Http\Requests;

use App\Enums\RequisitionStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RequisitionStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(RequisitionStatus::class)],
        ];
    }
}
