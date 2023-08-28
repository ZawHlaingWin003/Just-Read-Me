<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'David',
            'email' => 'david@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\User::create([
            'name' => 'User One',
            'email' => 'user1@gmail.com',
            'password' => 'password'
        ]);

        $this->call([
            AuthorSeeder::class,
            GenreSeeder::class
        ]);
    }
}