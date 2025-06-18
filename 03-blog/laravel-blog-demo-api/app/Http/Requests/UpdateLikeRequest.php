<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLikeRequest extends FormRequest
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
            'user_id' => 'sometimes|ulid|exists:users,id',
            'post_id' => 'sometimes|ulid|exists:posts,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.ulid' => 'Поле user_id має бути дійсним ULID.',
            'user_id.exists' => 'Користувача з таким user_id не знайдено.',
            
            'post_id.ulid' => 'Поле post_id має бути дійсним ULID.',
            'post_id.exists' => 'Поста з таким post_id не знайдено.',
        ];
    }
}
