<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\ShoppingCart;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\CustomerVoucherService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
class FrontendController extends Controller
{
    protected $customerService;
    protected $customerVoucherService;
    protected $voucherService;
    protected $categoryService;
    protected $productService;
    protected $productVariantService;
    protected $cartService;
    const PARENT_CATEGORY = [1,2,3];

    public function __construct(CustomerService $customerService,
    CustomerVoucherService $customerVoucherService,
    VoucherService $voucherService,
    CategoryService $categoryService,
    ProductService $productService,
    ProductVariantService $productVariantService,
    CartService $cartService    ,
    )
    {
        $this->customerService = $customerService;
        $this->customerVoucherService = $customerVoucherService;
        $this->voucherService = $voucherService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
        $this->cartService = $cartService;
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
        $parentCategoryParam = $request->route('parent_category');
        $parentCategories = config('param.parent_category_name');
        $parentCatgoryId = 0;
        foreach($parentCategories as $key => $parentCategory) {
            if($parentCategory == $parentCategoryParam)
            {
                $parentCatgoryId = $key;
                break;
            }
        }
        if(!in_array($parentCatgoryId,self::PARENT_CATEGORY))
        {
            return redirect()->route('error-404');
        }

        $categories = $this->categoryService->getByParentCategory($parentCatgoryId);
        $categoryIds = $this->categoryService->getIdsByParentCategory($parentCatgoryId) ;
        $products = $this->productService->getByCategories($categoryIds);
        return view('user.product-by-parent-category',['categories' => $categories,
                                                        'products' => $products]);
    }

    public function getCart()
    {
        $customerId = Auth::user()->id;
        $carts = $this->cartService->getByCustomer($customerId);
        $total_amount = 0;
        foreach($carts as $cart)
        {
            $productVariant = $this->productVariantService->getById($cart->product_variant_id);
            $total_amount += $cart->quantity * priceDiscount($productVariant->product->price, $productVariant->product->discount);
        }
        return view('user.cart', ['carts'=> $carts,'total_amount' => $total_amount]);
    }

    public function handlePay(Request $request) {
        $productVariantId = $request->input('productVariantId');
        $quantity = $request->input('quantity');
        session()->put('productVariantId', $productVariantId);  
        session()->put('buyQuantity', $quantity);

        return redirect()->route('user-pay');
    }

    public function getPay()
    {
        $productVariantId = session()->get('productVariantId');
        $buyQuantity = session()->get('buyQuantity');
        $customerId = Auth::user()->id;
        $productVariant = $this->productVariantService->getById($productVariantId);
        if(is_null($productVariant) )
        {
            return redirect()->route('error-404');
        }
        // VOUCHER
        $today = Carbon::today();
        $customerVouchers = $this->customerVoucherService->getByCustomer($customerId);
        $vouchers = $this->voucherService->getByVoucherType();
        if(!$customerVouchers->isEmpty()){
            foreach($customerVouchers as $customerVoucher) {
                $vouchers->push($customerVoucher->voucher);
            }
        }
        
        return view('user.pay',['productVariant' => $productVariant, 'buyQuantity' => $buyQuantity, 'vouchers' => $vouchers,'today' => $today]);
    }

    public function getPayByCart()
    {
        $total = 0;
        $carts = session()->get('carts');
        if(is_null($carts))
        {
            return redirect()->route('error-404');
        }
        foreach($carts as $cart)
        {
            $total += $cart->total_amount;
        }
        return view('user.pay-by-cart',['carts' => $carts, 'total' => $total]);
    }

    public function getProductDetail($id)
    {
        $product = $this->productService->getById($id);
        if(is_null($product))
        {
            return redirect()->route('error-404');
        }
        $imageProducts = $product->imageProducts;
        $imageProducts->shift();
        $colors = $this->productVariantService->getDistinctColorByProduct($id);
        $sizes = $this->getSizes($id);
        $configuredSizes = config('variant.size');
        
        return view('user.product-detail',['product' => $product,
                                            'colors' => $colors,
                                            'sizes' => $sizes,
                                            'imageProducts' => $imageProducts,
                                            'configuredSizes' => $configuredSizes                                                   
                                        ]);
    }

    private function getSizes($productId)
    {
        $sizes = $this->productVariantService->getDistinctSizeByProduct($productId);
        $configuredSizes = config('variant.size');
        $configuredSizes = array_filter($configuredSizes, function($value, $key) use ($sizes) {
            return in_array($key, $sizes);
        },ARRAY_FILTER_USE_BOTH);

        return $configuredSizes;
    }

    public function getOrderHistory()
    {
        return view('user.order-history');
    }
}