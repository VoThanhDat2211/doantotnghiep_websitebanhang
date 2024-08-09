<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductVariantRequest;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductVariantController extends Controller
{
    protected $productVariantService;
    protected $productService;
    public function __construct(ProductVariantService $productVariantService,
    ProductService $productService,        
    )
    {
        $this->productVariantService = $productVariantService;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if(is_null($product))
        {
            return redirect()->route('error-404');
        }

        $productVariants = $product->productVariants;
        if($productVariants->isEmpty())
        {
            $productVariants = null;
        }

        return view("admin.product-variant.list-product-variant", 
        ['productId' => $productId, 
        "productVariants" => $productVariants,
        'increment' => 0,
        ]);
    }

    public function create(Request $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if (is_null($product)) {
            return redirect()->route('error-404');
        }

        return view('admin.product-variant.form-create', ['productId' => $productId]);
    }

    public function store(CreateProductVariantRequest $request)
    {
        $productId = $request->id;
        $product = $this->productService->getByIdWithProductVariants($productId);
        if (is_null($product)) {
            return redirect()->route('error-404');
        }

        $data["product_id"] = $productId;
        $data["color"] =Str::upper($request->input('color'));
        $data["size"] = Str::upper($request->input('size'));
        $data["sold_quantity"] = 0;
        $data["remain_quantity"] = $request->input('remain_quantity');
        $data["price"] = $request->input('price');
        $data["image_path"] = $request->file('image');

        $productVariantExists = $this->productVariantService->getByColorAndName($data["color"], $data["size"]);
        if(!is_null($productVariantExists))
        {
            $result = [
                $message = "Biến thể đã tồn tại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);
        }

        if(!is_null($data["image_path"]))
        {
             $data["image_path"] = $this->handleFileImage($data["image_path"]);
        }

        $resultCreate = $this->productVariantService->create($data);
        if ($resultCreate) {
            $result = [
                $message = "Thêm biến thể thành công",
                $status = 'success',
            ];
            return redirect()->route('admin-product-variant-list',['id' => $productId])->with('result', $result);
        } else {
            $result = [
                $message = "Thêm biến thể thất bại",
                $status = 'error',
            ];
            return redirect()->route('admin-product-variant-list', ['id' => $productId])->with('result', $result);
        }
    }

    public function edit(Request $request)
    {
        $productId = $request->id;
        $productvariantId = $request->product_variant_id;
        $product = $this->productService->getById($productId);
        $productVariant = $this->productVariantService->getByIdAndProduct($productvariantId, $productId);
        if (is_null($product) || is_null($productVariant)) {
            return redirect()->route('error-404');
        }
        
        return view(
            "admin.product-variant.form-update",
            [
                'productId' => $productId,
                'productVariant' => $productVariant,
            ]
        );
    }

    private function handleFileImage($image)
    {
        $generatedImageName = 'image' . time() . $image->getClientOriginalName();
        $image->move(public_path('image'), $generatedImageName);
        return $generatedImageName;
    }
}
