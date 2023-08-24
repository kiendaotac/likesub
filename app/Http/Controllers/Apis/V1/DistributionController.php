<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\V1\Distribution\DistributionRequest;
use App\Http\Requests\Apis\V1\Distribution\StoreDistributionRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\OrderResource;
use App\Models\Distribution;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DistributionController extends Controller
{
    public function index(DistributionRequest $request)
    {
        $data = $request->validated();
        $data['order_id'] = 'f5o2hb8ubj6';
        $order = Order::where('order_id', $data['order_id'])->first();

        if (!$order) {
            return new MessageResource(['errorCode' => Response::HTTP_NOT_FOUND, 'message' => 'order not found']);
        }

        $checkVia = Distribution::where(['via_id' => $data['via_id'], 'order_id' => $order->order_id, 'service' => $order->service])->count();

        if ($checkVia) {
            return new MessageResource(['errorCode' => 1, 'message' => 'Via đã chạy cho đơn hàng này']);
        }

        $targetDone = Distribution::where(['order_id' => $data['order_id'], 'service' => $order->service, 'status' => 'success'])->sum('target');

        $target = $order->target;
        $realTarget = $this->getRealTarget($target);

        $distribute = Distribution::create([
            'order_id' => $order->order_id,
            'via_id' => $data['via_id'],
            'service' => $order->service,
            'target_identify' => $order->target_identify,
            'extra_data' => json_encode($order->extra_data),
            'target' => intval($realTarget / 20),
            'original' => $order->original,
            'target_done' => $targetDone,
            'status' => 'pending',
        ]);

        return new OrderResource($distribute);
    }

    public function store(StoreDistributionRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'success';
    }

    private function getRealTarget($target)
    {
        switch ($target) {
            case $target > 2000: return $target + 100;
            case $target > 500: return $target + 60;
            default: return $target + 20;
        }
    }
}
