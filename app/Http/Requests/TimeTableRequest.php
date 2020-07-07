<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeTableRequest extends FormRequest
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

    public function rules()
    {
        return [
            'schedule_type'=>'required|in:1,2|numeric',
            
            'monday_start'=>'nullable|date_format:H:i',
            'monday_end'=>'nullable|date_format:H:i|after:monday_start',

            'tuesday_start'=>'nullable|date_format:H:i',
            'tuesday_end'=>'nullable|date_format:H:i|after:tuesday_start',
            
            'wednesday_start'=>'nullable|date_format:H:i',
            'wednesday_end'=>'nullable|date_format:H:i|after:wednesday_start',

            'thursday_start'=>'nullable|date_format:H:i',
            'thursday_end'=>'nullable|date_format:H:i|after:thursday_start',

            'friday_start'=>'nullable|date_format:H:i',
            'friday_end'=>'nullable|date_format:H:i|after:friday_start',

            'saturday_start'=>'nullable|date_format:H:i',
            'saturday_end'=>'nullable|date_format:H:i|after:saturday_start',

            'sunday_start'=>'nullable|date_format:H:i',
            'sunday_end'=>'nullable|date_format:H:i|after:sunday_start',

            'lunch_start'=>'nullable|date_format:H:i',
            'lunch_end'=>'nullable|date_format:H:i|after:lunch_start',

            'odd_start'=>'nullable|date_format:H:i',
            'odd_end'=>'nullable|date_format:H:i|after:odd_start',

            'even_start'=>'nullable|date_format:H:i',
            'even_end'=>'nullable|date_format:H:i|after:even_start',

            'day_off_start'=>'nullable|date_format:Y-m-d',
            'day_off_end'=>'nullable|date_format:Y-m-d|after:day_off_start'
        ];
    }
}
