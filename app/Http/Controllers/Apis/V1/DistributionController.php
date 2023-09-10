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
            ->orderBy('group', 'ASC')
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
            case $target > 2000: return 100;
            case $target > 500: return 60;
            default: return 20;
        }
    }

    public function update(UpdateDistributionRequest $request, Distribution $distribution)
    {
        $validated = $request->validated();
        if ($validated['target_done'] > $distribution->target_done) {
            $validated['target_done'] = $distribution->target_done;
        }
        if ($distribution->update($request->validated())) {
            return new MessageResource(['errorCode' => 0, 'message' => 'Cập nhật thành công']);
        }
        return new MessageResource(['errorCode' => 3, 'message' => 'Update lỗi']);
    }

    private function getDistribution($order, $viaId)
    {
        $targetOfOrder   = $order->distributions->where('status', '<>', 'error')->sum('target');
        $targetErrorDone = $order->distributions->where('status', 'error')->sum('target_done');
        if ($targetOfOrder + $targetErrorDone >= $order->target) {
            return new MessageResource(['errorCode' => 2, 'message' => 'Đơn hàng đã đủ target']);
        }
        $checkVia = $order->distributions->where('via_id', $viaId)->count();
        if ($checkVia) {
            return new MessageResource(['errorCode' => 1, 'message' => 'Via đã chạy cho đơn hàng này']);
        }
        $target      = $order->target;
        $extraTarget = $this->getRealTarget($target);
        $targetTodo  = min(($target + $extraTarget) - ($targetOfOrder + $targetErrorDone), intval(($target + $extraTarget) / 20));
        $distribute = Distribution::create([
            'order_id'        => $order->order_id,
            'via_id'          => $viaId,
            'service'         => $order->service,
            'target_identify' => $order->target_identify,
            'extra_data'      => json_encode($order->extra_data),
            'target'          => $targetTodo,
            'original'        => $order->original,
            'target_done'     => 0,
            'group'           => $order->group,
            'status'          => 'pending',
        ]);

        $order->increment('group');

        return new OrderResource($distribute);
    }
}
