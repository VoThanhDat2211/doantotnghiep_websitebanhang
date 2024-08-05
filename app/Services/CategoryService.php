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

    public function createCategory($data)
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function getCategoryByNameAndParentCategory($data)
    {
        return $this->categoryRepository->getCategoryByNameAndParentCategory($data);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryIds()
    {
        return $this->categoryRepository->getCategoryIds();
    }

}
