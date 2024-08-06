<?php
namespace App\Services;

use App\Repositories\ImageProductRepository;

class ImageProductService
{
    protected $imageProductRepository;
    public function __construct(ImageProductRepository $imageProductRepository)
    {
        $this->imageProductRepository = $imageProductRepository;
    }

    public function create(array $data)
    {
        return $this->imageProductRepository->create($data);
    }
}