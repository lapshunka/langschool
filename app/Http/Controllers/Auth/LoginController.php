<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Пытаемся авторизовать пользователя с учетом чекбокса "Запомнить меня"[cite: 3]
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Возвращаем пользователя туда, куда он хотел зайти (intended)[cite: 3]
            return redirect()->intended(route('courses.index'));
        }

        // Общая ошибка безопасности (не говорим точно, что неверно — e-mail или пароль)[cite: 3]
        return back()
            ->withErrors(['email' => 'Неверный e-mail или пароль'])
            ->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('courses.index');
    }
}