<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)   {
        $this->categoryService = $categoryService;
    }
    public function index() : View
    {
        return view('admin.product.list-product');
    }

    public function create() : View
    {
        $categoryIds = $this->categoryService->getCategoryIds();
        return view('admin.product.form-create',['$categoryIds' => $categoryIds]);
    }

    public function store(CreateProductRequest $request)
    {
        dd(2);
    }
}
