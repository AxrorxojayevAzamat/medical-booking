<?php


namespace App\Entity\Book\Payment;

use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Helpers\ClickHelper;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $book_id
 * @property string $merchant_transaction_id
 * @property int $click_transaction_id
 * @property int $click_paydoc_id
 * @property int $amount
 * @property int $type
 * @property string $token
 * @property string $card_token
 * @property int $invoice_id
 * @property int $payment_id
 * @property string $sign_time
 * @property int $status
 * @property string $status_note
 * @property string $note
 * @property int $created_at
 *
 * @property Book $book
 * @mixin Eloquent
 */
class Click extends Model
{
    protected $table = 'click_transactions';

    public $timestamps = false;

    public static function create($amount, $type, $accountId = null, $stuffId = null): self
    {
        $order = new static();
        $order->amount = $amount;
        $order->account_id = $accountId;
        $order->stuff_id = $stuffId;
        $order->type = $type;
        $order->status = ClickHelper::INPUT;
        $order->created_at = time();

        return $order;
    }


    public function changeStatus(int $status): void
    {
        $this->status = $status;
    }

    public function pay(int $receiptId = null, array $attributes = [], string $statusNote = ''): void
    {
        $this->receipt_id = $receiptId;
        $this->setStatus(ClickHelper::CONFIRMED, $statusNote, $attributes);
    }

    public function setStatus(int $status, string $statusNote, array $attributes = []): void
    {
        $this->status = $status;
        $this->status_note = $statusNote;
        $this->setAttributes($attributes);
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $attribute) {
            $this->setAttribute($key, $attribute);
        }
    }

    ######################################################################################### Relations

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    #########################################################################################
}
