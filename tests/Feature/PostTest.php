<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Categories;


class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345,678910).'test@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        if (!auth()->attempt(['email'=>$user->email, 'password'=>'password'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        return $accessToken = auth()->user()->createToken('authToken')->accessToken;
    }

    public function test_create_post()
    {
        $token = $this->authenticate();

        Storage::fake('images');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST','api/v1/post',[
            'title' => 'Test product',
            'content' => 'test-sku',
            'image' => UploadedFile::fake()->image('image.jpg'),            
            'user_id' => 1,
            'category_id' => 1,
        ]);
        
        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(201);
    }

    public function test_update_product()
    {
        $token = $this->authenticate();

        Storage::fake('images');
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT','api/v1/post/1',[
            'title' => 'Test product',
            'content' => 'test-sku',
            'image' => UploadedFile::fake()->image('image.jpg'),            
            'user_id' => 1,
            'category_id' => 1,
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(201);
    }

    public function test_get_post_by_id()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/v1/post/1');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    public function test_get_all_post()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/v1/post');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }
    
    public function test_delete_product()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE','api/v1/post/1');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(201);
    }
}
