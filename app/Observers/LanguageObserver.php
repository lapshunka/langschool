<?php

namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class LanguageObserver
{
    public function saved(Language $language): void
    {
        // Сбрасываем меню языков, главную страницу и админку при изменении языка
        Cache::forget('languages.menu');
        Cache::forget('home.stats');
        Cache::forget('admin.stats');
    }

    public function deleted(Language $language): void
    {
        Cache::forget('languages.menu');
        Cache::forget('home.stats');
        Cache::forget('admin.stats');
    }
}