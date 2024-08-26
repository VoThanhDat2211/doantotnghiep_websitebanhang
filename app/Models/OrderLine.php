<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity' ,
        'price' ,
        'product_id',
        'product_variant_id',
        'order_id',
    ];
}