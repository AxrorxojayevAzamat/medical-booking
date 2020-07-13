<?php


namespace App\Validators\Book;


use App\Validators\BaseValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaycomValidator extends BaseValidator
{

    public function authorizePaycom(Request $request): bool
    {
        if (!$request->hasHeader('X-Auth') || $request->header('X-Auth') != config('paycom_config.merchant_id')) {
            throw new \Exception(trans('Wrong credentials.'));
        }
        return true;
    }

    /**
     * @param Request $request
     *
     * @throws ValidationException
     */
    public function validateOrderCreate(Request $request): void
    {
        $this->validate($request, [
            'doctor_id' => 'required|numeric|exists:users,id',
            'clinic_id' => 'required|numeric|exists:clinics,id',
            'amount' => 'required|numeric|min:1000|max:9999999',
            'booking_date' => 'required|date_format:"Y-m-d"',
            'time_start' => 'required|date_format:"H:i"',
            'description' => 'required|string|max:255',
        ]);
    }

    /**
     * @param Request $request
     *
     * @throws ValidationException
     */
    public function validateReceiptPerform(Request $request): void
    {
        $this->validate($request, [
            'order_id' => 'required|numeric',
            'token' => 'required|string',
        ]);
    }

    public function validateAmount($amount): void
    {
        if ($amount < 1000 || $amount > 9999999) {
            throw new \Exception('Amount is wrong.');
        }
    }
}
