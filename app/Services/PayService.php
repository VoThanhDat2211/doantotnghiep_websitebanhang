<?php
namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\OrderLineRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PayRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PayService 
{
    const STATUS_PENDDING = 1;
    protected $payRepsitory;
    protected $orderRepository;
    protected $orderLineRepository;
    protected $cartRepository;
    protected $productVariantRepository;
    public function __construct(PayRepository $payRepository,
    OrderLineRepository $orderLineRepository,
    OrderRepository $orderRepository,
    CartRepository $cartRepository,
    ProductVariantRepository $productVariantRepository,
    )
    {
        $this->payRepsitory = $payRepository;
        $this->orderRepository = $orderRepository;
        $this->orderLineRepository = $orderLineRepository;
        $this->cartRepository = $cartRepository;
        $this->productVariantRepository = $productVariantRepository;
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
            session()->forget('carts');
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

    public function payByProductDetail($dataPay, $voucher)
    {
        try {
            DB::transaction(function () use ($dataPay, $voucher) {
                $this->processOrderByProductDetail($dataPay, $voucher);
            });
            $result = [
                $message = "Đặt hàng thành công",
                $status = 'success',
            ];
            session()->forget('productVariantId');
            session()->forget('buyQuantity');
            return redirect()->route('home_page_user')->with('result', $result);
        } catch (\Exception $e) {
            DB::rollBack();
            $result = [
                $message = $e->getMessage(),
                $status = 'error',
            ];
            $productVariantId = session()->get('productVariantId');
            $productVariant = $this->productVariantRepository->getById($productVariantId);
            $productId = $productVariant->product->id;
            return redirect()->route('product-detail', ['id' => $productId])->with('result', $result);
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
        $totalAmount = 0;
        foreach($carts as $cart)
        {
            $priceOrderLine = $this->createOrderLineByCart($cart, $order);
            $totalAmount += $priceOrderLine;
            $this->cartRepository->delete($cart->id);
        }
        $this->updateTotalAmountOrder($order, $totalAmount,$voucher);
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

        $orderCodeGeneration = $orderCodeGenerationText .  date('dmy') . $orderCodeGenerationNumber ;
        return $orderCodeGeneration;
    }

    private function createOrderLineByCart($cart, $order)
    {
        $priceOrderLine = 0;
        $originPrice = priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount);
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
        $priceOrderLine = $originPrice;
        $this->updateQuantityProduct($cart->productVariant->product,$dataOrderLine['quantity']);
        $this->updateQuantityProductVariant($cart->productVariant, $dataOrderLine['quantity']);

        return $priceOrderLine;
    }

    private function createPay($dataPay,$orderId)
    {
        $dataPay['order_id'] = $orderId;
        return $this->create($dataPay);
    }

    private function updateQuantityProduct($product,$quantity)
    {
        $product->sold_quantity += $quantity;
        $product->remain_quantity -= $quantity;
        $product->save();
    }

    private function updateQuantityProductVariant($productVariant, $quantity)
    {
        $productVariant->sold_quantity += $quantity;
        $productVariant->remain_quantity -= $quantity;
        $productVariant->save();
    }

    private function updateTotalAmountOrder($order, $totalAmount, $voucher)
    {
        $totalAmount += (int)round($totalAmount * $voucher / 100 );
        $order->total_amount = $totalAmount;
        $order->save();
    }

    private function processOrderByProductDetail($dataPay,$voucher)
    {
        $productVariantId = session()->get('productVariantId');
        $buyQuantity = session()->get('buyQuantity');
        $productVariant = $this->productVariantRepository->getById($productVariantId);
        if(is_null($productVariant))
        {
            throw new \Exception('Sản phẩm không tồn tại');
        }
        $order = $this->createOrder($voucher);
        $this->createOrderLine($productVariant,$buyQuantity, $order);
        $totalAmount = priceDiscount($productVariant->product->price,$productVariant->product->discount) * $buyQuantity;
        $this->updateTotalAmountOrder($order, $totalAmount,$voucher);
        $this->createPay($dataPay, $order->id);
    }

    private function createOrderLine($productVariant,$buyQuantity, $order)
    {
        $originPrice = priceDiscount($productVariant->product->price,$productVariant->product->discount);
        if ($buyQuantity > $productVariant->remain_quantity) {
            throw new \Exception("Đặt hàng thất bại, không đủ số lượng sản phẩm");
        }

        $dataOrderLine['order_id'] = $order->id;
        $dataOrderLine['product_variant_id'] = $productVariant->id;
        $dataOrderLine['quantity'] = $buyQuantity;
        $dataOrderLine['price'] = $originPrice;

        $orderLineInsert = $this->orderLineRepository->create($dataOrderLine);
        $this->updateQuantityProduct($productVariant->product,$dataOrderLine['quantity']);
        $this->updateQuantityProductVariant($productVariant, $dataOrderLine['quantity']);
        return $orderLineInsert;
    }
}