<?php


namespace App\Entity\Book\Payment;

use App\Exceptions\PaycomException;
use App\Helpers\Format;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $paycom_transaction_id
 * @property int $paycom_time
 * @property string $paycom_time_datetime
 * @property int $create_time
 * @property int $perform_time
 * @property int $cancel_time
 * @property int $amount
 * @property int $state
 * @property string $state_note
 * @property int $order_state
 * @property int $reason
 * @property string $receivers
 * @property int $order_id
 *
 * @property PaycomOrder $order
 * @mixin Eloquent
 */
class PaycomTransaction extends Model
{
    const TIMEOUT = 43200000;

    const STATE_CREATED = 1;
    const STATE_COMPLETED = 2;
    const STATE_CANCELLED = -1;
    const STATE_CANCELLED_AFTER_COMPLETE = -2;

    const REASON_RECEIVERS_NOT_FOUND = 1;
    const REASON_PROCESSING_EXECUTION_FAILED = 2;
    const REASON_EXECUTION_FAILED = 3;
    const REASON_CANCELLED_BY_TIMEOUT = 4;
    const REASON_FUND_RETURNED = 5;
    const REASON_UNKNOWN = 10;

    public $request_id;

    protected $table = 'paycom_transactions';

    public $timestamps = false;

    protected $fillable = ['paycom_transaction_id', 'paycom_time', 'paycom_time_datetime', 'create_time', 'perform_time',
        'cancel_time', 'amount', 'state', 'state_note', 'reason', 'receivers', 'order_id',
    ];

    public function pay($perform_time): void
    {
        $this->state = self::STATE_COMPLETED;
        $this->perform_time = Format::timestamp2datetime($perform_time);
    }

    public function cancel($reason): void
    {
        $this->cancel_time = Format::timestamp2datetime(Format::timestamp());;

        if ($this->state === self::STATE_COMPLETED) {
            $this->state = self::STATE_CANCELLED_AFTER_COMPLETE;
        } else {
            $this->state = self::STATE_CANCELLED;
        }

        $this->reason = $reason;
    }

    public function isCreated(): bool
    {
        return $this->state !== PaycomTransaction::STATE_CREATED;
    }

    public function isExpired(): bool
    {
        return ($this->state == self::STATE_CREATED) && abs(strtotime($this->create_time) - time()) > self::TIMEOUT;
    }

    ######################################################################################### Relations

    public function order()
    {
        return $this->belongsTo(PaycomOrder::class, 'order_id', 'id');
    }

    #########################################################################################


    ######################################################################################### Validations

    public function validateAccount(int $requestId, array $params): void
    {
        if (!isset($params['id']) || $params['id'] !== $this->paycom_transaction_id) {
            throw new PaycomException(
                $requestId,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'id'
            );
        }
    }

    public function checkAvailable(int $requestId): void
    {
        if ($this->state == PaycomTransaction::STATE_CREATED || $this->state == PaycomTransaction::STATE_COMPLETED) {
            throw new PaycomException(
                $requestId,
                'There is other active/completed transaction for this order.',
                PaycomException::ERROR_COULD_NOT_PERFORM
            );
        }
    }

    public function checkPaycomTransaction(int $requestId, array $params)
    {
        if ($this->paycom_transaction_id !== $params['id']) {
            throw new PaycomException(
                $requestId,
                'There is other active/completed transaction for this order.',
                PaycomException::ERROR_COULD_NOT_PERFORM
            );
        }
        return true;
    }

    #########################################################################################
}
