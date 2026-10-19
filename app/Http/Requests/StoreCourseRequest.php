<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Проверяем права на создание курса через Policy
        return $this->user()->can('create', Course::class);
    }

    protected function prepareForValidation(): void
    {
        // Превращаем чекбокс в boolean (true/false), чтобы он корректно обрабатывался
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:courses,title'],
            'language_id' => ['required', 'exists:languages,id'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'between:0,1000000'],
            'duration' => ['required', 'integer', 'between:1,500'],
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
        ];
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
        ];
    }
}