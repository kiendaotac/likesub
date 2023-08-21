<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'extra_data' => 'json'
    ];

    protected $fillable = ['order_id', 'service_id', 'service', 'target_identify', 'target', 'original', 'extra_data', 'response_data', 'status'];
//    protected $fillable = ['transactions_id', 'service_type', 'social_type', 'social_id', 'original_number', 'target_number'];

}
