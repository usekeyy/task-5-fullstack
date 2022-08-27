<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\WebTestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class webPostTest extends WebTestCase
{
    
    public function test_user_create_a_post()
    {
        $user = User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'testCreate@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);    

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => $email,
            'password' => 'password',
        ]);

        // user buka halaman buat post baru
        $this->visit('/post/create');

        // user submit data baru
        Storage::fake('images');
        $this->submitForm('Submit', [
            'title' => 'Title for testing',
            'content' => 'This is a content for testing',
            'image' => UploadedFile::fake()->image('image.jpg'),            
            'category_id' => 1,
        ]);

        // lihat data post di database
        $this->seeInDatabase('posts', [
            'title' => 'Title for testing',
            'content' => 'This is a content for testing',
            // 'image' => UploadedFile::fake()->image('image.jpg'), nameimage hashing            
            'category_id' => 1,
        ]);

        // ter-redirect ke halaman daftar post
        $this->seePageIs('/post');

        // lihat post yang sudah diinput
        $this->see('Title for testing'); // ini titlenya
        $this->see('This is a content for testing');
    }

    public function test_user_update_post()
    {
        $user = User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'testUpdate@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);    

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => $email,
            'password' => 'password',
        ]);

        // user buka halaman buat post baru
        $this->visit('/post/create');

        // user submit data baru        
        Storage::fake('images');
        $post = Post::create([
            'title' => 'Title for testing',
            'content' => 'This is a content for testing',
            'image' => UploadedFile::fake()->image('image.jpg'),     
            'user_id' => $user->id,       
            'category_id' => 1,
        ]);

        // user buka halaman daftar post
        $this->visit('/post');

        // user click tombol edit post
        $this->visit("post/{$post->id}");

        // lihat url yang dituju sesuai dengan post yang diedit
        $this->seePageIs("post/{$post->id}");

        // user submit data post yang diupdate
        $this->submitForm('Submit', [
            'title' => 'Title update for testing'
        ]);

        // check perubahan data di table post
        $this->seeInDatabase('posts', [
            'id' => $post->id,
            'title' => 'Title update for testing'
        ]);

        // lihat halaman web yang ter-redirect
        $this->seePageIs('/post');
    }

    public function test_user_get_all_post()
    {
        $user = User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'testGetAll@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);    

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => $email,
            'password' => 'password',
        ]);

        // user buka halaman buat post baru
        $this->visit('/post/create');

        // user submit data baru        
        Storage::fake('images');
        $post = Post::create([
            'title' => 'Title for testing 1',
            'content' => 'This is a content for testing',
            'image' => UploadedFile::fake()->image('image.jpg'),     
            'user_id' => $user->id,       
            'category_id' => 1,
        ]);

        $post = Post::create([
            'title' => 'Title for testing 2',
            'content' => 'This is a content for testing',
            'image' => UploadedFile::fake()->image('image.jpg'),     
            'user_id' => $user->id,       
            'category_id' => 1,
        ]);

        // user buka halaman daftar post
        $this->visit('/post');

        // user melihat dua title dari data post
        $this->see('Title for testing 1');
        $this->see('Title for testing 2');
    }

    public function test_user_delete_post()
    {
        $user = User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'testdelete@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);    

        // Kunjungi halaman '/login'
        $this->visit('/login');

        // Submit form login dengan email dan password yang tepat
        $this->submitForm('Login', [
            'email'    => $email,
            'password' => 'password',
        ]);

        // user buka halaman buat post baru
        $this->visit('/post/create');

        // user submit data baru        
        Storage::fake('images');
        $post = Post::create([
            'title' => 'Title for testing 1',
            'content' => 'This is a content for testing',
            'image' => UploadedFile::fake()->image('image.jpg'),     
            'user_id' => $user->id,       
            'category_id' => 1,
        ]);

        // post delete request
        $this->post('/post/' . $post->id, [
            '_method' => 'DELETE'
        ]);

        // check data di table post
        $this->dontSeeInDatabase('posts', [
            'id' => $post->id
        ]);
    }

}
