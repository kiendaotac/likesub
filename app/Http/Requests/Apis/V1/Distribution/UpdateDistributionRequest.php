<?php

namespace App\Http\Requests\Apis\V1\Distribution;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDistributionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status'      => ['required', 'string', 'in:success,error'],
            'target_done' => ['required', 'integer', 'min:0'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
