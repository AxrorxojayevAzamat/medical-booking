<?php

namespace App\Services\Book\Click;

use App\Services\ApiService;
use App\Repository\ClickRepository;
use Psr\Http\Message\ResponseInterface;

class ClickApiService
{
    private $apis;
    private $config;
    private $repository;
    private $baseUrl;

    public function __construct(string $configName, $headers = [])
    {
        $this->repository = new ClickRepository();
        $this->config = config($configName);

        $time = time();
        $this->baseUrl = $this->config['endpoint'];
        $this->apis = new ApiService(array_merge([
            'Auth' => ($this->config['user_id'] . ':' . sha1($time . $this->config['secret_key']) . ':' . $time),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache',
        ], $headers));
    }

    public function getMerchantTransactionId($token)
    {
        $payment = $this->repository->findByToken($token);
        $payment->merchant_transaction_id = $payment->id;
        $this->repository->update($payment);
        return $payment->id;
    }

    public function createInvoice(array $data)
    {
        return $this->apis->request('POST', 'invoice/create', ['json' => $data]);
    }

    public function checkInvoice(array $data)
    {
        return $this->apis->request('GET', 'invoice/status/' . $data['service_id'] . '/' . $data['invoice_id']);
    }

    public function createCardToken(array $data)
    {
        return $this->apis->request('POST', 'card_token/request', ['json' => $data]);
    }

    public function verifyCardToken(array $data)
    {
        return $this->apis->request('POST', 'card_token/verify', ['json' => $data]);
    }

    public function performPayment(array $data)
    {
        return $this->apis->request('POST', 'card_token/payment', ['json' => $data]);
    }

    public function deleteCardToken(string $cardToken)
    {
        return  $this->apis->request('DELETE', 'card_token/' . $this->config['service_id'] . '/' . $cardToken);
    }

    public function checkPayment(int $paymentId)
    {
        return $this->apis->request('GET', 'payment/status/' . $this->config['service_id'] . '/' . $paymentId);
    }

    public function checkPaymentStatus(int $merchantTransactionId)
    {
        return  $this->apis->request('DELETE', 'payment/status_by_mti/' . $this->config['service_id'] . '/' . $merchantTransactionId);
    }

    public function onCanceling(int $paymentId): ResponseInterface
    {
        return $this->apis->request('DELETE', 'payment/reversal/' . $this->config['service_id'] . '/' . $paymentId);
    }

    public function isResponseSuccessful(ResponseInterface $response)
    {
        return $response->getStatusCode() === 200;
    }
}
