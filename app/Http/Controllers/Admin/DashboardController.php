<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Language;
use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Кэширование статистики администратора на 5 минут (Задание 4)[cite: 4]
        $stats = Cache::remember('admin.stats', now()->addMinutes(5), function () {
            return [
                'coursesCount'   => Course::count(),
                'languagesCount' => Language::count(),
                'bookingsCount'  => Booking::count(),
            ];
        });

        return view('admin.dashboard', compact('stats'));
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('home');
    }
}