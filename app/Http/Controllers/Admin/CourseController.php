<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        $items = Course::with('language')->latest()->paginate(15);
        return view('admin.courses.index', compact('items'));
    }

    public function create()
    {
        $languages = Language::orderBy('name')->get();
        return view('admin.courses.create', compact('languages'));
    }

    public function store(StoreCourseRequest $request)
    {
        // Используем проверенные данные из Form Request
        Course::create($request->validated());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курс успешно добавлен!');
    }

    public function edit(Course $course)
    {
        $languages = Language::orderBy('name')->get();
        return view('admin.courses.edit', compact('course', 'languages'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        // Используем проверенные данные из Form Request
        $course->update($request->validated());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Изменения сохранены!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return back()->with('success', 'Курс удален!');
    }
}