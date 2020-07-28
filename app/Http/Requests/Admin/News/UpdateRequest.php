<?php

namespace App\Http\Requests\Admin\News;

use App\Entity\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $title_uz
 * @property string $title_ru
 * @property string $menu_title_uz
 * @property string $menu_title_ru
 * @property string $description_uz
 * @property string $description_ru
 * @property string $content_uz
 * @property string $content_ru
 * @property int $status
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
            'title_uz' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'menu_title_uz' => 'required|string|max:255',
            'menu_title_ru' => 'required|string|max:255',
            'description_uz' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'content_uz' => 'nullable|string',
            'content_ru' => 'nullable|string',
            'status' => ['required', 'numeric', Rule::in(array_keys(News::getStatusList()))],
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
}
