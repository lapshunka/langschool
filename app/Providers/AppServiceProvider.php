<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Удалили проблемную строчку defaultView, так как Laravel использует Tailwind из коробки

        // Включаем защиту от ленивой загрузки (N+1) вне продакшна
        Model::preventLazyLoading(! app()->isProduction());

        // Включаем логирование SQL-запросов для счётчика в футере
        DB::enableQueryLog();
    }
}