<?php
namespace App\Services;

class OrderLineService
{
    protected $orderLineRepository;
    public function __construct(OrderLineService $orderLineRepository)
    {
        $this->orderLineRepository = $orderLineRepository;
    }

    public function create(array $data)
    {
        $this->orderLineRepository->create($data);
    }
}
