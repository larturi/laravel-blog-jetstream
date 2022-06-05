<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crea la carpeta posts para guardar las imagenes
        Storage::makeDirectory('public/posts');
        // Crea los usuarios
        $this->call(UserSeeder::class);
        // Crea las categorias   
        Category::factory(4)->create();
        // Crea los tags
        Tag::factory(8)->create();
        // Crea los posts
        $this->call(PostSeeder::class);
    }
}
