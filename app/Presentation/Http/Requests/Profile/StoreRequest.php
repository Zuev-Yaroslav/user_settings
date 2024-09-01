<?php

namespace App\Presentation\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreRequest extends FormRequest
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
            'user.login' => 'required|string|max:255|unique:users,login',
            'user.email' => 'required|string|max:255|unique:users,email',
            'user.password' => 'required|string|max:255|min:8|confirmed',
            'profile.first_name' => 'required|string|max:255',
            'profile.second_name' => 'required|string|max:255',
            'profile.third_name' => 'nullable|string|max:255',
            'profile.gender' => 'required|integer|between:1,2',
            'profile.birthed_at' => 'required|date_format:Y-m-d',
            'profile.about_me' => 'required|string',
        ];
    }
    protected function passedValidation()
    {
        $data = $this->validated();
        $data['password'] = Hash::make($data['password']);
        $this->replace($data);
    }
}
