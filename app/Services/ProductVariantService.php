<?php 
namespace App\Services;

use App\Repositories\ProductVariantRepository;

class ProductVariantService
{
    protected $productVariantRepository;
    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    public function getById($id) 
    {
        return $this->productVariantRepository->getById($id);
    }
}