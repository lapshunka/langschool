<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Загружаем заявки пользователя вместе с курсами
        $bookings = $user->bookings()->with('course')->latest()->get();

        // Получаем все уведомления пользователя
        $notifications = $user->notifications;

        return view('profile', compact('user', 'bookings', 'notifications'));
    }
}