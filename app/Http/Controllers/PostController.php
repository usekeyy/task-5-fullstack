<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Interfaces\PostInterface;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    protected $postInterface;

    public function __construct(PostInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    public function index()
    {
        return $this->postInterface->getAllPost();
    }

    public function store(PostRequest $request)
    {
        return $this->postInterface->createPost($request);
    }

    public function show(Post $post)
    {
        return $this->postInterface->getPostById($post);
    }

    public function update(PostRequest $request, Post $post)
    {
        return $this->postInterface->updatePost($request, $post);
    }

    public function destroy(Post $post)
    {
        return $this->postInterface->deletePost($post);
    }
}
