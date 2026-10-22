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
            // Передаем переменные $from и $to в шаблон closed
            return response()->view('closed', [
                'from' => sprintf('%02d:00', $start),
                'to' => sprintf('%02d:00', $end),
            ], 403);
        }

        return $next($request);
    }
}