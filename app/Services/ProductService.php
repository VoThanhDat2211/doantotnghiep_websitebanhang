<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function update(array $data, $product)
    {
        DB::beginTransaction();
        try {
            $result =  $this->productRepository->update($data, $product);
            DB::commit();
            return $result;
        } catch(Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($product)
    {
        DB::beginTransaction();
        try {
            $result = $this->productRepository->delete($product);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
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