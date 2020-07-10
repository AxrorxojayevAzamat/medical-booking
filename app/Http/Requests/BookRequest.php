<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $doctor_id
 * @property int $clinic_id
 * @property int $amount
 * @property string $booking_date
 * @property string $time_start
 * @property string $description
 */
class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => 'required|numeric|exists:users,id',
            'clinic_id' => 'required|numeric|exists:clinics,id',
            'amount' => 'required|numeric|min:1',
            'booking_date' => 'required|date_format:"Y-m-d"',
            'time_start' => 'required|date_format:"H:i"',
            'description' => 'required|string|max:255',
        ];
    }
}
