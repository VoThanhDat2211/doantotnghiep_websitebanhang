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

    public function getByColorAndSize($color,$size)
    {
        return $this->productVariant->where(['color' => $color, 'size' => $size])->whereNull('deleted_at')->first();
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariant->where(['id' => $id, 'product_id' => $productId])->whereNull('deleted_at')->first();
    }
}