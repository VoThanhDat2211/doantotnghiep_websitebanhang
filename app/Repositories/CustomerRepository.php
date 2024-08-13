<?php
namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAll()
    {
        return $this->customer->whereNull('deleted_at')->get();
    }
}