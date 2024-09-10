<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository 
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, $product)
    {
        return $product->update($data);
    }

    public function delete($product)
    {
        return $product->delete();
    }

    public function getProducts()
    {
        return $this->product->paginate(30);
    }

    public function getProductsWithProductVariants()
    {
        return $this->product->with('productVariants')->get();
    }

    public function getByIdWithImage($id)
    {
        return $this->product->with('imageProducts')->find($id);
    }


    public function existsProductName($productName)
    {
        return $this->product->where('name',$productName)->exists();
    }

    public function getById($id)
    {
        return  $this->product->find($id);
    }

    public function getByIdWithProductVariants($id)
    {
        return $this->product->with('productVariants')->find($id);
    }

    public function getByCategories(array $categoryIds)
    {
        return  Product::whereIn('category_id', $categoryIds)->paginate(16);
    }

    public function getByCategory($categoryId)
    {
        return $this->product->where('category_id', $categoryId)->paginate(16);
    }
}