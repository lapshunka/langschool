<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $levels = ['для начинающих', 'для продолжающих', 'Разговорный интенсив', 'Деловой', 'Интенсивный', 'Академический'];
        $topics = ['с нуля', 'для путешествий', 'с носителем языка', 'для работы и карьеры', 'продвинутый уровень'];

        return [
            'language_id' => Language::factory(),
            'title' => fake()->randomElement($levels) . ' ' . fake()->randomElement($topics),
            'description' => 'Увлекательный курс, который поможет быстро преодолеть языковой барьер и заговорить свободно.',
            'price' => fake()->randomFloat(2, 30000, 120000),
            'is_active' => fake()->boolean(85),
            'duration' => fake()->numberBetween(10, 45),
        ];
    }
}