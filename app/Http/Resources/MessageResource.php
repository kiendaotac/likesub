<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public $resource = [];
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }

    public function with(Request $request)
    {
        return $this->resource;
    }

    public function toArray(Request $request): array
    {
        return [

        ];
    }
}
