<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\CategoryService;
use App\Services\ImageProductService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $imageProductService;

    protected $productVariantService;

    public function __construct(CategoryService $categoryService,
    ProductService $productService,
    ImageProductService $imageProductService,
    ProductVariantService $productVariantService,
    )   {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->imageProductService = $imageProductService;
        $this->productVariantService = $productVariantService;                                  
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
        $data['name'] = Str::upper($request->input('name'));
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
        $generatedImageName = 'image' . time() . $image->getClientOriginalName();
        $dataImage['image_path'] = $generatedImageName;
        $image->move(public_path('image'), $generatedImageName); 
        $this->imageProductService->create($dataImage);
        
        return $generatedImageName;
    }

    public function edit($id)
    {
        $product = $this->productService->getById($id);
        if (is_null($product)) {
            return view("admin.product.form-update");
        }
        $categories = $this->categoryService->getCategories();
        $productVariant = $product->productVariant;
        Session::put('productId', $id);
        return view("admin.product.form-update",
        ['product' => $product, 
        'categories' =>$categories,
        'productVariant' => $productVariant]);
    }

    public function update(UpdateProductRequest $request) {
        $data['name'] = Str::upper($request->input('name'));
        $data['description'] = $request->input('description');
        $data['category_id'] = $request->input('category_id');
        $data['discount'] = $request->input('discount');
        $data['default_product_variant_id'] = $request->input('default_product_variant_id');
        $productId = Session::get('productId');
        $product = $this->productService->getById($productId);
        Session::forget('productId');
        if(is_null($product)) {
            $result = [
                $message = "Không tìm thấy sản phẩm",
                $status = 'error',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        }

        $categoryIds = $this->categoryService->getCategoryIds();
        if (!in_array($data['category_id'], $categoryIds)) {
            return back()->withInput()->withErrors(["category_id" => "Danh mục không tồn tại !"]);
        }
        $existsProductName = $this->productService->existsProductName($data['name']);
       
        if ($existsProductName && $data['name'] != $product->name) { {
                return back()->withInput()->withErrors(["name" => "Tên sản phẩm đã tồn tại !"]);
            }
        }

        if($data['default_product_variant_id'] != 0)
        {
            $productVariant = $this->productVariantService->getById($data['default_product_variant_id']);
            if (is_null($productVariant)) {
                return back()->withInput()->withErrors(["default_product_variant_id" => "Biến thể sản phẩm không tồn tại !"]);
            }
        }
       

        $resultUpdate = $this->productService->update($data, $product);

        if($resultUpdate) {
            $result = [
                $message = "Sửa sản phẩm thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        } else{
            $result = [
                $message = "Sửa sản phẩm thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        }
    }

    public function delete($id)
    {
        $product = $this->productService->getById($id);
        if(is_null($product)) {
            $result = [
                $message = "Không tìm thấy sản phẩm",
                $status = 'error',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        }

        $resultDelete = $this->productService->delete($product);
        if($resultDelete) {
            $result = [
                $message = "Xóa sản phẩm thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        } else {
            $result = [
                $message = "Xóa sản phẩm thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-list')->with('result', $result);
        }
    }

    public function getImage($id)
    {
        $product = $this->productService->getByIdWithImage($id);
        if(is_null($product))
        {
            return view('admin.image-product.list-image', ['productId' => null]);
        }
        $images = $product->imageProducts;
        Session::put('productId',$id);
        if($images ->isEmpty())
        {
            $images = null;
        }
        return view('admin.image-product.list-image',['images' => $images, 'productId' => $id]);
    }

    public function createImage($id)
    {
        $product = $this->productService->getById($id);
        if(is_null($product))
        {
           return view('admin.image-product.form-create',['productId' => null]);
        }
        return view('admin.image-product.form-create',['productId' => $id]);
    }

    public function deleteImage($id)
    {
        $image = $this->imageProductService->getById($id);
        if (is_null($image)) {
            $result = [
                $message = "Không tìm thấy hình ảnh",
                $status = 'error',
            ];
            return back()->withInput()->with('result', $result);
        }

        $resultDelete = $this->imageProductService->delete($image);
        if ($resultDelete) {
            $result = [
                $message = "Xóa hình ảnh thành công",
                $status = 'success',
            ];
            return back()->withInput()->with('result', $result);
        } else {
            $result = [
                $message = "Xóa sản phẩm thất bại",
                $status = 'error',
            ];
            return back()->withInput()->with('result', $result);
        }
    }
}