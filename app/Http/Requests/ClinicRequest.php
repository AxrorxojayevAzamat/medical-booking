<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_uz'=>'required|min:2|max:100|string',
            'name_ru'=>'required|min:2|max:100|string',
            'phone_numbers'=>'required|min:2|max:20|string',
            'adress_uz'=>'required|min:2|max:200|string',
            'adress_ru'=>'required|min:2|max:200|string',
            'work_time_start' => 'required|string',
            'work_time_end' => 'required|string',
            'location'=>'required|min:2|max:50|string',
        ];
    }
}
