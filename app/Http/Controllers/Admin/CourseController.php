<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index()
    {
        $items = Course::with(['language', 'user'])->latest()->paginate(15);
        return view('admin.courses.index', compact('items'));
    }

    public function create()
    {
        Gate::authorize('create', Course::class);

        $languages = Language::orderBy('name')->get();
        return view('admin.courses.create', compact('languages'));
    }

    public function store(StoreCourseRequest $request)
    {
        // Создаем курс и привязываем автора (user_id)
        Course::create($request->validated() + ['user_id' => $request->user()->id]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курс успешно добавлен!');
    }

    public function edit(Course $course)
    {
        Gate::authorize('update', $course);

        $languages = Language::orderBy('name')->get();
        return view('admin.courses.edit', compact('course', 'languages'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        // Авторизация проверяется автоматически в UpdateCourseRequest через Policy
        $course->update($request->validated());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Изменения сохранены!');
    }

    public function destroy(Course $course)
    {
        Gate::authorize('delete', $course);

        $course->delete();

        return back()->with('success', 'Курс удален!');
    }
}