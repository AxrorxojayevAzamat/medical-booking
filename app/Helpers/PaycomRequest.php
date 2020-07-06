<?php

namespace App\Helpers;

use App\Exceptions\PaycomException;

class PaycomRequest
{
    public $payload;
    public $id;
    public $method;
    public $params;
    public $amount;

    public function __construct()
    {
        $request_body  = file_get_contents('php://input');
        $this->payload = json_decode($request_body, true);

        if (!$this->payload) {
            throw new PaycomException(
                null,
                'Invalid JSON-RPC object.',
                PaycomException::ERROR_INVALID_JSON_RPC_OBJECT
            );
        }

        $this->id     = isset($this->payload['id']) ? (int)$this->payload['id'] : null;
        $this->method = isset($this->payload['method']) ? trim($this->payload['method']) : null;
        $this->params = isset($this->payload['params']) ? $this->payload['params'] : [];
        $this->amount = isset($this->payload['params']['amount']) ? 1 * $this->payload['params']['amount'] : null;

        $this->params['request_id'] = $this->id;
    }

    public function account($param)
    {
        return isset($this->params['account'], $this->params['account'][$param]) ? $this->params['account'][$param] : null;
    }
}
