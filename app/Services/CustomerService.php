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

    public function create(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function getAll()
    {
        return $this->customerRepository->getAll();
    }

    public function getByUserName($username)
    {
        return $this->customerRepository->getByUserName($username);
    }

    public function getByEmail($email)
    {
        return $this->customerRepository->getByEmail($email);
    }

    public function getTopCustomersByOrderCount($limit)
    {
        return $this->customerRepository->getTopCustomersByOrderCount($limit);
    }

    public function countCustomer()
    {
        return $this->customerRepository->countCustomer();
    }
}