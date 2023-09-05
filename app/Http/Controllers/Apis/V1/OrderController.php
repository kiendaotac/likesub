<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\V1\Order\StoreOrderRequest;
use App\Http\Requests\Apis\V1\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResourceCollection;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderController extends Controller
{
    public function index()
    {
        $perPage = request('perPage') ?? 10;
        $page    = request('page') ?? 1;

        $filter = request('filter') ?? [];

        return new OrderResourceCollection(Order::query()->where($filter)->paginate($perPage, ['*'], 'page', $page));
    }

    public function store(StoreOrderRequest $request)
    {
        $orderId = $request->order_id;
        $orderCount = Order::where('order_id', $orderId)->count();
        if ($orderCount) {
            return (new OrderResource([]))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_CONFLICT);
        }
        return new OrderResource(Order::create($request->validated()));
    }

    public function show(Order $order)
    {
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
    }

    public function destroy(Order $order)
    {
    }
}
