<?php
namespace App\Repositories;

use App\Models\Product;

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

    public function getProducts()
    {
        return $this->product->whereNull('deleted_at')->get();
    }

    public function getProductsWithRoductVariants()
    {
        return $this->product->with('productVariants')->whereNull('deleted_at')->get();
    }

    public function existsProductName($productName)
    {
        return $this->product->where('name',$productName)->exists();
    }

    public function getById($id)
    {
        return $this->product->find($id);
    }
}