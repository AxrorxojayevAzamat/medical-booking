<?php

namespace App\Http\Requests\Admin;

use App\Entity\Clinic\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $type
 * @property string $value
 */
class ClinicContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'numeric', Rule::in(array_keys(Contact::getTypeList()))],
            'value' => 'required|string|max:255',
        ];
    }
}
