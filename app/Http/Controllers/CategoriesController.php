<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories as Category;
use App\Interfaces\CategoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
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
