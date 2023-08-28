<?php

namespace Database\Seeders;

use App\Models\Genre;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'cosmic',
            'horror',
            'fiction',
            'romance',
            'biography'
        ];

        foreach ($names as $name) {
            Genre::create([
                'name' => $name,
                'slug' => SlugService::createSlug(Genre::class, 'slug', $name)
            ]);
        }
    }
}
