<?php


namespace App\Helpers;


class ResponseHelper
{
    const CODE_SUCCESS = 200;
    const CODE_ERROR = 400;
    const CODE_ERROR_AUTHORIZATION = 401;
    const CODE_PAGE_NOT_EXIST = 404;
    const CODE_VALIDATION_ERROR = 422;

    public static function toArray($message = '', $data = []): array
    {
        return [
            'message' => $message,
            'data' => $data,
        ];
    }
}
