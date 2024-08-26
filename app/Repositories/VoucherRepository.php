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

    public function delete($voucher)
    {
        return $voucher->delete();
    }

    public function getAll()
    {
        return $this->voucher->get();
    }

    public function getById($id)
    {
        return $this->voucher->find($id);
    }
}