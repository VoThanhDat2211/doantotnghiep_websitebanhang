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

    public function getCategoryByName($data)
    {
        return $this->category
                ->where(['name' => $data['name']])
                ->first();
    }

    public function getAllCategoriesWithProducts()
    {
        return $this->category->with('products')->get();
    }

    public function getCategories()
    {
        return $this->category->select('id','name')->get();
    }

    public function getCategoryIds()
    {
        return $this->category->pluck('id')->toArray();
    }

    public function getById($id)
    {
        return $this->category->find($id);
    }

    public function createCategory($data)
    {
        return $this->category->create([
            'name' => $data['name'],
            'parent_category' => $data['parent_category'],
        ]);
    }

    public function update(array $data, $category)
    {
        return $category->update($data);
    }
}