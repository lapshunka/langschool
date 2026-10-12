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

Route::get('/courses/{id}', function (string $id) {
    return view('course', ['id' => $id]);
})->whereNumber('id')->name('courses.show');