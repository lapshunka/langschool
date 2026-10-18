<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:languages,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле «:attribute» обязательно для заполнения.',
            'name.unique' => 'Язык с таким названием уже существует.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'название языка',
        ];
    }
}