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
}