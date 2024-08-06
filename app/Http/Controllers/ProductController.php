<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Services\CategoryService;
use App\Services\ImageProductService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $imageProductService;

    public function __construct(CategoryService $categoryService,
    ProductService $productService,
    ImageProductService $imageProductService,
    )   {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->imageProductService = $imageProductService;                                      
    }
    public function index() : View
    {
        $products = $this->productService->getProducts();
        return view('admin.product.list-product',['products'=> $products,'increment' => 0]);
    }

    public function create() : View
    {
        $categories = $this->categoryService->getCategories();
        return view('admin.product.form-create',['categories' => $categories]);
    }

    public function store(CreateProductRequest $request)
    {
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $data['category_id'] = $request->input('category_id');
        $data['discount'] = $request->input('discount');
        $data['price'] = 0;
        $data['sold_quantity'] = 0;
        $data['remain_quantity'] = 0;
        $data['default_product_variant_id'] = 0;

        $categoryIds = $this->categoryService->getCategoryIds();
        if(!in_array($data['category_id'],$categoryIds))
        {
            return back()->withInput()->withErrors(["category_id" => "Danh mục không tồn tại !"]);
        }
        $existsProductName = $this->productService->existsProductName($data['name']);
        if($existsProductName)
        {
            {
                return back()->withInput()->withErrors(["name" => "Tên sản phẩm đã tồn tại !"]);
            }
        }

        $createProduct = $this->productService->create($data);
        if ($createProduct) {
            $images = $request->file('images');
            $dataImage['product_id'] = $createProduct->id;
            if(!is_null($images))
            {
                foreach ($images as $image) {
                    $dataImage['image_path'] = $this->handleFileImage($image,$dataImage);
                }
            }

            $result = [
                $message = "Tạo sản phẩm thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-list')->with('result',$result);
        }
        else {
            $result = [
                $message = "Tạo sản phẩm thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-list')->with('result',$result);
        }
    }

    private function handleFileImage($image,$dataImage) 
    {
        $generatedImageName = 'image' . time() . $image->getClientOriginalName() .'.' . $image->extension();
        $dataImage['image_path'] = $generatedImageName;
        $image->move(public_path('image'), $generatedImageName); 
        $this->imageProductService->create($dataImage);
        
        return $generatedImageName;
    }

    public function edit($id)
    {
        $product = $this->productService->getById($id);
        $categories = $this->categoryService->getCategories();
        $productVariant = $product->productVariant;
        return view("admin.product.form-update",
        ['product' => $product, 
        'categories' =>$categories,
        'productVariant' => $productVariant]);
    }
}