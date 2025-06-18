<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'user_id' => 'required|ulid|exists:users,id',
            'post_id' => 'required|ulid|exists:posts,id',
            'content' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Поле user_id є обов\'язковим для заповнення.',
            'user_id.ulid' => 'Поле user_id має бути дійсним ULID.',
            'user_id.exists' => 'Користувача з таким user_id не знайдено.',
            
            'post_id.required' => 'Поле post_id є обов\'язковим для заповнення.',
            'post_id.ulid' => 'Поле post_id має бути дійсним ULID.',
            'post_id.exists' => 'Поста з таким post_id не знайдено.',
            
            'content.required' => 'Вміст коментаря є обов\'язковим для заповнення.',
            'content.string' => 'Вміст коментаря має бути рядком.',
            'content.max' => 'Вміст коментаря не може перевищувати 1000 символів.',
        ];
    }
}
