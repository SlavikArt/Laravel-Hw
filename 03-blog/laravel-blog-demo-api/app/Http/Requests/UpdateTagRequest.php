<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:50|unique:tags,name,' . $this->tag->id,
            'description' => 'sometimes|nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Назва тегу має бути рядком.',
            'name.max' => 'Назва тегу не може перевищувати 50 символів.',
            'name.unique' => 'Тег з такою назвою вже існує.',
            
            'description.string' => 'Опис тегу має бути рядком.',
            'description.max' => 'Опис тегу не може перевищувати 255 символів.',
        ];
    }
}
