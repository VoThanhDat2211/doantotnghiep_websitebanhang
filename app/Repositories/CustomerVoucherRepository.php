<?php
namespace App\Repositories;

use App\Models\CustomerVoucher;

class CustomerVoucherRepository 
{
    protected $customerVoucher;
    public function __construct(CustomerVoucher $customerVoucher)
    {
        $this->customerVoucher = $customerVoucher;
    }

    public function create($data)
    {
        return $this->customerVoucher->create($data);
    }

    public function getAll()
    {
        return $this->customerVoucher->get();
    }
}