<?php

namespace App\Http\Requests\Apis\V1\Distribution;

use Illuminate\Foundation\Http\FormRequest;

class DistributionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'via_id'          => ['required', 'string'],
            'order_id'        => ['required', 'string'],
            'target_identify' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
