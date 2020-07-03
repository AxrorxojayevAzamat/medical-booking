<?php


namespace App\Services\Book\Click;


use App\Entity\Click;
use App\Exceptions\ClickException;
use App\Helpers\ClickHelper;
use App\Helpers\PaymentTypes;
use App\Helpers\ResponseHelper;

class ShopClickService extends BaseService
{
    public function __construct(string $configName, $type)
    {
        parent::__construct($configName, $type);
    }

    public function createOrderProduct($amount, $stuffId, $accountId = null): Click
    {
        if (!$order = $this->clicks->findOrderByOrderNull($stuffId)) {
            $order = Click::create($amount, $this->type, $accountId, $stuffId);
            $this->clicks->save($order);
        }
        return $order;
    }

    public function performPayment(string $cardToken, int $uniqueId): Click
    {
        $payment = $this->clicks->findOrderByOrder($uniqueId);
        if ($payment->card_token !== $cardToken) {
            throw new ClickException('Incorrect card token', ResponseHelper::CODE_ERROR, ClickException::ERROR_COULD_NOT_PERFORM);
        }

        $response = $this->apis->performPayment([
            'service_id' => $this->config['service_id'],
            'card_token' => $cardToken,
            'amount' => (float)($payment->amount / 100),
            'transaction_parameter' => $payment->merchant_transaction_id,
        ]);

        return $this->baseMethod($response, $payment, function ($data, Click $payment): Click {
            if ((int)$data->error_code === 0) {
                if ($payment->type === PaymentTypes::TYPE_SHOP_REGISTERED) {
                   $payment = $this->pay($payment, ['payment_id' => $data->payment_id], $data->error_note);
                } else {
                    $payment->pay(null, ['payment_id' => $data->payment_id], $data->error_note);
                    $this->clicks->update($payment);
                }
            } else {
                $payment->setStatus(ClickHelper::ERROR, $data->error_note);
                $this->clicks->update($payment);
            }

            return $payment;
        });
    }
}
