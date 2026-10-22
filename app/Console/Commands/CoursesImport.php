<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Console\Command;

class CoursesImport extends Command
{
    protected $signature = 'courses:import {file : Путь к CSV файлу}';

    protected $description = 'Импортирует курсы из CSV-файла';

    public function handle(): int
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $filePath = base_path($filePath);
            if (!file_exists($filePath)) {
                $this->error("Файл не найден: {$this->argument('file')}");
                return self::FAILURE;
            }
        }

        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            $this->error("Не удалось открыть файл.");
            return self::FAILURE;
        }

        $added = 0;
        $skipped = 0;
        $rowNumber = 0;

        while (($data = fgetcsv($handle, 1000, ';')) !== false) {
            $rowNumber++;

            // Ожидаемый формат: название; описание; цена; длительность; id_языка
            if (count($data) < 5) {
                $this->warn("Строка {$rowNumber}: пропущена (неверный формат данных)");
                $skipped++;
                continue;
            }

            [$title, $description, $price, $duration, $languageId] = $data;

            // Проверяем существование языка
            if (!Language::where('id', trim($languageId))->exists()) {
                $this->warn("Строка {$rowNumber}: язык с ID {$languageId} не найден, курс '{$title}' пропущен.");
                $skipped++;
                continue;
            }

            try {
                Course::create([
                    'title'       => trim($title),
                    'description' => trim($description),
                    'price'       => (float) trim($price),
                    'duration'    => (int) trim($duration),
                    'language_id' => (int) trim($languageId),
                ]);
                $added++;
            } catch (\Throwable $e) {
                $this->warn("Строка {$rowNumber}: ошибка сохранения ({$e->getMessage()})");
                $skipped++;
            }
        }

        fclose($handle);

        $this->info("Импорт завершен. Добавлено: {$added}, пропущено: {$skipped}.");

        return self::SUCCESS;
    }
}