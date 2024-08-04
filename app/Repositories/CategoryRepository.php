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
                ->limit(1)
                ->get();
    }

    public function createCategory($data)
    {
        $category = $this->category->create([
            'name' => $data['name'],
            'parent_category' => $data['parent_category'],
        ]);
    
        return $category;
    }
}