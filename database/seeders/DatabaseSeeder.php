<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
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
    // 1. Тестовий користувач
    User::factory()->create([
        'name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
    ]);

    // 2. Створюємо основні категорії через цикл (автоматично генеруємо слаг)
    $categories = [
        'Фаст-фуд',
        'Піцца',
        'Суші',
        'Бургери',
        'Напої',
        'Десерти',
    ];

    foreach ($categories as $name) {
        Category::create([
            'name' => $name,
            'slug' => str($name)->slug(), // Це автоматично зробить "fast-fud" і т.д.
        ]);
    }
}
}
