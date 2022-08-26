<?php  

namespace App\Interfaces;

use App\Models\Categories as Category;

interface WebCategoryInterface{

    public function viewStore();
    public function viewUpdate(Category $category);

}