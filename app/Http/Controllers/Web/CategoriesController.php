<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories as Category;
use App\Interfaces\CategoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Repositories\WebCategoryRepository;

class CategoriesController extends Controller
{
    protected $categoryInterface;

    public function __construct(WebCategoryRepository $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }
    
    public function index()
    {
        return $this->categoryInterface->getAllCategory();
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryInterface->createCategory($request);
    }

    public function create()
    {
        return $this->categoryInterface->viewStore();
    }

    public function show(Category $category)
    {
        return $this->categoryInterface->getCategoryById($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        return $this->categoryInterface->updateCategory($request, $category);
    }

    public function destroy(Category $category)
    {
        return $this->categoryInterface->deleteCategory($category);
    }
}
