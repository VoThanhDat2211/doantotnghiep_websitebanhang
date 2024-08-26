<?php 
namespace App\Services;

use App\Models\Voucher;
use App\Repositories\CustomerVoucherRepository;
use Illuminate\View\View;

class CustomerVoucherService
{
    protected $customerVoucherRepository;
    public function __construct(CustomerVoucherRepository $customerVoucherRepository)
    {
        $this->customerVoucherRepository = $customerVoucherRepository;
    }

    public function create($data)
    {
        return $this->customerVoucherRepository->create($data);
    }

    public function getAll()
    {
        return $this->customerVoucherRepository->getAll();
    }
}