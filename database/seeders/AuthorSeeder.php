<?php

namespace Database\Seeders;

use App\Models\Author;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Stephen King',
            'Khaled Hosseini',
            'William Shakespeare',
            'Charles Dickens',
            'Henry James'
        ];

        foreach ($names as $name) {
            Author::create([
                'name' => $name,
                'slug' => SlugService::createSlug(Author::class, 'slug', $name),
                'biography' => Factory::create()->paragraph(5, true)
            ]);
        }

        
    }
}
