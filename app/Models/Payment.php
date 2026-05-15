<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'payment_code',
        'payment_method',
        'payment_channel',
        'amount',
        'status',
        'paid_at',
        'transaction_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
}