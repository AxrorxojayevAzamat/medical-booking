<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $site_url
 * @property string $sort
 * @property string $status
 * @property \Illuminate\Http\UploadedFile $photo
 */
class PartnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'site_url' => 'required|string|max:255',
            'status' => 'required|int',
            'photo' => 'image|mimes:jpg,jpeg,png',
        ];
    }
}
