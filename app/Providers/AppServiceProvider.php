<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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