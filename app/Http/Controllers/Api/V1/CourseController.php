<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'q'        => ['nullable', 'string', 'max:100'],
            'language' => ['nullable', 'integer', 'exists:languages,id'],
            'sort'     => ['nullable', 'in:title,-title,price,-price,duration,-duration'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $sort   = $data['sort'] ?? 'title';
        $courses = Course::with('language')
            ->search($data['q'] ?? null)
            ->when($data['language'] ?? null, fn ($q, $l) => $q->where('language_id', $l))
            ->orderBy(ltrim($sort, '-'), str_starts_with($sort, '-') ? 'desc' : 'asc')
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return CourseResource::collection($courses);
    }

    public function show(Course $course)
    {
        return new CourseResource($course->load('language'));
    }

    public function stats()
    {
        // Кэшируем статистику на 5 минут
        $stats = Cache::remember('api.courses.stats', now()->addMinutes(5), function () {
            return [
                'total_courses' => Course::count(),
                'courses_by_language' => Language::withCount('courses')->get()->mapWithKeys(function ($lang) {
                    return [$lang->name => $lang->courses_count];
                }),
                'last_added_at' => Course::latest()->value('created_at')?->toIso8601String(),
            ];
        });

        return response()->json($stats, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function random()
    {
        $course = Course::with('language')->inRandomOrder()->first();

        if (!$course) {
            return response()->json(['message' => 'Запись не найдена'], 404);
        }

        return new CourseResource($course);
    }
}