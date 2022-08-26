<?php  

namespace App\Interfaces;

use App\Models\Post;

interface WebPostInterface{

    public function viewStore();
    public function viewUpdate(Post $post);

}