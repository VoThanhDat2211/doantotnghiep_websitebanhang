<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index()
    {
        $customers = $this->customerService->getAll();
        return view('admin.customer.list-customer', ['customers' => $customers,'increment' => 0]);
    }
}
