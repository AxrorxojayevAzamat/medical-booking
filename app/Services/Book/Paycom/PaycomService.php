<?php

namespace App\Services\Book\Paycom;

use App\Entity\Book\Payment\PaycomOrder;
use App\Entity\Book\Payment\PaycomTransaction;
use App\Entity\User\User;
use App\Helpers\Format;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\ResponseInterface;

class PaycomService
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->config = config('paycom_config');
        if ($this->config['keyFile']) {
            $this->config['key'] = trim(file_get_contents($this->config['keyFile']));
        }

        $headers = [
            'X-Auth' => $this->config['merchant_id'] . ':' . $this->config['key'],
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ];
        $this->client = new Client([
            'headers' => $headers
        ]);
    }

    public function createBookOrder($bookId, $amount): PaycomOrder  // TODO add book
    {


        $order = PaycomOrder::create([
            'book_id' => $bookId,
            'amount' => $amount,
            'state' => PaycomOrder::STATE_WAITING_PAY,
            'locked' => PaycomOrder::UNLOCKED,
            'created_at' => time(),
        ]);

        return $order;
    }

    public function checkCard($token): void
    {
        $data = $this->getPostRequestData('cards.check', ['token' => $token]);
        if (isset($data->error) && $data->error) {
            throw new \DomainException($data->error->message);
        }
        if (!$data->result->card->verify) {
            throw new \DomainException(trans('Card is not verified.'));
        }
    }

    public function createReceipt(int $orderId, int $amount)
    {
        return $this->getPostRequestData('receipts.create', [
            'amount' => (int)$amount,
            'account' => [
                $this->config['account'] => $orderId,
            ],
        ]);
    }

    public function checkRequestReceiptsCreate($data): void
    {
        if (isset($data->error) && $data->error) {
            throw new \DomainException(trans($data->error->message));
        }
    }

    public function createPaycomTransaction($data): PaycomTransaction
    {
        $createTime = Format::timestamp(true);
        $paycomTime = $data->result->receipt->create_time;
        $transaction = PaycomTransaction::make([
            'paycom_transaction_id' => $data->result->receipt->_id,
            'paycom_time' => $paycomTime,
            'paycom_time_datetime' => Format::timestamp2datetime($paycomTime),
            'create_time' => Format::timestamp2datetime($createTime),
            'amount' => $data->result->receipt->amount,
            'order_id' => $data->result->receipt->account[0]->value,
            'state' => PaycomTransaction::STATE_CREATED,
        ]);
        $transaction->request_id = $data->id;
        $transaction->save();
        return $transaction;
    }

    public function payReceipt($receiptId, $token)
    {
        $data = $this->getPostRequestData('receipts.pay', [
            'id' => $receiptId,
            'token' => $token,
        ]);
        $this->checkRequestReceiptPay($data);

        return $data;
    }

    private function checkRequestReceiptPay($data): void
    {
        if (isset($data->error) && $data->error) {
            throw new \DomainException(trans($data->error->message));
        }

        if (!isset($data->result->receipt->pay_time) || empty($data->result->receipt->pay_time)) {
            throw new \DomainException('Internal errors.');
        }
    }

    public function cardsRemove($token)
    {
        $data = $this->getPostRequestData('cards.remove', ['token' => $token]);
        if (!$data->result->success) {
            throw new \Exception('Could not delete card token.');
        }
    }

    protected function getPostRequestData(string $method, array $params)
    {
        $response = $this->postRequest(str_random(10), $method, $params);
        return json_decode($response->getBody());
    }

    protected function postRequest($id, $method, $params): ResponseInterface
    {
        return $this->client->post($this->config['paycom_endpoint'], [
            'json' => [
                'id' => $id,
                'method' => $method,
                'params' => $params,
            ],
        ]);
    }

    public function lockOrder(PaycomOrder $order): void
    {
        $order->lock();
        $order->save();
    }

    public function unlockOrder(PaycomOrder $order): void
    {
        $order->unlock();
        $order->save();
    }

    public function checkOrder($id): ?PaycomOrder
    {
        try {
            return PaycomOrder::find($id);
        } catch (\DomainException $e) {
            return null;
        }
    }

    private function checkMainAccount(array $account): string
    {
        if (!array_key_exists($mainAccount = $this->config['accounts'], $account)) {
            throw new \DomainException('Wrong credentials.');
        }
        return $mainAccount;
    }

    private function checkAdditionalAccount(array $account): ?string
    {
        if (isset($this->config['additional_account'])) {
            if (!array_key_exists($this->config['additional_account'], $account)) {
                throw new \DomainException('Wrong credentials.');
            }
            return $this->config['additional_account'];
        }
        return null;
    }

    public function removePaycom($paycomId)
    {
        $transaction = PaycomTransaction::where('paycom_transaction_id', $paycomId)->first();
        $order = PaycomOrder::find($transaction->order_id);
        DB::beginTransaction();
        try {
            $transaction->delete();
            $order->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function findActiveUser($userId): User
    {
        return User::where('id', $userId)->active()->first();
    }
}
