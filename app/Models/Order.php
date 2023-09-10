<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'extra_data' => 'json'
    ];

    protected $fillable = ['order_id', 'service_id', 'service', 'target_identify', 'target', 'original', 'extra_data', 'response_data', 'priority', 'status'];

    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class, 'order_id', 'order_id');
    }
}
