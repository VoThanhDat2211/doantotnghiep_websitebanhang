<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function getLogin() : View
    {
        return view('admin.login');
    }

    public function authenticate(LoginFormRequest $request)
    {
        $credentials = $request->only("username", "password");
        if (Auth::guard('admin')->attempt($credentials, $request->has("remember"))) {
            $request->session()->regenerate();
             return redirect()->route('admin-dashboard');
        } else {
            return back()->withInput()->withErrors([
                "username" => "Tên đăng nhập hoặc mật khẩu không đúng!",
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
       // Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect("/admin/login");

    }
    public function dashboard() : View
    {
        return view('admin.dashboard');
    }

    public function getCategoryList() : View
    {
        return view('admin.category.list-category');
    }
}
