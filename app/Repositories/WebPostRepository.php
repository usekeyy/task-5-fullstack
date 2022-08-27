<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Interfaces\WebPostInterface;
use App\Models\Post;
use App\Models\Categories as Category;

class WebPostRepository implements PostInterface, WebPostInterface
{

    public function getAllPost()
    {
        //select all post
        $posts = Post::with('author','category')->get();

        return view('postDashboard', ['posts' => $posts]);
    }

    public function getPostById(Post $post)
    {
        $category = Category::all();

        return view('updatePost', ['categories' => $category, 'post' => $post]);
    }

    public function viewStore()
    {
        $category = Category::all();

        return view('createPost', ['categories' => $category]);
    }


    public function viewUpdate(Post $post)
    {
        $category = Category::all();

        return view('createPost', ['categories' => $category, 'post' => $post]);
    }

    public function createPost(PostRequest $request)
    {   
        //define image name and save 
        $img = $request->file('image');
        $imgName = $img->hashName();
        $img->move(public_path('images'), $imgName);

        //create a new post
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $imgName;
        $post->user_id = auth()->id();
        $post->category_id = $request->category_id;
        $post->save();

        return redirect('/post');

    }

    public function UpdatePost(PostRequest $request, Post $post)
    {
        //check image change
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = $img->hashName();

            //save new image and delete old image
            $img->move(public_path('images'), $imgName);
            File::delete(public_path('images/'.$post->image));
            
            //update post image
            $post->image = $imgName;
        }

        //update post without image
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect('/post');

    }

    public function deletePost(Post $post)
    {
        //delete old image
        File::delete(public_path('images/'.$post->image));

        //delete post
        $post->delete();

        return redirect('/post');
    }
}