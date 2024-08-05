<?php
namespace App\Repositories;
use App\Models\Category;

class CategoryRepository
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoryByNameAndParentCategory($data)
    {
        return $this->category
                ->where(['name' => $data['name'], 'parent_category' => $data['parent_category']])
                ->first();
    }

    public function getAllCategories()
    {
        return $this->category->with('products')->get();
    }

    public function getCategoryIds()
    {
        return $this->category->pluck('id')->toArray();
    }

    public function createCategory($data)
    {
        return $this->category->create([
            'name' => $data['name'],
            'parent_category' => $data['parent_category'],
        ]);
    }
}
