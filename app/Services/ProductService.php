<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;  
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }

    public function existsProductName($productName)
    {
        return $this->productRepository->existsProductName($productName);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }
}