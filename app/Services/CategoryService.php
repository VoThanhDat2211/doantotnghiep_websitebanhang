<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function getCategoryByName($data)
    {
        return $this->categoryRepository->getCategoryByName($data);
    }

    public function getAllCategoriesWithProducts()
    {
        return $this->categoryRepository->getAllCategoriesWithProducts();
    }

    public function getCategoryIds() : array
    {
        return $this->categoryRepository->getCategoryIds();
    }

    public function getCategories()
    {
        return $this->categoryRepository->getCategories();
    }

}