<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class FrontendControllerApi extends Controller
{
    protected $voucherService;
    protected $orderService;
    public function __construct(VoucherService $voucherService,
    OrderService $orderService,
    )
    {
        $this->voucherService = $voucherService;
        $this->orderService = $orderService;
    }
    public function getByVoucherCodeCondition(Request $request) {
        $voucherCode = $request->input('voucher');
        $voucher = $this->voucherService->getByVoucherCodeCondition($voucherCode);
        if(is_null($voucher)) {
            return response()->json([
                'status_code' => 404,
            ]);
        }

        return response()->json([
            'status_code' => 200,
            'voucher' => $voucher,
        ]);
    }

    public function getStatisticByYear(Request $request)
    {
        $year = (int) $request->year;
        $status = 4;
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        foreach ($months as $month) {
            $totalRevenueByMonthsOfYear[] = $this->orderService->totalRevenueByMonth($year, $month, $status);
            $countOrderByMonthsOfYear[] = $this->orderService->countOrderByMonth($year, $month, $status);
        }
        return response()->json(['status' => 'success', 'countOrderByMonthsOfYear' => $countOrderByMonthsOfYear, 'totalRevenueByMonthsOfYear' => $totalRevenueByMonthsOfYear]);
    }
}
