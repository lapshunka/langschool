<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Проверяем права на редактирование конкретной записи курса через Policy
        return $this->user()->can('update', $this->route('course'));
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }

    public function rules(): array
    {
        return [
            // Игнорируем текущую запись при проверке уникальности имени
            'title' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('courses', 'title')->ignore($this->route('course'))
            ],
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