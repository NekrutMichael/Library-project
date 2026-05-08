<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cat1 = Category::create(['name' => 'Фантастика']);
        $cat2 = Category::create(['name' => 'Детектив']);
        $cat3 = Category::create(['name' => 'Класика']);

        Book::create([
            'title' => 'Розум вбивці',
            'author' => 'Майк Омер',
            'price' => 220,
            'category_id' => $cat2->id,
            'cover' => '/images/book1.jpg',
        ]);

        Book::create([
            'title' => 'Дюна',
            'author' => 'Френк Герберт',
            'price' => 350,
            'category_id' => $cat1->id,
            'cover' => '/images/book4.jpg',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
        ]);
    }
}


