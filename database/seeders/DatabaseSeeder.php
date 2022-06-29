<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();


         \App\Models\User::factory()->create([
             'name' => 'Hein Htet Zan',
             'email' => 'hhz@gmail.com',
             "password" => Hash::make('asdffdsa')
         ]);





        $this->call([
            CategorySeeder::class,
            PostSeeder::class
        ]);



    }
}
