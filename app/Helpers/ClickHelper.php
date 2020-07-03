<?php

namespace App\Helpers;

class ClickHelper
{
    const INPUT = 1;
    const WAITING = 2;
    const PREAUTH = 3;
    const CONFIRMED = 4;
    const REJECTED = 5;
    const REFUNDED = 6;
    const ERROR = 7;

    public static function statusNameList(): array
    {
        return [
            self::INPUT => 'input',
            self::WAITING => 'waiting',
            self::PREAUTH => 'preauth',
            self::CONFIRMED => 'confirmed',
            self::REJECTED => 'rejected',
            self::REFUNDED => 'refunded',
            self::ERROR => 'error',
        ];
    }

    public static function getStatusName($status)
    {
        return self::statusNameList()[$status];
    }

    public static function statusCodeList(): array
    {
        return [
            'input' => self::INPUT,
            'waiting' => self::WAITING,
            'preauth' => self::PREAUTH,
            'confirmed' => self::CONFIRMED,
            'rejected' => self::REJECTED,
            'refunded' => self::REFUNDED,
            'error' => self::ERROR,
        ];
    }

    public static function getStatusCode($statusName)
    {
        return self::statusCodeList()[$statusName];
    }

    public static function getCardNumber($cardNumber)
    {
        if (preg_match('/[0-9]{12}/', $cardNumber)) {
            return $cardNumber;
        }
        if (preg_match('/[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/', $cardNumber)) {
            $cardNumber = explode('-', $cardNumber);
            $cardNumber = implode('', $cardNumber);
            return $cardNumber;
        }
        return null;
    }

    public static function getPhoneNumber($phoneNumber)
    {
        if (strlen($phoneNumber) != 0 && $phoneNumber[0] == '+') {
            $phoneNumber = substr($phoneNumber, 1, strlen($phoneNumber));
            if (preg_match('/[0-9]{12}/', $phoneNumber)) {
                return $phoneNumber;
            }
            return null;
        }
        if (preg_match('/[0-9]{12}/', $phoneNumber)) {
            return $phoneNumber;
        }
        if (preg_match('/[0-9]{9}/', $phoneNumber)) {
            return '998' . $phoneNumber;
        }
        if (preg_match('/[0-9]{8}/', $phoneNumber)) {
            return '9989' . $phoneNumber;
        }
        return null;
    }
}
