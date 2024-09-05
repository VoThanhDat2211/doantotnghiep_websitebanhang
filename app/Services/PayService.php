<?php
namespace App\Services;

use App\Models\OrderLine;
use App\Repositories\PayRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayService 
{
    const STATUS_PENDDING = 1;
    protected $payRepsitory;
    protected $orderService;
    protected $orderLineService;
    public function __construct(PayRepository $payRepository,
    OrderService $orderService,
    OrderLineService $orderLineService,
    )
    {
        $this->payRepsitory = $payRepository;
        $this->orderService = $orderService;
        $this->orderLineService = $orderLineService;
    }

    public function create(array $data)
    {
        return $this->payRepsitory->create($data);
    }

    public function payByCart($dataPay, $voucher)
    {
        DB::transaction(function () use ($dataPay, $voucher) {
            $this->processOrderByCart($dataPay, $voucher);
        });
    }

    private function processOrderByCart($dataPay,$voucher)
    {
        $carts = session()->get('carts');
        if($carts->isEmpty())
        {
            return null;
        }
        $order = $this->createOrder($voucher);
        foreach($carts as $cart)
        {
            $this->createOrderLineByCart($cart, $order->id);
        }
        $this->createPay($dataPay, $order->id);

    }

    private function createOrder($voucher){
        $dataOrder['customer_id'] = Auth::user()->id;
        $dataOrder['order_code'] = $this->getOrderCode();
        $dataOrder['total_amount'] = is_null($voucher) ? 0 : 1;
        $dataOrder['status'] = self::STATUS_PENDDING;

        return $this->orderService->create($dataOrder);
    }

    private function getOrderCode(): string
    {
        $characterTexts = range('A', 'Z');
        $characterNumbers = range(0, 9);
        $orderCodeGenerationText = '';
        $orderCodeGenerationNumber = '';
        for ($i = 0; $i < 2; $i++) {
            $randomKey = array_rand($characterTexts);
            $orderCodeGenerationText .= $characterTexts[$randomKey];
        }

        $orderCodeGeneration = '';
        for ($i = 0; $i < 4; $i++) {
            $randomKey = array_rand($characterNumbers);
            $orderCodeGenerationNumber .= $characterNumbers[$randomKey];
        }

        $orderCodeGeneration = $orderCodeGenerationText . $orderCodeGenerationNumber;
        return $orderCodeGeneration;
    }

    private function createOrderLineByCart($cart, $orderId)
    {
        $originPrice = priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount);

        if($cart->productVariant->product->price !== $cart->price)
        {
            $result = [
                $message = "Giá sản phẩm đã thay đổi, vui lòng đặt hàng lại",
                $status = 'error',
            ];

            return redirect()->route('user-cart')->with('result',$result);
        }

        if ($cart->quanity > $cart->productVariant->remain_quantity) {
            $result = [
                $message = "Đặt hàng thất bại, không đủ số lượng sản phẩm",
                $status = 'error',
            ];

            return redirect()->route('user-cart')->with('result', $result);
        }

        $dataOrderLine['order_id'] = $orderId;
        $dataOrderLine['product_variant_id'] = $cart->productVariant->id;
        $dataOrderLine['quantity'] = $cart->quantity;
        $dataOrderLine['price'] = $cart->price;
        return $this->orderLineService->create($dataOrderLine);
    }

    private function createPay($dataPay,$orderId)
    {
        $dataPay['order_id'] = $orderId;
        return $this->create($dataPay);
    }
}