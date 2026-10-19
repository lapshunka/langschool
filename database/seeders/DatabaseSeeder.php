<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Language;
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
        // Вызываем сидеры для языков и реальных курсов из ЛР №4
        $this->call([
            LanguageSeeder::class,
            CourseSeeder::class,
        ]);

        // Добавляем 40 сгенерированных курсов через фабрику с recycle
        Course::factory(40)->recycle(Language::all())->create();

        // Тестовый пользователь (можно оставить)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@test.kz',
        'password' => 'password',
        'role' => 'admin',
    ]);

    \App\Models\User::factory()->create([
        'name' => 'Editor User',
        'email' => 'editor@test.kz',
        'password' => 'password',
        'role' => 'editor',
    ]);

    \App\Models\User::factory()->create([
        'name' => 'Regular User',
        'email' => 'user@test.kz',
        'password' => 'password',
        'role' => 'user',
    ]);
    }
}