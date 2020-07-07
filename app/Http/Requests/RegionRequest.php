<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name_uz
 * @property string $name_ru
 * @property int[] $parents
 */
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
            'parents.*' => 'nullable|numeric|min:1|exists:regions,id',
        ];
    }
}
