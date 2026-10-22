<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\LanguageController;

Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    Route::get('/ping', fn () => response()->json([
        'status' => 'ок', 
        'time' => now()->toIso8601String()
    ], 200, [], JSON_UNESCAPED_UNICODE));

    // Задание 4: Статистика и случайный курс (обязательно выше apiResource!)
    Route::get('/stats', [CourseController::class, 'stats'])->name('stats');
    Route::get('/courses/random', [CourseController::class, 'random'])->name('courses.random');

    // Основные ресурсы курсов
    Route::apiResource('courses', CourseController::class)->only(['index', 'show']);

    // Языки
    Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
    Route::get('/languages/{language}/courses', [LanguageController::class, 'courses'])->name('languages.courses');
});