<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        $user = \App\Models\User::find(1);
        $user->name = "Yusqi";
        $user->email = "yusqi@gmail.com";
        $user->save();

        $user = new \App\Models\Categories;
        $user->name = "News";
        $user->user_id = 1;
        $user->save();
    }
}
