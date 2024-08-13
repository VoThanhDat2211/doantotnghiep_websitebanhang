<?php
namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository 
{
    protected $productVariant;
    public function __construct(ProductVariant $productVariant) 
    {
        $this->productVariant = $productVariant;
    }

    public function getById($id)
    {
        return $this->productVariant->whereNull('deleted_at')->find($id);
    }

    public function create($data)
    {
        return $this->productVariant->create($data);
    }

    public function update(array $data, $productVariant)
    {
        return $productVariant->update($data);
    }

    public function delete($productVariant)
    {
        return $productVariant->delete($productVariant);
    }

    public function getproductVariantExists($productId,$color,$size)
    {
        return $this->productVariant->where(['product_id' => $productId,'color' => $color, 'size' => $size])->whereNull('deleted_at')->first();
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariant->where(['id' => $id, 'product_id' => $productId])->whereNull('deleted_at')->first();
    }
}