<?php  

namespace App\Repositories;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\WebCategoryInterface;
use App\Models\Categories as Category;

class WebCategoryRepository implements CategoryInterface, WebCategoryInterface
{
    public function getAllCategory()
    {
        //select all post
        $category = Category::with('author')->get();
        
        return view('categoryDashboard', ['categories' => $category]);
    }

    public function getCategoryById(Category $category)
    {
        return view('updateCategory', ['category' => $category]);
    }

    public function viewStore()
    {

        return view('createCategory');
    }


    public function viewUpdate(Post $post)
    {

        return view('updateCategory', ['category' => $category]);
    }

    public function createCategory(CategoryRequest $request)
    {
        //create a new category
        $category = new Category;
        $category->name     = $request->name;
        $category->user_id  = auth()->id();
        $category->save();

        return redirect('/categoryDashboard');

    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        //update category
        $category->name     = $request->name;
        $category->save();

        return redirect('/categoryDashboard');

    }

    public function deleteCategory(Category $category)
    {
        //delete category
        $category->delete();

        return redirect('/categoryDashboard');
    }
}