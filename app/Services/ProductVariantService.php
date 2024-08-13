<?php 
namespace App\Services;

use App\Repositories\ProductVariantRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function update(array $data, $productVariant)
    {
        DB::beginTransaction();
        try {
            $result = $this->productVariantRepository->update($data, $productVariant);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($productVariant)
    {
        DB::beginTransaction();
        try {
            $result = $this->productVariantRepository->delete($productVariant);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }


    public function getproductVariantExists($productId,$color,$size)
    {
        return $this->productVariantRepository->getproductVariantExists($productId,$color, $size);
    }

    public function getByIdAndProduct($id, $productId)
    {
        return $this->productVariantRepository->getByIdAndProduct($id,$productId);
    }


}