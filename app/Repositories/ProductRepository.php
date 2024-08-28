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
        return $this->product->whereNull('deleted_at')->paginate(30);
    }

    public function getProductsWithProductVariants()
    {
        return $this->product->with('productVariants')->whereNull('deleted_at')->get();
    }

    public function getByIdWithImage($id)
    {
        return $this->product->with('imageProducts')->whereNull('deleted_at')->find($id);
    }


    public function existsProductName($productName)
    {
        return $this->product->where('name',$productName)->whereNull('deleted_at')->exists();
    }

    public function getById($id)
    {
        return  $this->product->whereNull('deleted_at')->find($id);
    }

    public function getByIdWithProductVariants($id)
    {
        return $this->product->with('productVariants')->whereNull('deleted_at')->find($id);
    }
}