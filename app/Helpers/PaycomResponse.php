<?php

namespace App\Helpers;

use App\Exceptions\PaycomException;
use Illuminate\Http\JsonResponse;

class PaycomResponse
{

    public function __construct(PaycomRequest $request)
    {
        $this->request = $request;
    }

    public function send($result, $error = null): JsonResponse
    {
        header('Content-Type: application/json; charset=UTF-8');

        $response['jsonrpc'] = '2.0';
        $response['id']      = $this->request->id;
        $response['result']  = $result;
        $response['error']   = $error;

        return response()->json($response);
    }

    public function error($code, $message = null, $data = null)
    {
        throw new PaycomException($this->request->id, $message, $code, $data);
    }
}
