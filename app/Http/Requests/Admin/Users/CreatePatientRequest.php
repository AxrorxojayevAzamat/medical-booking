<?php

namespace App\Http\Requests\Admin\Users;

use App\Entity\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'regex:/^\d{9}$/'],
            'email' => 'required|string|email|max:255|unique:users',
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'integer', 'min:0', 'max:1']
        ];
    }
}
