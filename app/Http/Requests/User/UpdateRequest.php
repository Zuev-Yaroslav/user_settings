<?php

namespace App\Http\Requests\User;

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
//            'email' => 'nullable|string|email|max:255|unique:users,' . $this->user->id,
            'login' => 'nullable|string|max:255|unique:users,login,' . $this->user->id,
//            'tg_username' => 'nullable|string|max:255|unique:users,tg_username,' . $this->user->id,
//            'phone_number' => 'nullable|string|max:255|unique:users,phone_number,' . $this->user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
