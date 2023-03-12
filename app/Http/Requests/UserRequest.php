<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'domain_id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|alpha_dash',
            'image' => 'file|nullable',
            'description' => 'string|nullable',
            'user_id' => 'integer|nullable',
            'h1' => 'string|nullable',
            'title' => 'string|nullable',
            'meta_description' => 'string|nullable',
            'is_show' => 'boolean',
            'parent_id' => 'nullable|integer|exists:App\Models\Tag,id',
        ];
    }

    public function messages()
    {
        return [
            'domain_id.required' => 'Поле обязательно для заполнения',
            'name.required' => 'Поле обязательно для заполнения',
            'slug.required' => 'Поле обязательно для заполнения',
        ];
    }
}
