<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Course::class);
    }

    protected function prepareForValidation(): void
    {
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
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'attachment' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // <--- ДОБАВЛЕНО
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
            'attachment.mimes' => 'Файл программы должен быть формата PDF.',
            'attachment.max' => 'Размер PDF-файла не должен превышать 10 МБ.',
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
            'cover' => 'обложка',
            'attachment' => 'программа курса (PDF)', // <--- ДОБАВЛЕНО
        ];
    }
}