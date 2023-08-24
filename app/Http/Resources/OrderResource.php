<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with(Request $request)
    {
        $errorCode = $this->resource instanceof Order;
        return [
            'errorCode' => intval(!$errorCode),
            'status' => $errorCode ? 'success' : 'error',
        ];
    }

}
