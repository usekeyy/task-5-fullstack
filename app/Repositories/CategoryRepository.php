<?php  

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Traits\ResponseAPI;
use App\Models\Categories as Category;

class CategoryRepository implements CategoryInterface
{
    use ResponseAPI;

    public function getAllCategory()
    {
        //select all post
        $category = Category::latest()->paginate(5);
        
        return $this->success("Berhasil, load list category", $category, 200);
    }

    public function getCategoryById(Category $category)
    {
        return $this->success("Data category berhasil ditemukan", $category, 200);
    }

    public function createCategory(CategoryRequest $request)
    {
        //create a new category
        $category = new Category;
        $category->name     = $request->name;
        $category->user_id  = auth()->id();
        $category->save();
        return $this->success("Data category berhasil ditambahkan", $category, 201);

    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        //update category
        $category->name     = $request->name;
        $category->save();
        return $this->success("Data category berhasil diubah", $category, 201);

    }

    public function deleteCategory(Category $category)
    {
        //delete category
        $category->delete();

        return $this->success("Data category berhasil dihapus", $category, 201);
    }
}