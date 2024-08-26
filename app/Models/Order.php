<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_code",
        "customer_id",
        "status",
        "total_amount"
    ];

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function pays()
    {
        return $this->hasMany(Pay::class)->whereNull('deleted_at');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}