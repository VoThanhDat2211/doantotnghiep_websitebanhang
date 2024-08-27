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

    public function getAllPaginate()
    {
        return $this->order->with(['orderLines', 'pays'])
            ->whereNull('deleted_at')
            ->orderBy("created_at", "desc")
            ->paginate(30);
    }

}