<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class CourseObserver
{
    public function created(Course $course): void
    {
        Log::info("Создан курс #{$course->id}: {$course->title}");
    }

    public function updated(Course $course): void
    {
        $changes = json_encode($course->getChanges(), JSON_UNESCAPED_UNICODE);
        Log::info("Изменен курс #{$course->id}: {$changes}");
    }

    // Сброс кэша при сохранении (создании или обновлении) курса (Задание 5)
    public function saved(Course $course): void
    {
        Cache::forget('home.stats');
        Cache::forget('admin.stats');
    }

    public function deleting(Course $course): void
    {
        // Удаляем прикрепленный файл программы курса, если он есть
        if ($course->attachment && Storage::exists($course->attachment)) {
            Storage::delete($course->attachment);
        }
    }

    // Сброс кэша при удалении курса (Задание 5)
    public function deleted(Course $course): void
    {
        Cache::forget('home.stats');
        Cache::forget('admin.stats');
    }
}