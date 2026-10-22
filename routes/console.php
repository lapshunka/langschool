<?php

use App\Models\Course;
use App\Models\Language;
use App\Models\User;
use App\Models\Booking;
use App\Jobs\GenerateCatalogPdf;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('catalog:stats', function () {
    $this->info('=== СТАТИСТИКА ЯЗЫКОВОЙ ШКОЛЫ ===');
    
    // 1. Статистика каталога (Языки и Курсы)
    $languagesCount = Language::count();
    $coursesCount = Course::count();
    $this->line("Языков в базе: <comment>{$languagesCount}</comment>");
    $this->line("Курсов в базе: <comment>{$coursesCount}</comment>");

    // Таблица «Язык — количество курсов»
    $languages = Language::withCount('courses')->get();
    $langRows = $languages->map(fn ($l) => [$l->name, $l->courses_count])->toArray();
    
    $this->info("\n--- Курсы по языкам ---");
    $this->table(['Язык', 'Количество курсов'], $langRows);

    // 2. Число пользователей по ролям
    $this->info("\n--- Пользователи по ролям ---");
    $roles = User::select('role', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
        ->groupBy('role')
        ->pluck('total', 'role')
        ->toArray();
    
    $roleRows = [];
    foreach ($roles as $role => $count) {
        $roleRows[] = [$role, $count];
    }
    $this->table(['Роль', 'Количество'], $roleRows);

    // 3. Число заявок по статусам
    $this->info("\n--- Заявки по статусам ---");
    $statuses = Booking::select('status', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status')
        ->toArray();
    
    $bookingRows = [];
    foreach ($statuses as $status => $count) {
        $bookingRows[] = [$status, $count];
    }
    $this->table(['Статус', 'Количество'], $bookingRows);

})->purpose('Выводит подробную статистику языков, курсов, пользователей и заявок');

// --- РАСПИСАНИЕ ЗАДАЧ (Задание 3) ---

// 1. Закрытие старых заявок ежедневно в 3:00 ночи
Schedule::command('bookings:close-old --days=7')
    ->dailyAt('03:00')
    ->withoutOverlapping();

// 2. Сбор статистики каждую минуту с записью в файл storage/logs/stats.log
Schedule::command('catalog:stats')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/stats.log'));

// 3. Генерация PDF-каталога для администратора по понедельникам в 8:00
Schedule::call(function () {
    $admin = User::where('role', 'admin')->first();
    if ($admin) {
        GenerateCatalogPdf::dispatch($admin);
    }
})->weeklyOn(1, '08:00');