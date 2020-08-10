<?php

namespace App\Http\Requests\Admin\Celebration;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'date' => 'required|date',
            'quantity' => 'required|min:1|max:10|int',
        ];
    }

}
