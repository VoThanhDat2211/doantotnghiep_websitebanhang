<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\LoginFormRequest;
use App\Services\CategoryService;;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
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

    public function getFormCreateCategory() :View 
    {
        return view('admin.category.form-create');
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        dd(2);
        $data['name'] = $request->input('name');
        $data['parent_category'] = Str::upper($request->input('parent_category'));
        $categoryExists = $this->categoryService->getCategoryByNameAndParentCategory($data);

        if ($categoryExists) {
            dd(1);
            return back()->withInput()->with('error','Danh mục đã tồn tại');
        }
        
        $createCategory = $this->categoryService->createCategory($data);
        if ($createCategory) {
            dd(2);
            return redirect()->route('category.list')->with('create_success','Tạo danh mục thành công');
        }
        else {
            dd(3);
            return redirect()->route('category.list')->with('create_error','Tạo danh mục thất bại');
        }
    }
}