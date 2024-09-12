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

    public function create(array $data)
    {
        return $this->order->create($data);
    }

    public function update($order,$status)
    {
        return $order->update(['status' => $status]);
    }

    public function getById($id)
    {
        return $this->order->find($id);
    }

    public function getByIdWithOrderLine($id)
    {
        return $this->order->with('orderLines')->find($id);
    }
    public function getAllPaginate()
    {
        return $this->order->with('orderLines')
            ->orderBy("created_at", "desc")
            ->paginate(30);
    }

    public function getByCustomer($customerId) 
    {
        return $this->order->with('orderLines')->where('customer_id',$customerId)->orderBy('created_at','desc')->paginate(5);
    }

    public function countOrderByCustomer($customerId, $statusSucces) 
    {
        return $this->order->where(['customer_id' => $customerId, 'status' => $statusSucces])->count();
    }
}