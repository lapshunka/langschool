<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'fio' => 'Сулейменов Камал',
        'group' => '3ПОВТ-24Б'             
    ]);
})->name('about');

Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Костанай, ул. Байтурсынова, 47',
        'phone' => '+7 (7142) 55-00-00',
        'email' => 'info@langschool.kz'
    ]);
})->name('contacts');

Route::get('/hello/{name}', function (string $name) {
    return 'Здравствуйте, ' . $name . '! Добро пожаловать в Языковую школу.';
});

Route::get('/courses', function () {
    return view('courses.index', ['items' => config('catalog.items')]);
})->name('courses.index');

Route::get('/courses/{id}', function (int $id) {
    $item = config("catalog.items.$id");
    if (! $item) {
        abort(404);
    }
    return view('courses.show', ['id' => $id, 'item' => $item]);
})->whereNumber('id')->name('courses.show');

Route::view('/rules', 'rules')->name('rules');

Route::redirect('/main', '/');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

Route::prefix('admin')->name('admin.')->middleware('admin.key')->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');

    Route::get('/courses', function () {
        return view('admin.index', ['items' => config('catalog.items')]);
    })->name('courses');

    Route::view('/courses/create', 'admin.create')->name('courses.create');

    Route::get('/logout', function () {
        session()->forget('is_admin');
        return redirect()->route('home');
    })->name('logout');
});