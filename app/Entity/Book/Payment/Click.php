<?php


namespace App\Entity\Book\Payment;

use App\Entity\Book\Book;
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


    public function changeStatus(int $status): void
    {
        $this->status = $status;
    }

    public function pay(array $attributes = [], string $statusNote = ''): void
    {
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
