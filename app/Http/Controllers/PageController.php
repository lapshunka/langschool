<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home()
    {
        // Кэширование данных главной страницы на 10 минут (Задание 4)
        $data = Cache::remember('home.stats', now()->addMinutes(10), function () {
            return [
                'coursesCount'  => Course::count(),
                'languages'     => Language::withCount('courses')->orderBy('name')->get(),
                'latestCourses' => Course::with('language')->latest()->take(6)->get(),
            ];
        });

        return view('home', $data);
    }

    public function about()
    {
        return view('about', [
            'fio' => 'Сулейменов Камал',
            'group' => '3ПОВТ-24Б'            
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'address' => 'г. Костанай, ул. Байтурсынова, 47',
            'phone' => '+7 (7142) 55-00-00',
            'email' => 'info@langschool.kz'
        ]);
    }

    public function rules()
    {
        return view('rules');
    }
}