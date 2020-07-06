<?php

namespace App\Exceptions;

class ClickException extends \Exception
{
    const ERROR_METHOD_NOT_FOUND = -32601;
    const ERROR_INVALID_JSON_RPC_OBJECT = -32600;
    const ERROR_INSUFFICIENT_PRIVILEGE = -32504;
    const ERROR_PAYMENT_IN_PROCESSING = -31300;
    const ERROR_INVALID_ACCOUNT = -31050;
    const ERROR_INTERNAL_SYSTEM = -32400;
    const ERROR_COULD_NOT_PERFORM = -31008;
    const ERROR_COULD_NOT_CANCEL = -31007;
    const ERROR_TRANSACTION_NOT_FOUND = -31003;
    const ERROR_INVALID_AMOUNT = -31001;

    const SIGN_CHECK_FAILED = -1;
    const INCORRECT_AMOUNT = -2;
    const ACTION_NOT_FOUND = -3;
    const ALREADY_PAID = -4;
    const USER_NOT_EXIST = -5;
    const TRANSACTION_NOT_EXIST = -6;
    const UPDATE_FAILED = -7;
    const REQUEST_ERROR = -8;
    const TRANSACTION_CANCELLED = -9;

    public $error;
    private $errorCode;
    private $clickCode;

    public function __construct($message, $code = 200, $errorCode = 0, $clickCode = 0)
    {
        $this->message = $message;
        $this->code = $code;
        $this->errorCode = $errorCode;
        $this->clickCode = $clickCode;

        $this->error = ['error_code' => $this->errorCode];

        if ($this->message) {
            $this->error['error_note'] = $this->message;
        }

        parent::__construct($message, $code);
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getClickCode()
    {
        return $this->clickCode;
    }
}
