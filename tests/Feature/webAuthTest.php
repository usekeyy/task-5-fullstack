<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\WebTestCase;
use App\Models\User;
use Illuminate\Support\Str;

class webAuthTest extends WebTestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::create([
            'name'  =>  $name = 'Test',
            'email'  =>  $email = time().'test@google.com',
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

        // Lihat halaman ter-redirect ke url '/home' (login sukses).
        $this->seePageIs('/post');
        
    }
}

