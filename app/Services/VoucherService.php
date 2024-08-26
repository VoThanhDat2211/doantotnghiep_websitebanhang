<?php 
namespace App\Services;

use App\Models\Voucher;
use App\Repositories\VoucherRepository;
use Illuminate\View\View;

class VoucherService
{
    protected $voucherRepository;
    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    public function create($data)
    {
        return $this->voucherRepository->create($data);
    }

    public function getAll()
    {
        return $this->voucherRepository->getAll();
    }
}