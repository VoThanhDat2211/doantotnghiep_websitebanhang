<?php
namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService 
{
    protected $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll()
    {
        return $this->customerRepository->getAll();
    }
}