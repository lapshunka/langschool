<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
            ['language_id' => 1, 'title' => 'Английский для начинающих', 'description' => 'Базовый курс с нуля до уверенного общения.', 'price' => 45000.00, 'is_active' => true, 'duration' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 1, 'title' => 'Деловой английский', 'description' => 'Для работы в международных компаниях.', 'price' => 75000.00, 'is_active' => true, 'duration' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 2, 'title' => 'Немецкий разговорный', 'description' => 'Живая практика языка для путешествий.', 'price' => 50000.00, 'is_active' => true, 'duration' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 3, 'title' => 'Испанский интенсив', 'description' => 'Погружение в языковую среду в кратчайшие сроки.', 'price' => 60000.00, 'is_active' => true, 'duration' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 4, 'title' => 'Французский для детей', 'description' => 'Увлекательное изучение в игровой форме.', 'price' => 40000.00, 'is_active' => true, 'duration' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 1, 'title' => 'Английский разговорный клуб', 'description' => 'Практикуем произношение и снимаем языковой барьер.', 'price' => 30000.00, 'is_active' => true, 'duration' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 2, 'title' => 'Грамматика немецкого языка', 'description' => 'Разбор сложных правил простым языком.', 'price' => 45000.00, 'is_active' => true, 'duration' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 3, 'title' => 'Испанский для начинающих', 'description' => 'Старт для тех, кто хочет заговорить с первых уроков.', 'price' => 48000.00, 'is_active' => true, 'duration' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 4, 'title' => 'Французский продвинутый', 'description' => 'Совершенствуем лексику и грамматику.', 'price' => 70000.00, 'is_active' => true, 'duration' => 35, 'created_at' => now(), 'updated_at' => now()],
            ['language_id' => 1, 'title' => 'Подготовка к IELTS', 'description' => 'Интенсивный курс для сдачи экзамена на высокий балл.', 'price' => 90000.00, 'is_active' => true, 'duration' => 40, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}