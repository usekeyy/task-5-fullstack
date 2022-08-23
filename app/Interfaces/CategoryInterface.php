<?php  

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories as Category;

interface CategoryInterface
{
    public function getAllCategory();
    public function getCategoryById(Category $category);
    public function createCategory(CategoryRequest $request);
    public function updateCategory(CategoryRequest $request,Category $category);
    public function deleteCategory(Category $category);
}