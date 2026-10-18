<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
{
    // Белый список для сортировки
    $sort = in_array($request->sort, ['title', 'price', 'duration']) ? $request->sort : 'title';

    $items = Course::with('language')
        ->search($request->q)
        ->when($request->language, fn ($q, $l) => $q->where('language_id', $l))
        ->orderBy($sort)
        ->paginate(9) // По 9 курсов на страницу
        ->withQueryString(); // Сохраняет параметры ?q=... и ?language=... при переходе по страницам

    $languages = Language::withCount('courses')->orderBy('name')->get();

    return view('courses.index', compact('items', 'languages'));
}

    public function show(Course $course)
    {
        $relatedCourses = $course->language->courses()
            ->where('id', '!=', $course->id)
            ->take(3)
            ->get();

        return view('courses.show', compact('course', 'relatedCourses'));
    }
}