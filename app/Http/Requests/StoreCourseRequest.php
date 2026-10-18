<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешаем выполнение запроса
    }

    protected function prepareForValidation(): void
    {
        // Превращаем чекбокс в boolean (true/false), чтобы он корректно обрабатывался[cite: 5]
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:courses,title'], // уникальное название[cite: 5]
            'language_id' => ['required', 'exists:languages,id'], // проверка существования языка[cite: 5]
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'between:0,1000000'], // диапазон цены[cite: 5]
            'duration' => ['required', 'integer', 'between:1,500'], // диапазон длительности
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле «:attribute» обязательно для заполнения.',
            'title.unique' => 'Курс с таким названием уже существует в базе.',
            'language_id.exists' => 'Выбранный язык обучения не найден.',
            'price.between' => 'Цена должна находиться в диапазоне от :min до :max ₸.',
            'duration.between' => 'Длительность должна составлять от :min до :max часов.',
        ]; // Русские сообщения (минимум 5 штук)[cite: 5]
    }

    public function attributes(): array
    {
        return [
            'title' => 'название',
            'language_id' => 'язык',
            'description' => 'описание',
            'price' => 'цена',
            'duration' => 'длительность',
            'is_active' => 'активность',
        ]; // Человеческие названия полей[cite: 5]
    }
}