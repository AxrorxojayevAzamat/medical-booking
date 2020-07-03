<?php


namespace App\Validators\Book;


use App\Entity\Book\Payment\Click;
use App\Helpers\ResponseHelper;
use App\Exceptions\ClickException;
use App\Helpers\ClickHelper;
use App\Validators\BaseValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClickValidator extends BaseValidator
{
    const SIGN = -1;
    const AMOUNT = -2;
    const ACTION = -3;
    const ALREADY_PAID = -4;
    const USER_NOT_FOUND = -5;
    const TRANSACTION_NOT_FOUND = -6;
    const UPDATE_FAILED = -7;
    const REQUEST_ERROR = -8;
    const TRANSACTION_CANCELLED = -9;
    private $config;

    public function __construct($configName)
    {
        $this->config = config($configName);
    }

    public function validateAuth(Request $request)
    {
        if ($this->config['merchant_id'] . $this->config['service_id'] . $this->config['user_id'] !== $request->header('X-Auth')) {
            throw new ClickException('Authorization error', ResponseHelper::CODE_ERROR_AUTHORIZATION);
        }
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validateOrderCreate(Request $request): void
    {
        $this->validate($request, [
            'account_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validateCreateToken(Request $request): void
    {
        $this->validate($request, [
            'account_id' => 'required|numeric|min:1',
            'card_token' => 'required|string|max:255',
            'expire_date' => 'required|string|max:255',
            'temporary' => 'boolean',
        ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validateVerifyToken(Request $request): void
    {
        $this->validate($request, [
            'account_id' => 'required|numeric|min:1',
            'card_token' => 'required|string|max:255',
            'sms_code' => 'required|numeric',
        ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validatePerformPayment(Request $request): void
    {
        $this->validate($request, [
            'account_id' => 'required|numeric|min:1',
            'card_token' => 'required|string|max:255',
        ]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validateCheckPayment(Request $request): void
    {
        $this->validate($request, [
            'account_id' => 'required|numeric|min:1',
        ]);
    }

    public function validateAmount(Request $request): void
    {
        if ($request->amount < 1000 || $request->amount > 9999999) {
            throw new \Exception('Amount is wrong.');
        }
    }


    ##################################################################################### For Merchant API

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function validateBasic(Request $request): void
    {
        $this->validate($request, [
            'click_trans_id' => 'required|numeric|min:1',
            'service_id' => 'required|numeric|min:1',
            'click_paydoc_id' => 'required|numeric|min:1',
            'merchant_trans_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'action' => 'required|numeric',
            'error' => 'required|numeric',
            'error_note' => 'required|string',
            'sign_time' => 'required|date_format:Y-m-d H:i:s',
            'sign_string' => 'required|string',
            'merchant_prepare_id' => 'numeric|min:1'
        ]);
    }

    /**
     * @param Request $request
     * @throws ClickException
     */
    public function requestCheck(Request $request): void
    {
        $this->hasPrepareId($request);
        $this->checkSignString($request);
        $this->validateAction($request);
    }

    /**
     * @param Request $request
     * @param Click $payment
     * @return void
     * @throws ClickException
     */
    public function checkPayment(Request $request, Click $payment): void
    {
        $this->validateOrderPrepareId($request, $payment);
        $this->validateAlreadyPaid($payment);
        $this->validateAmounts($request, $payment);
        $this->validateCancelled($payment);
    }

    private function hasPrepareId(Request $request): void
    {
        if ($request['action'] == 1 && !isset($request['merchant_prepare_id'])) {
            throw new ClickException('Error in request from click', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::REQUEST_ERROR);
        }
    }

    private function checkSignString(Request $request): void
    {
        $sign_string = md5(
            $request->click_trans_id .
            $request->service_id .
            $this->config['secret_key'] .
            $request->merchant_trans_id .
            ($request->action == 1 ? $request->merchant_prepare_id : '') .
            $request->amount .
            $request->action .
            $request->sign_time
        );

        if ($sign_string !== $request->sign_string) {
            throw new ClickException('SIGN CHECK FAILED!', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::SIGN);
        }
    }

    private function validateAction(Request $request): void
    {
        if ((int)$request->action !== 0 && (int)$request->action !== 1) {
            throw new ClickException('Action not found', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::ACTION);
        }
    }

    private function validateOrderPrepareId(Request $request, Click $payment): void
    {
        if ($request->action == 1 && $payment->id !== $request->merchant_prepare_id) {
            throw new ClickException('Transaction does not exist', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::TRANSACTION_NOT_FOUND);
        }
    }

    private function validateAlreadyPaid(Click $payment): void
    {
        if ($payment->status == ClickHelper::getStatusName(ClickHelper::CONFIRMED)) {
            throw new ClickException('Already paid', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::ALREADY_PAID);
        }
    }

    private function validateAmounts(Request $request, Click $payment): void
    {
        if (abs((float)($payment->amount / 100) - (float)$request->amount) > 0.01) {
            throw new ClickException('Incorrect parameter amount', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::AMOUNT);
        }
    }

    private function validateCancelled(Click $payment): void
    {
        if ($payment->status == ClickHelper::getStatusName(ClickHelper::REJECTED)) {
            throw new ClickException('Transaction cancelled', ResponseHelper::CODE_VALIDATION_ERROR, 0, self::TRANSACTION_CANCELLED);
        }
    }
}
