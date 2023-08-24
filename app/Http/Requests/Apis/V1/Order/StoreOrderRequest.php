<?php

namespace App\Http\Requests\Apis\V1\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_id'        => ['required', 'string'],
            'service'         => ['required', 'string', 'in:FACEBOOK_LIKE_PAGE,FACEBOOK_FLOW_PAGE,FACEBOOK_LIKE_POST'],
            'target_identify' => ['required', 'string'],
            'target'          => ['required', 'integer', 'min:1'],
            'original'        => ['required', 'integer', 'min:0'],
            'extra_data'      => ['nullable', 'array']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
