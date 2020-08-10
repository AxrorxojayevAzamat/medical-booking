<?php

namespace App\Http\Requests\Admin\Specialization;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_uz' => 'required|min:2|max:100|string',
            'name_ru' => 'required|min:2|max:100|string',
        ];
    }

}
