<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //[cite: 5]
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]); //[cite: 5]
    }

    public function rules(): array
    {
        return [
            // Игнорируем текущую запись при проверке уникальности имени[cite: 5]
            'title' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('courses', 'title')->ignore($this->route('course'))
            ],
            'language_id' => ['required', 'exists:languages,id'], //[cite: 5]
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'between:0,1000000'], //[cite: 5]
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
        ]; //[cite: 5]
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
        ]; //[cite: 5]
    }
}