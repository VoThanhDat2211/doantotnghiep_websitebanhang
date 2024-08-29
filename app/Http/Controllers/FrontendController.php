<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\CustomerVoucherService;
use App\Services\ProductService;
use App\Services\VoucherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class FrontendController extends Controller
{
    protected $customerService;
    protected $customerVoucherService;
    protected $voucherService;
    protected $categoryService;

    protected $productService;
    const PARENT_CATEGORY = [1,2,3];

    public function __construct(CustomerService $customerService,
    CustomerVoucherService $customerVoucherService,
    VoucherService $voucherService,
    CategoryService $categoryService,
    ProductService $productService,)
    {
        $this->customerService = $customerService;
        $this->customerVoucherService = $customerVoucherService;
        $this->voucherService = $voucherService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }
    public function login()
    {
        return view('user.login');
    }
    
    public function authenticate(LoginFormRequest $request)
    {
        $credentials = $request->only("username", "password");
        if (Auth::attempt($credentials, $request->has("remember"))) {
            $request->session()->regenerate();
            return redirect()->route('home_page_user');
        } else {
            return back()->withInput()->withErrors([
                "username" => "Tên đăng nhập hoặc mật khẩu không đúng!",
            ]);
        }
    }

    public function register()
    {
        return view("user.register");
    }

    public function postRegister(RegisterFormRequest $request)
    {
       $data['username'] = $request->input('username');
       $data['password'] = $request->input('password') ? Hash::make($request->input('password')) : null ;
       $data['email'] = $request->input('email');
       $data['birthday'] = $request->input('birthday');

        $usernameExists = $this->customerService->getByUserName($data['username']);
        if(isset($usernameExists))
        {
            return back()->withInput()->withErrors(["username" => "Tên đăng nhập đã tồn tại !"]);
        }

        $emailExists = $this->customerService->getByEmail($data['email']);
        if(isset($emailExists))
        {
            return back()->withInput()->withErrors(["email" => "Email đã tồn tại !"]);
        }

        $createResult = $this->customerService->create($data);
        if($createResult) {
            $voucherCreate = $this->createVoucher();
            $customerId = $createResult->id;
            $voucherId = $voucherCreate->id;
            $customerVoucherCreate = $this->createCustomerVoucher($customerId,$voucherId);
            $result = [
                $message = "Tạo tài khoản thành công",
                $status = 'success',
            ];
            return redirect()->route('user-form-login')->with('result', $result);
        } else{
            $result = [
                $message = "Tạo tài khoản thất bại",
                $status = 'error',
            ];
            return redirect()->route('user-form-login')->with('result', $result);
        }
    }

    private function createVoucher() 
    {
        $data['title'] =  Str::upper('KHÁCH HÀNG MỚI');
        $data['quantity'] = 1;
        $data['value'] = 20;
        $data['voucher_type'] = 1;
        $data['remain_quantity'] = 1;
        $data['voucher_code'] = $this->getVoucherCode();
        $data['start_date'] = now();
        $data['end_date'] = Carbon::now()->addMonths(2);

        return $this->voucherService->create($data);
    }

    private function createCustomerVoucher($customerId, $voucherId)
    {
        $data['customer_id'] = $customerId;
        $data['voucher_id'] = $voucherId;
        $data['status'] = 1;

        return $this->customerVoucherService->create($data);
    }

    private function getVoucherCode()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = substr(str_shuffle($letters), 0, 2);
        $currentDate = date('dmy');
        $voucherCode = $randomLetters . $currentDate;
        return $voucherCode;
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('home_page_user');
    }

    public function home()
    {
        return view('user.home');
    }

    public function getByParentCategory(Request $request)
    {
        $parentCategory = (int)$request->route('parent_category');
        if(!in_array($parentCategory,self::PARENT_CATEGORY))
        {
            return redirect()->route('error-404');
        }

        $categories = $this->categoryService->getByParentCategory($parentCategory);
        $categoryIds = $this->categoryService->getIdsByParentCategory($parentCategory) ;
        $products = $this->productService->getByCategories([0]);

        return view('user.product-by-parent-category',['categories' => $categories,
                                                        'products' => $products]);
    }

    public function getCart()
    {
        return view('user.cart');
    }

    public function getPay()
    {
        return view('user.pay');
    }

    public function getProductDetail()
    {
        return view('user.product-detail');
    }

    public function getOrderHistory()
    {
        return view('user.order-history');
    }
}