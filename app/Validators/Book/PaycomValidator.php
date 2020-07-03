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
            'user_id' => 'required|numeric',
            'amount' => 'required|numeric',
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
            'account_id' => 'required|numeric',
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
