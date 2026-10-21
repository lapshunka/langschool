<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey

{
    public function handle(Request $request, Closure $next): Response
    {
        $adminKey = config('app.admin_key');

        if (empty($adminKey)) {
            abort(403, 'Нужен ключ администратора');
        }

        if ($request->query('key') === $adminKey) {
            $request->session()->put('is_admin', true);
        }

        if (! $request->session()->get('is_admin')) {
            abort(403, 'Нужен ключ администратора');
        }

        return $next($request);
    }
}