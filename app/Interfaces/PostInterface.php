<?php  

namespace App\Interfaces;

use App\Http\Requests\PostRequest;
use App\Models\Post;

interface PostInterface{
    public function getAllPost();
    public function getPostById(Post $post);
    public function createPost(PostRequest $request);
    public function updatePost(PostRequest $request, Post $post);
    public function deletePost(Post $post);

}