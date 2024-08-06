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
        $categories = $this->categoryService->getAllCategoriesWithProducts();
        return view('admin.category.list-category',['categories'=>$categories, 'increment' => 0]);
    }

    public function getFormCreateCategory() :View
    {
        return view('admin.category.form-create');
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $data['name'] =  Str::upper($request->input('name'));
        $data['parent_category'] = $request->input('parent_category');
        $categoryExists = $this->categoryService->getCategoryByName($data);
        if (!empty($categoryExists)) {
            return back()->withInput()->withErrors(["name" => "Danh mục đã tồn tại !"]);
        }

        $createCategory = $this->categoryService->create($data);
        if ($createCategory) {
            $result = [
                $message = "Tạo danh mục thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-category-list')->with('result',$result);
        }
        else {
            $result = [
                $message = "Tạo danh mục thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-category-list')->with('result',$result);
        }
    }
}