<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Language;
use App\Observers\CourseObserver;
use App\Observers\LanguageObserver;
use App\Contracts\SmsSender;
use App\Services\Sms\LogSmsSender;
use App\Services\Sms\NullSmsSender;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Привязка интерфейса SmsSender в сервис-контейнере (Задание 3)
        $this->app->singleton(SmsSender::class, function () {
            return match (config('services.sms.driver')) {
                'log'   => new LogSmsSender(),
                default => new NullSmsSender(),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрация наблюдателей моделей (Задание 5)
        Course::observe(CourseObserver::class);
        Language::observe(LanguageObserver::class);

        // Определяем Gate для доступа в админ-панель (доступно для admin и editor)
        Gate::define('admin-panel', function (User $user) {
            return in_array($user->role, ['admin', 'editor']);
        });

        // Включаем защиту от ленивой загрузки (N+1) вне продакшна
        Model::preventLazyLoading(! app()->isProduction());

        // Включаем логирование SQL-запросов для счётчика в футере
        DB::enableQueryLog();
    }
}