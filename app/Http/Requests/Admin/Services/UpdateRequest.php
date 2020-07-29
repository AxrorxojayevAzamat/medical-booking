<?php

namespace App\Http\Requests\Admin\Services;

use App\Entity\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $name_uz
 * @property string $name_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property \Illuminate\Http\UploadedFile $image
 *
 * @property News $news
 */
class UpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_uz' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
