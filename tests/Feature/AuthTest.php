<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;


class AuthTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->json('POST', '/api/v1/register', [
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'test@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(201);
        
        // Delete users
        User::where('email',$email)->delete();
    }

    public function testLogin()
    {
        // Creating Users
        User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'testLogin@google.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // Simulated landing
        $response = $this->json('POST',route('apiLogin'),[
            'email' => $email,
            'password' => 'password',
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        // Determine whether the login is successful and receive token 
        $response->assertStatus(200);

        // Delete users
        User::where('email',$email)->delete();
    }

}
