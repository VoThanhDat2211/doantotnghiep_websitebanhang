<?php
namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService 
{
    const ORDER_STATUS_PEDDING = 1;
    const ORDER_STATUS_PAID = 2;
    const ORDER_STATUS_SHIPPING = 3;
    protected $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function update($order, $status)
    {
        if($order->status == self::ORDER_STATUS_PEDDING)
        {
            $status = self::ORDER_STATUS_PAID;
        }

        if($order->status == self::ORDER_STATUS_PAID )
        {
            $status = self::ORDER_STATUS_SHIPPING;
        }

        return $this->orderRepository->update($order, $status);
    }

    public function getById($id)
    {
        return $this->orderRepository->getById($id);
    }

    public function getByIdWithOrderLine($id)
    {
        return $this->orderRepository->getByIdWithOrderLine($id);
    }
    
    public function getAllPaginate()
    {
        return $this->orderRepository->getAllPaginate();
    }
}