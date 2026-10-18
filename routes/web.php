<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LanguageController; // <--- не забываем подключить контроллер языков
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');

Route::get('/hello/{name}', function (string $name) {
    return 'Здравствуйте, ' . $name . '! Добро пожаловать в Языковую школу.';
});

// Каталог курсов
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// Детальная страница курса (привязка модели через {course})
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Страница конкретного языка (Задание 4)
Route::get('/languages/{language}', [LanguageController::class, 'show'])->name('languages.show');

Route::redirect('/main', '/');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('courses', AdminCourseController::class)->except('show');
    
    // Указываем полный класс с namespace для языков
    Route::resource('languages', App\Http\Controllers\Admin\LanguageController::class)->except('show');

    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
});