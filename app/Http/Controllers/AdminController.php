<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getLogin() {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            "username" => "bail|required|max:255",
            "password" => "bail|required|max:255",
        ], [
            "username.required" => "Tên đăng nhập không được để trống.",
            "username.max" => "Tên đăng nhập không được vượt quá 255 ký tự.",
            "password.required" => "Mật khẩu không được để trống.",
            "password.max" => "Mật khẩu không được vượt quá 255 ký tự.",
        ]);


        $credentials = $request->only("username", "password");
        dd($credentials);
        if (Auth::guard('admin')->attempt($credentials, $request->has("remember"))) {
            return redirect()->route('admin-dasboard');
        } else {
            return back()->withInput()->withErrors([
                "username" => "Tên đăng nhập hoặc mật khẩu không đúng!",
            ]);
        }

    }

    public function dashboard() {
        return view('admin.dashboard');
    }
}