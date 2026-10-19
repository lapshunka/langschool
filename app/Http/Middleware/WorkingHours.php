<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHours
{
    public function handle(Request $request, Closure $next, $start = 9, $end = 18): Response
    {
        $currentHour = (int) now()->format('G');

        // Если текущее время вне диапазона работы
        if ($currentHour < $start || $currentHour >= $end) {
            // Можно вернуть шаблон закрыто или ошибку
            return response()->view('closed', [], 403);
        }

        return $next($request);
    }
}