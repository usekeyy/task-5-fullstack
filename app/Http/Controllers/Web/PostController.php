<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Repositories\WebPostRepository;

class PostController extends Controller
{
    protected $postInterface;

    public function __construct(WebPostRepository $postInterface)
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
    
    public function create()
    {
        return $this->postInterface->viewStore();
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
