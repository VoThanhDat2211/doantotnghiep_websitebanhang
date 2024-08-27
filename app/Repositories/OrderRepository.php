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

    public function update($order,$status)
    {
        return $order->update(['status' => $status]);
    }

    public function getById($id)
    {
        return $this->order->whereNull('deleted_at')->find($id);
    }

    public function getByIdWithOrderLine($id)
    {
        return $this->order->with('orderLines')->whereNull('deleted_at')->find($id);
    }
    public function getAllPaginate()
    {
        return $this->order->with('orderLines')
            ->whereNull('deleted_at')
            ->orderBy("created_at", "desc")
            ->paginate(30);
    }


}