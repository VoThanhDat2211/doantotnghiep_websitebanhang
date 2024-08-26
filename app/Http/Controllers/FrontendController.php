<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
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

    public function getByParentCategory()
    {
        return view('user.product-by-parent-category');
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