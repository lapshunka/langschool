<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
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

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])
    ->whereNumber('id')
    ->name('courses.show');

Route::redirect('/main', '/');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('courses.create');

    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
});