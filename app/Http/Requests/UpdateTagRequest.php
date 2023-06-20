<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:100',
        ];
    }

    public function messages()
    {
        return [

            'title.required' => 'Обязательно для заполнения',
            'title.string' => 'Должно быть строкой',
            'title.min' => 'Минимум 3 символа',
            'title.max' => 'Максимум 100 символов',

        ];
    }
}
