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
        return $this->voucher->paginate(30);
    }

    public function getById($id)
    {
        return $this->voucher->find($id);
    }

    public function getByVoucherCode($voucherCode)
    {
        return $this->voucher->where('voucher_code')->first();
    }

    public function getByVoucherType($type2, $type4, $today)
    {
        return $this->voucher
        ->where(function($query) use ($type2, $type4) {
            $query->where('voucher_type', $type2)
                  ->orWhere('voucher_type', $type4);
        })
        ->whereDate('end_date', '>=', $today) 
        ->where('quantity', '>', 0)
        ->orderBy('start_date', 'asc')
        ->get();
    }
}