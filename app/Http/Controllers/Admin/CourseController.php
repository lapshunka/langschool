<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        // Если файл обложки передан, сохраняем его в storage/app/public/covers
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Если файл вложения (PDF) передан, сохраняем его в storage/app/attachments
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        Course::create($data + ['user_id' => $request->user()->id]);

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
        $data = $request->validated();

        // Если загружена новая картинка
        if ($request->hasFile('cover')) {
            if ($course->cover) {
                Storage::disk('public')->delete($course->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } 
        elseif ($request->boolean('remove_cover')) {
            if ($course->cover) {
                Storage::disk('public')->delete($course->cover);
            }
            $data['cover'] = null;
        }

        // Если загружен новый PDF-файл
        if ($request->hasFile('attachment')) {
            if ($course->attachment) {
                Storage::delete($course->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        } 
        elseif ($request->boolean('remove_attachment')) {
            if ($course->attachment) {
                Storage::delete($course->attachment);
            }
            $data['attachment'] = null;
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Изменения сохранены!');
    }

    public function destroy(Course $course)
    {
        Gate::authorize('delete', $course);

        // Удаление файлов делегировано наблюдателю CourseObserver (Задание 2)
        $course->delete();

        return back()->with('success', 'Курс удален!');
    }
}