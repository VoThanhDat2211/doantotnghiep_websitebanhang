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

    public function create(array $data)
    {
        return $this->customer->create($data);
    }

    public function getByUserName($username)
    {
        return $this->customer->where('username',$username)->whereNull('deleted_at')->first();
    }

    public function getByEmail($email)
    {
        return $this->customer->where('email',$email)->whereNull('deleted_at')->first();
    }

}