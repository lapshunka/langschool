<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Английский', 'Немецкий', 'Испанский', 'Французский', 'Итальянский', 'Китайский', 'Японский']),
            'description' => fake()->realText(100),
        ];
    }
}