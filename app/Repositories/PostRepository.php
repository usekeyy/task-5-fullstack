<?php 

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostInterface;
use App\Traits\ResponseAPI;
use App\Models\Post;
use App\Models\Categories as Category;

class PostRepository implements PostInterface
{
    use ResponseAPI;

    public function getAllPost()
    {
        //select all post
        $post = Post::all();

        return $this->success("Berhasil, load list post", $post);
    }

    public function getPostById(Post $post)
    {
        return $this->success("Data post berhasil ditemukan", $post);
    }

    public function createPost(PostRequest $request)
    {
        //check category
        if(!Category::where('id', $request->category_id)->exists()){
            return $this->error("Category tidak ditemukan");
        }
        
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

        return $this->success("Data post berhasil ditambahkan", $post);

    }

    public function UpdatePost(PostRequest $request, Post $post)
    {
        //check category
        if(!Category::where('id', $request->category_id)->exists()){
            return $this->error("Category tidak ditemukan");
        }

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

        return $this->success("Data post berhasil diubah", $post);

    }

    public function deletePost(Post $post)
    {
        //delete old image
        File::delete(public_path('images/'.$post->image));

        //delete post
        $post->delete();

        return $this->success("Data post berhasil dihapus", $post);
    }
}