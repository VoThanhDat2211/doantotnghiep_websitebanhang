<?php
namespace App\Services;

use App\Repositories\PayRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayService 
{
    const STATUS_PENDDING = 1;
    protected $payRepsitory;
    protected $orderService;
    public function __construct(PayRepository $payRepository,
    OrderService $orderService
    )
    {
        $this->payRepsitory = $payRepository;
        $this->orderService = $orderService;
    }

    public function create(array $data)
    {
        return $this->payRepsitory->create($data);
    }

    public function payByCart($data)
    {
        DB::transaction(function () use ($data) {
            $this->processOrderByCart($data);
        });
    }

    private function processOrderByCart($data)
    {
        $carts = session()->get('carts');
        if($carts->isEmpty())
        {
            return null;
        }
        $buyQuantities = [];
        $oldPrices = [];
        foreach($carts as $cart)
        {
            $buyQuantities[$cart->productVariant->id] = $cart->quantity;
            $oldPrices[$cart->productVariant->id] = $cart->price;
        }
        $this->createOrder($data['voucher']);
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

    private function createOrderLine($oldPrice, $quantity,$productVariant)
    {
        $originPrice = priceDiscount($productVariant->product->price, $productVariant->product->discount);
    }
}