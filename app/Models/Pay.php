<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'shipping_customer',
        'customer_phone',
        'payments',
    ];
}