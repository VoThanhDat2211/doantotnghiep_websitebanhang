<?php

namespace App\Http\Controllers;

use App\Enums\CategoryParentEnum;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\LoginFormRequest;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\OrderService;

;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    protected $categoryService;
    protected $orderService;
    protected $customerService;
    public function __construct(CategoryService $categoryService,
                                OrderService $orderService,
                                CustomerService $customerService,                           
    )
    {
        $this->categoryService = $categoryService;
        $this->customerService = $customerService;
        $this->orderService = $orderService;
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
        $quantityCustomer = $this->customerService->countCustomer();
        $quantityOrder = $this->orderService->countByDate();
        $totalAmounts = $this->orderService->getTotalAmountByDate();
        $revenue = array_sum($totalAmounts);
        return view('admin.dashboard',['quantityCustomer' => $quantityCustomer,
                                                    'quantityOrder' => $quantityOrder,
                                                    'revenue' => $revenue,
    ]);
    }

    public function getCategoryList() : View
    {
        $categoryParents = CategoryParentEnum::cases();
        $categories = $this->categoryService->getAllCategoriesWithProducts();
        return view('admin.category.list-category',['categories'=>$categories, 'increment' => 0, 'categoryParents' => $categoryParents]);
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

    public function getFormUpdateCategory($id)
    {
        $category = $this->categoryService->getById($id);
        if(is_null($category)) {
            return view('admin.category.form-update');
        }
        Session::put('categoryId', $id);

        return view('admin.category.form-update',['category' => $category,]);
    }

    public function updateCategory(CreateCategoryRequest $request)
    {
        $data['name'] = Str::upper($request->input('name'));
        $data['parent_category'] = $request->input('parent_category');
        $categoryId = Session::get('categoryId');
        $category = $this->categoryService->getById($categoryId);
        Session::forget('categoryId');
        if (is_null($category)) {
            $result = [
                $message = "Không tìm thấy danh mục",
                $status = 'error',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        }
        $categoryExists = $this->categoryService->getCategoryByName($data);
        if (!is_null($categoryExists) && $category->name != $data['name']) {
            return back()->withInput()->withErrors(["name" => "Tên danh mục đã tồn tại !"]);
        }

        $resultUpdate = $this->categoryService->update($data, $category);

        if ($resultUpdate) {
            $result = [
                $message = "Sửa danh mục thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        } else {
            $result = [
                $message = "Sửa danh mục thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        }
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryService->getById($id);
        if(is_null($category)) {
            $result = [
                $message = "Không tìm thấy danh mục",
                $status = 'error',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        }

        $resultDelete = $this->categoryService->delete($category);
        if($resultDelete) {
            $result = [
                $message = "Xóa danh mục thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        } else {
            $result = [
                $message = "Xóa danh mục thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-category-list')->with('result', $result);
        }
    }
}