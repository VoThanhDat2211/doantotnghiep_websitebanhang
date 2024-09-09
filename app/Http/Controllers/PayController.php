<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePayRequest;
use App\Services\PayService;
use App\Services\VoucherService;

class PayController extends Controller
{
    const TYPE_BUY_BY_CART = '1';
    const TYPE_BUY_PRODUCT_DETAIL = '2';
    protected $payService;
    protected $voucherService;
    public function __construct(PayService $payService, VoucherService $voucherService) 
    {
       $this->payService = $payService;
       $this->voucherService = $voucherService;
    }
    public function create(CreatePayRequest $request)
    {
        $type =  $request->input('type');
        $data['customer_name'] = $request->input('customer_name');
        $data['customer_phone'] = $request->input('customer_phone');
        $data['payments'] = $request->input('payments');
        $data['shipping_customer'] = $request->input('address_detail') . " - ". $request->input('ward') . " - " . $request->input('district') . " - " . $request->input('province');
        $voucherInput = $request->input('voucher');
        if(is_null($voucherInput))
        {
            $voucher = null;
        }
        else {
            $voucher = $this->voucherService->getByVoucherCodeCondition($voucherInput);
            
            if(is_null($voucher)) {
                $result = [
                    $message = "Voucher không hợp lệ, vui lòng thanh toán lại !",
                    $status = 'error',
                ];

                return redirect()->back()->with('result', $result);
            }
        }
        
        if($type == self::TYPE_BUY_BY_CART)
        {
            return $this->payService->payByCart($data, $voucher);
        }

        if($type == self::TYPE_BUY_PRODUCT_DETAIL)
        {
            return $this->payService->payByProductDetail($data, $voucher);
        }
        
    }

    
}