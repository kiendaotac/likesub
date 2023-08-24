<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\V1\Distribution\DistributionRequest;
use App\Http\Requests\Apis\V1\Distribution\StoreDistributionRequest;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    public function index(DistributionRequest $request)
    {
        return response()->json($request->validated());
    }

    public function store(StoreDistributionRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'success';
    }
}
