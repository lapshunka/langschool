<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LanguageController as AdminLanguageController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Storage;

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

// --- КАТАЛОГ И СПЕЦИФИЧНЫЕ МАРШРУТЫ КУРСОВ ---
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// 📄 Маршрут генерации PDF (ОБЯЗАТЕЛЬНО выше чем /courses/{course})
Route::get('/courses/pdf', [CourseController::class, 'pdf'])->name('courses.pdf');

// Защищенный маршрут скачивания файла программы курса (Задание 4 из ЛР8)
Route::get('/courses/{course}/attachment', [CourseController::class, 'downloadAttachment'])
    ->name('courses.attachment')
    ->middleware('auth');

// Временный маршрут предпросмотра письма (ЛР9, Задание 4 — после проверки удалить)
Route::get('/mail-preview', function () {
    $booking = \App\Models\Booking::latest()->first();
    if (!$booking) {
        return 'Сначала создайте хотя бы одну заявку через сайт!';
    }
    return new \App\Mail\BookingReceived($booking);
});

// Заявка на пробный урок (ЛР9, Задание 2)
Route::post('/courses/{course}/bookings', [CourseController::class, 'storeBooking'])
    ->name('courses.bookings.store')
    ->middleware('auth');

// Детальная страница курса (с параметром — должна идти ниже статических путей вроде /pdf)
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Страница конкретного языка
Route::get('/languages/{language}', [LanguageController::class, 'show'])->name('languages.show');

Route::redirect('/main', '/');

Route::view('/booking', 'booking')->middleware('hours:9,18')->name('booking');

// Страница профиля со списком заявок пользователя (ЛР9, Задание 2)
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

// Админ-панель (защищена аутентификацией и Gate admin-panel)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('courses', AdminCourseController::class)->except('show');
    Route::resource('languages', AdminLanguageController::class)->except('show');

    // Управление заявками и уведомлениями (ЛР9, Задание 5)
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/read', [AdminNotificationController::class, 'markAsRead'])->name('notifications.read');

    // Фоновый PDF-каталог и скачивание (ЛР10, Задание 4)
    Route::post('/exports/generate', function (Illuminate\Http\Request $request) {
        \App\Jobs\GenerateCatalogPdf::dispatch($request->user());
        return back()->with('success', 'Каталог формируется, вы получите уведомление.');
    })->name('exports.generate');

    Route::get('/exports/{file}', function (string $file) {
        $path = "exports/{$file}";
        if (!Storage::exists($path)) {
            abort(404, 'Файл каталога не найден.');
        }
        return Storage::download($path);
    })->name('exports.download');
});