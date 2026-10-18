<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;

class LanguageController extends Controller
{
    public function index()
    {
        // Подсчитываем количество курсов для каждого языка через withCount
        $items = Language::withCount('courses')->orderBy('name')->paginate(15);
        return view('admin.languages.index', compact('items'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        Language::create($request->validated());

        return redirect()->route('admin.languages.index')
            ->with('success', 'Язык успешно добавлен!');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $language->update($request->validated());

        return redirect()->route('admin.languages.index')
            ->with('success', 'Изменения сохранены!');
    }

    public function destroy(Language $language)
    {
        // Защита от удаления, если к языку привязаны курсы (Задание 6)
        if ($language->courses()->exists()) {
            return back()->with('error', 'Нельзя удалить: есть связанные записи (курсы)!');
        }

        $language->delete();

        return back()->with('success', 'Язык успешно удален!');
    }
}