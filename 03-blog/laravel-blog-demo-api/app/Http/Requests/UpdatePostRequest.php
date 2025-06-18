<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|ulid|exists:users,id',
            'slug' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->post),
            ],
            'title' => 'sometimes|string|max:128',
            'content' => 'sometimes|string',
            'is_publish' => 'sometimes|boolean',
            'image' => 'nullable|string|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'ulid|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.ulid' => 'Поле user_id має бути дійсним ULID.',
            'user_id.exists' => 'Користувача з таким user_id не знайдено.',

            'slug.string' => 'Поле slug має бути рядком.',
            'slug.max' => 'Поле slug не може перевищувати 255 символів.',
            'slug.unique' => 'Такий slug уже зайнятий, виберіть інший.',

            'title.string' => 'Заголовок має бути рядком.',
            'title.max' => 'Заголовок не може перевищувати 128 символів.',

            'content.string' => 'Вміст має бути рядком.',

            'is_publish.boolean' => 'Поле is_publish має бути true або false.',

            'image.string' => 'Поле image має бути рядком.',
            'image.max' => 'URL зображення не може перевищувати 2048 символів.',

            'tags.array' => 'Поле tags має бути масивом.',

            'tags.*.ulid' => 'Кожен тег має бути дійсним ULID.',
            'tags.*.exists' => 'Один або більше тегів не знайдено в базі даних.',
        ];
    }
}
