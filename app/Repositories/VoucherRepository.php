<?php
namespace App\Repositories;

use App\Models\Voucher;

class VoucherRepository 
{
    protected $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function create($data)
    {
        return $this->voucher->create($data);
    }

    public function getAll()
    {
        return $this->voucher->get();
    }
}