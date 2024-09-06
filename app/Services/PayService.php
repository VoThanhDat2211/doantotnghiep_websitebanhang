<?php
namespace App\Services;

use App\Repositories\OrderLineRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PayRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayService 
{
    const STATUS_PENDDING = 1;
    protected $payRepsitory;
    protected $orderRepository;
    protected $orderLineRepository;
    public function __construct(PayRepository $payRepository,
    OrderLineRepository $orderLineRepository,
    OrderRepository $orderRepository,
    )
    {
        $this->payRepsitory = $payRepository;
        $this->orderRepository = $orderRepository;
        $this->orderLineRepository = $orderLineRepository;
    }

    public function create(array $data)
    {
        return $this->payRepsitory->create($data);
    }

    public function payByCart($dataPay, $voucher)
    {
        try {
            DB::transaction(function () use ($dataPay, $voucher) {
                $this->processOrderByCart($dataPay, $voucher);
            });
            $result = [
                $message = "Đặt hàng thành công",
                $status = 'success',
            ];
            return redirect()->route('home_page_user')->with('result', $result);
        } catch (\Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            return redirect()->route('user-cart')->with('result', $result);
        }
    }

    private function processOrderByCart($dataPay,$voucher)
    {
        $carts = session()->get('carts');
        if($carts->isEmpty() || empty($carts))
        {
            throw new \Exception('Giỏ hàng trống');
        }
        $order = $this->createOrder($voucher);
        foreach($carts as $cart)
        {
            $this->createOrderLineByCart($cart, $order);
        }
        $this->createPay($dataPay, $order->id);

    }

    private function createOrder($voucher){
        $dataOrder['customer_id'] = Auth::user()->id;
        $dataOrder['order_code'] = $this->getOrderCode();
        $dataOrder['total_amount'] = is_null($voucher) ? 0 : 1;
        $dataOrder['status'] = self::STATUS_PENDDING;

        return $this->orderRepository->create($dataOrder);
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

    private function createOrderLineByCart($cart, $order)
    {
        $originPrice = priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount);
        $originPrice = 0;
        if ($originPrice !== $cart->price) {
            throw new \Exception("Giá sản phẩm đã thay đổi, vui lòng đặt hàng lại");
        }

        if ($cart->quantity > $cart->productVariant->remain_quantity) {
            throw new \Exception("Đặt hàng thất bại, không đủ số lượng sản phẩm");
        }

        $dataOrderLine['order_id'] = $order->id;
        $dataOrderLine['product_variant_id'] = $cart->productVariant->id;
        $dataOrderLine['quantity'] = $cart->quantity;
        $dataOrderLine['price'] = $cart->price;

        $orderLineInsert = $this->orderLineRepository->create($dataOrderLine);
        
    }

    private function createPay($dataPay,$orderId)
    {
        $dataPay['order_id'] = $orderId;
        return $this->create($dataPay);
    }
}