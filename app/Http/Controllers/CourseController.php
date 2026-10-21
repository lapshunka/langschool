<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function downloadAttachment(Course $course)
    {
        // Проверяем, прикреплен ли файл к курсу и существует ли он на диске
        if (!$course->attachment || !Storage::exists($course->attachment)) {
            abort(404, 'Файл программы не найден.');
        }

        return Storage::download($course->attachment);
    }

    public function pdf(Request $request)
    {
        // Получаем отфильтрованный список курсов для PDF
        $courses = Course::with('language')
            ->search($request->q)
            ->when($request->language, fn ($q, $l) => $q->where('language_id', $l))
            ->orderBy('title')
            ->get();

        $pdf = Pdf::loadView('pdf.catalog', compact('courses'))
            ->setPaper('a4');

        return $pdf->download('courses-catalog-' . now()->format('Y-m-d') . '.pdf');
    }
}