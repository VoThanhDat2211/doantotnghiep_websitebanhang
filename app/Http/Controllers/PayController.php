<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePayRequest;
use App\Services\PayService;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class PayController extends Controller
{
    const TYPE_BUY_BY_CART = '1';
    const TYPE_BUY_PRODUCT_DETAIL = '2';
    const TYPE_PAYMENT_ONLINE = '2';
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
        
        if($data['payments'] == self::TYPE_PAYMENT_ONLINE)
        {
            $totalPayment = $request->input('total_payment');
            session()->put('total_payment_online',$totalPayment);
            return view('user.vnpay.index',['totalPayment' => $totalPayment]);
        } 
        
        else {
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

    public function paymentOnline() 
    {
        return view('user.vnpay.index');
    }

    public function createPaymentOnline(Request $request)
    {
    
        // dd($request->toArray());
    //     $vnp_TxnRef = $this->generateRandomString(15);
    //     $vnp_Amount = session()->get('total_payment_online')  * 100;    
    //     $vnp_Locale = $_POST['language'];
    //     $vnp_BankCode = $_POST['bank_code'];
    //     $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //     $vnp_TmnCode = 'OQMIU1FR';
    //     $vnp_Returnurl = 'http://127.0.0.1:8000/home';
    //     $expire = date('YmdHis',strtotime('+15 minutes',strtotime(date("YmdHis"))));
    //     $inputData = array(
    //         "vnp_Version" => "2.1.0",
    //         "vnp_Command" => "pay",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount* 100,
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
    //         "vnp_OrderType" => "other",
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $vnp_TxnRef,
    //         "vnp_ExpireDate"=>$expire
    //     );

    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }


    //     $vnp_Url = env('VNP_URL') . "?" . $query;
    //     $vnp_HashSecret = env('VNP_HASH_SECRET');
    //     if (isset($vnp_HashSecret)) {
    //         $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    //         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    //     }
    // return redirect($vnp_Url);

       
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
    $vnp_TmnCode = "OQMIU1FR";//Mã website tại VNPAY 
    $vnp_HashSecret = "PGBR76GIWL23P0OG5IZ6RSA2MA6UH368"; //Chuỗi bí mật
    
    $vnp_TxnRef = $this->generateRandomString(15); 
    $vnp_OrderInfo = $_POST['order_desc'];
    $vnp_OrderType = $_POST['order_type'];
    $vnp_Amount = session()->get('total_payment_online') * 100;
    $vnp_Locale = $_POST['language'];
    $vnp_BankCode = $_POST['bank_code'];
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_ExpireDate = date('YmdHis',strtotime('+15 minutes',strtotime(date("YmdHis"))));
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate"=>$vnp_ExpireDate,
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return redirect($vnp_Url);
    // $returnData = array('code' => '00'
    //     , 'message' => 'success'
    //     , 'data' => $vnp_Url);
    //     if (isset($_POST['redirect'])) {
    //         header('Location: ' . $vnp_Url);
    //         die();
    //     } else {
    //         echo json_encode($returnData);
    //     }
    }

    private function generateRandomString($length = 15) {
        // Tập hợp các ký tự có thể có trong chuỗi ngẫu nhiên
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        // Tạo chuỗi ngẫu nhiên dựa trên $length (15 ký tự)
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}