<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePayRequest;
use App\Services\PayService;
use Database\Seeders\PaySeeder;
use Illuminate\Http\Request;

class PayController extends Controller
{
    protected $payService;
    public function __construct(PayService $payService) 
    {
        $this->payService = $payService;
    }
    public function create(CreatePayRequest $request)
    {
        $data['customer_name'] = $request->input('customer_name');
        $data['customer_phone'] = $request->input('customer_phone');
        $data['payments'] = $request->input('payments');
        $data['shipping_customer'] = $request->input('address_detail') . " - ". $request->input('ward') . " - " . $request->input('district') . " - " . $request->input('province');
    
        $this->payService->payByCart($data);
    }
}
