<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::withCount('courses')->orderBy('name')->get();
        return LanguageResource::collection($languages);
    }

    public function courses(Language $language, Request $request)
    {
        $data = $request->validate([
            'per_page' => ['nullable', 'integer', 'between:1,50']
        ]);
        
        $perPage = $data['per_page'] ?? 10;
        
        $courses = $language->courses()
            ->with('language')
            ->paginate($perPage)
            ->withQueryString();

        return CourseResource::collection($courses);
    }
}