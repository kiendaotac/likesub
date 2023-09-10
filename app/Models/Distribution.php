<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'via_id',
        'service',
        'target_identify',
        'extra_data',
        'target',
        'original',
        'target_done',
        'group',
        'status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    protected static function booted()
    {
        static::updated(function (Distribution $distribution) {
            $order = Order::where('order_id', $distribution->order_id)->with('distributions')->first();
            if ($order->distributions->sum('target_done') >= $order->target) {
                $order->update(['status' => 'success']);
            }
        });
    }
}
