<?php

namespace Database\Seeders;

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
    $cat1 = \App\Models\Category::create(['name' => 'Фантастика']);
    $cat2 = \App\Models\Category::create(['name' => 'Детектив']);
    $cat3 = \App\Models\Category::create(['name' => 'Класика']);
    \App\Models\Book::create([
        'title' => 'Розум вбивці',
        'author' => 'Майк Омер',
        'price' => 220,
        'category_id' => $cat2->id,
        'cover' => '/images/book1.jpg'
    ]);
    \App\Models\Book::create([
        'title' => 'Дюна',
        'author' => 'Френк Герберт',
        'price' => 350,
        'category_id' => $cat1->id, // Фантастика
        'cover' => '/images/book4.jpg'
    ]);
    \App\Models\Book::create([
    'Title' => 'Розум вбивці',
    'DailyRentPrice' => 220,
    'Cover' => 'book1.jpg', // Тільки назва файлу
    'GenreID' => 2, // Ваш ID для жанру Детектив
    'PublicationYear' => 2018,
    'CopiesAvailable' => 5,
    'CollateralValue' => 450
    ]);
    \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
}
}
