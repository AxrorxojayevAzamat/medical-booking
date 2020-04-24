<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CelebrationRequest extends FormRequest
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
            'date'=>'required|date',
            'celebration_name'=>'required|min:2|max:20|string',
            'quantity'=>'required|min:1|max:10|int',
        ];
    }
}
