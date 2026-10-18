<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function show(Language $language)
    {
        // Получаем все курсы, принадлежащие данному языку
        $courses = $language->courses()->get();

        return view('languages.show', compact('language', 'courses'));
    }
}