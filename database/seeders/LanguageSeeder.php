<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('languages')->insert([
            ['name' => 'Английский', 'description' => 'Международный язык общения', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Немецкий', 'description' => 'Язык науки и технологий', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Испанский', 'description' => 'Один из самых распространенных языков', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Французский', 'description' => 'Язык искусства и дипломатии', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}