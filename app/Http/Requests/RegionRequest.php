<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
           'name_uz'=>'required|string|min:2|max:50',
           'name_ru'=>'required|string|min:2|max:50',

        ];
    }
}
