<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "quantity",
        "value",
        "voucher_type",
        "remain_quantity",
        "voucher_code",
        "start_date",
        "end_date"
    ];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "start_date" => "datetime",
        "end_date" => "datetime",
    ];
}
