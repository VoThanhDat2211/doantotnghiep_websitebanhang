<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'parent_category',
    ];

    public function products() {
        return $this->hasMany(Product::class)->whereNull('deleted_at');
    }



}
