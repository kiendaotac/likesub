<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistributionCollection;
use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionListController extends Controller
{
    public function index()
    {
        $perPage = request('perPage') ?? 10;
        $page    = request('page') ?? 1;

        return new DistributionCollection(Distribution::query()->paginate($perPage, ['*'], 'page', $page));
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
