<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const ORDER_STATUS_PEDDING = 1;
    const ORDER_STATUS_PAID = 2;

    const ORDER_STATUS_SHIPPING = 3;
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index()
    {
        $orderStatusArray = config('variant.order_status');
        $orderStatusColors = config('variant.order_status_color');
        $orders = $this->orderService->getAllPaginate();
        return view("admin.order.list-order",
        ['orders' => $orders,
        'increment' => 0,
        'orderStatusArray' => $orderStatusArray,
        'orderStatusColors'=> $orderStatusColors
        ]); 
    }

    public function update($id)
    {
        $order = $this->orderService->getById($id);
        if(is_null($order)) {
            return redirect()->route('error-404');
        }
        
        $resultUpdate = $this->orderService->update($order,$status = null);

        if($resultUpdate) {
            $result = [
                $message = "Cập nhật trạng thái thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-order-list')->with('result', $result);
        } else{
            $result = [
                $message = "Cập nhật trạng thái thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-order-list')->with('result', $result);
        }
    }

    public function getOrderDetail($id)
    {
        $order = $this->orderService->getByIdWithOrderLine($id);
        if(is_null($order)) {
            return redirect()->route('error-404');
        }

        $orderLines = $order->orderLines;
        $pay = $order->pay;
        
        if ($orderLines->isEmpty() || is_null($pay)) {
            return redirect()->route('error-404');
        } 

        return view("admin.order.detail-order", ['increment' => 0,'orderLines' => $orderLines, 'pay' =>$pay]);    
    }
}