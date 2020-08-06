<?php


namespace App\Entity\Book\Payment;

use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Exceptions\PaycomException;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $book_id
 * @property int $amount
 * @property int $state
 * @property boolean $locked
 * @property int $created_at
 *
 * @property Book $book
 * @property PaycomTransaction $paycom
 * @mixin Eloquent
 */
class PaycomOrder extends Model
{
    const STATE_AVAILABLE = 0;
    const STATE_WAITING_PAY = 1;
    const STATE_PAY_ACCEPTED = 2;
    const STATE_CANCELLED = 3;

    const UNLOCKED = 0;
    const LOCKED = 1;

    protected $table = 'paycom_orders';

    protected $fillable = ['book_id', 'amount', 'locked', 'state', 'created_at'];

    public $timestamps = false;

    public function cancel(): void
    {
        $this->state = self::STATE_CANCELLED;
    }

    public function pay(): void
    {
        $this->state = self::STATE_PAY_ACCEPTED;
    }

    public function lock()
    {
        $this->locked = self::LOCKED;
    }

    public function unlock()
    {
        $this->locked = self::UNLOCKED;
    }

    public function allowCancel()
    {
        return false; // do not allow cancellation
    }

    public static function stateList(): array
    {
        return [
            self::STATE_AVAILABLE => 'Создан',
            self::STATE_WAITING_PAY => 'В ожидании платежа',
            self::STATE_PAY_ACCEPTED => 'Оплачен',
            self::STATE_CANCELLED => 'Отменён',
        ];
    }

    ######################################################################################### Relations

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function paycom()
    {
        return $this->hasOne(PaycomTransaction::class, 'order_id', 'id');
    }

    #########################################################################################


    ######################################################################################### Validations

    public function validate(string $request_id, array $params, array $config): bool
    {
        $this->validateAccount($request_id, $params, $config['account']);

        $this->validateAmount($request_id, $params['amount']);

        $this->validateState($request_id);

        return true;
    }

    private function validateAccount(string $request_id, array $params, string $account)
    {
        if (!isset($params['account'][$account]) || !$params['account'][$account]) {
            throw new PaycomException(
                $request_id,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                $account
            );
        }
    }

    private function validateAmount(int $request_id, int $amount): void
    {
        if (!is_numeric($amount)) {
            throw new PaycomException(
                $request_id,
                'Incorrect amount.',
                PaycomException::ERROR_INVALID_AMOUNT
            );
        }

        if (($this->amount * 100) !== ($amount)) {
            throw new PaycomException(
                $request_id,
                'Incorrect amount.',
                PaycomException::ERROR_INVALID_AMOUNT
            );
        }
    }

    public function validateState(int $request_id): void
    {
        if ($this->state !== self::STATE_WAITING_PAY) {
            throw new PaycomException(
                $request_id,
                'Order state is invalid.',
                PaycomException::ERROR_COULD_NOT_PERFORM
            );
        }
    }

    #########################################################################################
}
