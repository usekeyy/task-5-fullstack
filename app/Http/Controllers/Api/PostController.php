<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Interfaces\PostInterface;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    protected $postInterface;

    public function __construct(PostRepository $postInterface)
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
