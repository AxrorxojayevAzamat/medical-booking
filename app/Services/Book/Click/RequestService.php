<?php

namespace App\Services\Book\Click;

use App\Exceptions\ClickException;
use App\Helpers\ClickHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class RequestService
{
    public function payment(Request $request)
    {
        if (empty($request->post())) {
            throw new ClickException('Incorrect JSON-RPC object', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_INVALID_JSON_RPC_OBJECT
            );
        }

        if ($result = $this->checkAction($request)) {
            return $result;
        }

        if ($result = $this->checkPhoneNumber($request)) {
            return $result;
        }

        if ($result = $this->checkCardNumber($request)) {
            return $result;
        }

        if ($result = $this->checkSmsCode($request)) {
            return $result;
        }

        if ($result = $this->checkCardToken($request)) {
            return $result;
        }

        if ($result = $this->checkDeleteCardToken($request)) {
            return $result;
        }

        if ($result = $this->checkInvoiceId($request)) {
            return $result;
        }

        if ($result = $this->checkPaymentId($request)) {
            return $result;
        }

        if ($result = $this->checkMerchantTransactionId($request)) {
            return $result;
        }

        if ($result = $this->checkCancelPaymentId($request)) {
            return $result;
        }

        return null;
    }

    private function checkAction(Request $request)
    {
        if (!$this->isEmpty($request, 'action')) {
            return null;
        }

        $request->type = 'complete';

        if ((int)$request->action === 0) {
            $request->type = 'prepare';
        }

        return $request;
    }

    private function checkPhoneNumber(Request $request)
    {
        $attribute = 'phone_number';
        if (!$this->isEmpty($request, $attribute)) {
            if ($phone_number = ClickHelper::getPhoneNumber($request->$attribute)) {
                if (isset($request->token) && $request->token != null) {
                    return [
                        'type' => $attribute,
                        'token' => (int)$request->token,
                        $attribute => $phone_number
                    ];
                }
                throw new ClickException('Could not make a payment without payment_id or token', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_COULD_NOT_PERFORM
                );
            }
            throw new ClickException('Incorrect phone number', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_COULD_NOT_PERFORM
            );
        }
        return null;
    }

    private function checkCardNumber(Request $request)
    {
        $attribute = 'card_number';
        if (isset($request->$attribute) && $request->$attribute != null) {
            if ($card_number = ClickHelper::getCardNumber($request->$attribute)) {
                if (isset($request->token) && $request->token !== null) {
                    return [
                        'type' => $attribute,
                        'token' => (int)$request->token,
                        $attribute => $card_number,
                        'expire_date' => $request->expire_date,
                        'temporary' => $request->temporary ?? 1,
                    ];
                }

                throw new ClickException('Could not make a payment without token', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_COULD_NOT_PERFORM
                );
            }

            throw new ClickException('Incorrect card number', ResponseHelper::CODE_VALIDATION_ERROR, ClickException::ERROR_COULD_NOT_PERFORM
            );
        }

        return null;
    }

    private function checkSmsCode(Request $request)
    {
        return $this->checkGeneralLong($request, 'sms_code', 'sms_code');
    }

    private function checkCardToken(Request $request)
    {
        return $this->checkGeneralLong($request, 'card_token', 'card_token');
    }

    private function checkDeleteCardToken(Request $request)
    {
        return $this->checkGeneralLong($request, 'delete_card_token', 'card_token');
    }

    private function checkInvoiceId(Request $request)
    {
        return $this->checkGeneralLong($request, 'check_invoice_id', 'invoice_id');
    }

    private function checkPaymentId(Request $request)
    {
        return $this->checkGeneralShort($request, 'payment_id', 'check_payment', 'payment_id');
    }

    private function checkMerchantTransactionId(Request $request)
    {
        return $this->checkGeneralLong($request, 'merchant_trans_id', 'merchant_trans_id');
    }

    private function checkCancelPaymentId(Request $request)
    {
        return $this->checkGeneralShort($request, 'cancel_payment_id', 'cancel', 'payment_id');
    }

    private function checkGeneralLong(Request $request, $attribute, $responseAttribute)
    {
        if (isset($request->$attribute) && $request->$attribute !== null) {
            if (isset($request->token) && $request->token !== null) {
                return [
                    'type' => $attribute,
                    'token' => (int)$request->token,
                    $responseAttribute => $request->$attribute,
                ];
            }

            throw new ClickException('Could not make a payment without payment_id or token', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM
            );
        }

        return null;
    }

    private function checkGeneralShort(Request $request, $requestAttribute, $type, $responseAttribute)
    {
        if (isset($request->$requestAttribute) && $request->$requestAttribute !== null) {
            return [
                'type' => $type,
                $responseAttribute => $request->$requestAttribute
            ];
        }

        return null;
    }

    public function isEmpty($request, $attribute)
    {
        return isset($request->$attribute) && $request->$attribute !== null;
    }
}
