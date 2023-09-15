<?php

namespace App\Http\Requests\Apis\V1\Order;

use Illuminate\Foundation\Http\FormRequest;

class CancelOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_id' => ['required', 'string']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
