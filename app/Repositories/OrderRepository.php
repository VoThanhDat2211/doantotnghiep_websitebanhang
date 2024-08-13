<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository 
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

}