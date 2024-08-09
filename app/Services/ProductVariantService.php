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

    public function create($data)
    {
        return $this->productVariantRepository->create($data);
    }

    public function getByColorAndName($color,$size)
    {
        return $this->productVariantRepository->getByColorAndSize($color, $size);
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariantRepository->getByIdAndProduct($id,$productId);
    }


}