<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           'region_uz'=>'required|min:2|max:50|string',
           'region_ru'=>'required|min:2|max:50|string',

        ];
    }
}
