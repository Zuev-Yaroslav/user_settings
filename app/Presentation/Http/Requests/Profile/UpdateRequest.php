<?php

namespace App\Presentation\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
//            'login' => 'required|string|max:255|unique:users,login,' . $this->profile->id,
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'third_name' => 'nullable|string|max:255',
            'gender' => 'required|integer|between:1,2',
            'birthed_at' => 'required|date_format:Y-m-d',
            'about_me' => 'required|string',
        ];
    }
}
