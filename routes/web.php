<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');

Route::get('/hello/{name}', function (string $name) {
    return 'Здравствуйте, ' . $name . '! Добро пожаловать в Языковую школу.';
});

// Каталог курсов
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// Детальная страница курса
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Страница конкретного языка
Route::get('/languages/{language}', [LanguageController::class, 'show'])->name('languages.show');

Route::redirect('/main', '/');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

// Админ-панель (защищена аутентификацией и Gate admin-panel)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('courses', AdminCourseController::class)->except('show');
    Route::resource('languages', AdminLanguageController::class)->except('show');
});