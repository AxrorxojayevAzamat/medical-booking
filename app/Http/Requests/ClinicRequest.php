<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name_uz
 * @property string $name_ru
 * @property string $address_uz
 * @property string $address_ru
 * @property string $work_time_start
 * @property string $work_time_end
 * @property string $location
 * @property int[] $services
 */
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
            'address_uz'=>'required|min:2|max:200|string',
            'address_ru'=>'required|min:2|max:200|string',
            'work_time_start' => 'required|string',
            'work_time_end' => 'required|string',
            'location'=>'required|min:2|max:50|string',
            'services.*' => 'required|numeric|min:1|exists:services,id',
        ];
    }
}
