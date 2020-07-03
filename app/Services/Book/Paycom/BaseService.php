<?php


namespace App\Services\Book\Paycom;


use App\Entity\PaycomOrder;
use App\Entity\PaycomTransaction;
use App\Helpers\Format;
use App\Repository\AccountRepository;
use App\Repository\PaycomOrderRepository;
use App\Repository\PaycomTransactionRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\ResponseInterface;

abstract class BaseService
{
    protected $client;
    protected $transactions;
    protected $orders;
    protected $accounts;
    protected $config;
    protected $type;

    public function __construct(string $configName, $type = null)
    {
        $this->config = config($configName);
        $this->type = $type;
        if ($this->config['keyFile']) {
            $this->config['key'] = trim(file_get_contents($this->config['keyFile']));
        }

        $this->transactions = new PaycomTransactionRepository();
        $this->orders = new PaycomOrderRepository();
        $this->accounts = new AccountRepository();


        $headers = [
            'X-Auth' => $this->config['merchant_id'] . ':' . $this->config['key'],
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ];
        $this->client = new Client([
            'headers' => $headers
        ]);
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

    public function createReceipt(array $accounts, int $amount, array $extraAccount = [], array $detail = null)
    {
        $mainAccount = $this->checkMainAccount($accounts);
        $additionalAccount = $this->checkAdditionalAccount($accounts);
        $accountParams = array_merge([$mainAccount => $accounts[$mainAccount]], $additionalAccount ? [$additionalAccount => $accounts[$additionalAccount]] : []);

        return $this->getPostRequestData('receipts.create', array_merge([
            'amount' => (int)$amount,
            'account' => array_merge($accountParams, $extraAccount),
        ], $detail ? ['detail' => $detail] : []));
    }

    public function checkRequestReceiptsCreate($data): void
    {
        if (isset($data->error) && $data->error) {
            throw new \DomainException(trans($data->error->message));
        }
    }

    public function createPaycomTransaction($data): PaycomTransaction
    {
        $create_time = Format::timestamp(true);
        $transaction = PaycomTransaction::create(
            $data->result->receipt->_id,
            $data->result->receipt->create_time,
            $create_time,
            $data->result->receipt->amount,
            $data->result->receipt->account[0]->value
        );
        $transaction->request_id = $data->id;
        $this->transactions->save($transaction);
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
        $this->orders->save($order);
    }

    public function unlockOrder(PaycomOrder $order): void
    {
        $order->unlock();
        $this->orders->save($order);
    }

    public function saveTransaction(PaycomTransaction $transaction): void
    {
        $this->transactions->save($transaction);
    }

    public function saveOrder(PaycomOrder $order): void
    {
        $this->orders->save($order);
    }

    public function checkOrder($id): ?PaycomOrder
    {
        try {
            return $this->orders->find($id);
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
        DB::beginTransaction();
        try {
            $transaction = $this->transactions->findByUsername($paycomId);
            $order = $this->orders->find($transaction->order_id);
            $this->transactions->remove($transaction);
            $this->orders->remove($order);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
