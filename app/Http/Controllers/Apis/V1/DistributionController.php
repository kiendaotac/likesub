<?php

namespace App\Http\Controllers\Apis\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\V1\Distribution\DistributionRequest;
use App\Http\Requests\Apis\V1\Distribution\UpdateDistributionRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\OrderResource;
use App\Models\Distribution;
use App\Models\Order;
use Illuminate\Http\Response;

class DistributionController extends Controller
{
    public function index(DistributionRequest $request)
    {
        $data    = $request->validated();
        $viaId   = $data['via_id'];
        $service = $data['service'];
        $orders  = Order::where('service', $service)
            ->where('status', 'pending')
            ->with('distributions')
            ->withSum('distributions', 'target')
            ->orderBy('distributions_sum_target')
            ->get();

        if (!$orders) {
            return new MessageResource(['errorCode' => Response::HTTP_NOT_FOUND, 'message' => 'order not found']);
        }

        foreach ($orders as $order) {
            if ($order->distribustions?->where('via_id', $viaId)->count()) {
                continue;
            }
            if ($order->distributions_sum_target >= $order->target) {
                continue;
            }

            return $this->getDistribution($order, $viaId);
        }

        return new MessageResource(['errorCode' => Response::HTTP_NOT_FOUND, 'message' => 'all order is complete']);
    }

    private function getRealTarget($target)
    {
        switch ($target) {
            case $target > 2000: return $target + 100;
            case $target > 500: return $target + 60;
            default: return $target + 20;
        }
    }

    public function update(UpdateDistributionRequest $request, Distribution $distribution)
    {
        if ($distribution->update($request->validated())) {
            return new MessageResource(['errorCode' => 0, 'message' => 'Cập nhật thành công']);
        }
        return new MessageResource(['errorCode' => 3, 'message' => 'Update lỗi']);
    }

    private function getDistribution($order, $viaId)
    {
        $targetOfOrder = $order->distributions->where('status', '<>', 'error')->sum('target');
        if ($targetOfOrder >= $order->target) {
            return new MessageResource(['errorCode' => 2, 'message' => 'Đơn hàng đã đủ target']);
        }
        $checkVia = $order->distributions->where('via_id', $viaId)->count();
        if ($checkVia) {
            return new MessageResource(['errorCode' => 1, 'message' => 'Via đã chạy cho đơn hàng này']);
        }
        $targetDone = $order->distributions->where('status', 'success')->sum('target');
        $target     = $order->target;
        $realTarget = $this->getRealTarget($target);
        $distribute = Distribution::create([
            'order_id'        => $order->order_id,
            'via_id'          => $viaId,
            'service'         => $order->service,
            'target_identify' => $order->target_identify,
            'extra_data'      => json_encode($order->extra_data),
            'target'          => intval($realTarget / 20),
            'original'        => $order->original,
            'target_done'     => $targetDone,
            'status'          => 'pending',
        ]);

        $group = Distribution::where('service', $order->service)->where('target_identify', $order->target_identify)->where('via_id', $viaId)->count();
        $distribute->group =  $group;

        return new OrderResource($distribute);
    }
}
