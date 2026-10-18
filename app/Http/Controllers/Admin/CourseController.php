<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Получаем все курсы вместе с языками через Eloquent-модель
        $items = Course::with('language')->orderBy('title')->get();

        return view('admin.index', compact('items'));
    }

    public function create()
    {
        return view('admin.create');
    }
}