<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12'],
            'bith_date' => ['required', 'date'],
            'gender' => ['required', 'integer','min:0', 'max:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],            
            'password' => ['required', 'string', 'min:2', 'confirmed'], 
            'role' => 'required|exists:roles,id',
        ];
    }
}
