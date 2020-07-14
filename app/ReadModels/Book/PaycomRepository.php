<?php


namespace App\ReadModels\Book;


use App\Entity\Book\Payment\PaycomOrder;
use App\Entity\Book\Payment\PaycomTransaction;
use App\Exceptions\PaycomException;
use App\Helpers\Format;

class PaycomRepository
{
    private $request_id;

    public function __construct($request_id = null)
    {
        $this->request_id = $request_id;
    }

    public function find($id): PaycomOrder
    {
        if (!$id || !$order = PaycomOrder::where('id', $id)->first()) {
            throw new \DomainException('Paycom order is not found.');
        }
        return $order;
    }

    public function findOrder($id): PaycomOrder
    {
        if (!$order = PaycomOrder::where('id', $id)->first()) {
            throw new PaycomException(
                $this->request_id,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'order_id'
            );
        }
        return $order;
    }

    public function findOrderByOrderId(int $orderId): PaycomOrder
    {
        if (!$order = PaycomOrder::where('id', $orderId)->orderBy('created_at', 'desc')->first()) {
            throw new PaycomException(
                $this->request_id,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'order_id'
            );
        }
        return $order;
    }

    public function findTransaction($transId): PaycomTransaction
    {
        if (!$transId || !$paycom = PaycomTransaction::where('paycom_transaction_id', $transId)->first()) {
            throw new PaycomException(
                $this->request_id,
                'Transaction not found.',
                PaycomException::ERROR_TRANSACTION_NOT_FOUND);
        }
        return $paycom;
    }

    public function report($from, $to)
    {
        $from_date = Format::timestamp2datetime($from);
        $to_date   = Format::timestamp2datetime($to);

        return PaycomTransaction::whereBetween('paycom_time_datetime', [$from_date, $to_date])->orderBy('paycom_time_datetime')->get();
    }
}
