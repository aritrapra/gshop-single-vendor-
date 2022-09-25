<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'veriant',
        'total_price',
        'btc_price',
        'xmr_price',
        'payment_type',
        'placed',
        'status',
        'address',
        'sendto',
        'confirmation',
        'mykey',
        'message',
        'shipmessage',
        'user',
        'review',
    ];
}
