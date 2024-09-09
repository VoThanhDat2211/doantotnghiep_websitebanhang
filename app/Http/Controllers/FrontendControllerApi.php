<?php

namespace App\Http\Controllers;

use App\Services\VoucherService;
use Illuminate\Http\Request;

class FrontendControllerApi extends Controller
{
    protected $voucherService;
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
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
}
