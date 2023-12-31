<?php

namespace App\Entity\Book;

use App\Entity\Book\Payment\Click;
use App\Entity\Book\Payment\PaycomOrder;
use App\Entity\Clinic\Clinic;
use App\Entity\User\User;
use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $doctor_id
 * @property int $clinic_id
 * @property Carbon $booking_date
 * @property int $price_id
 * @property Carbon $time_start
 * @property Carbon $time_finish
 * @property string $description
 * @property int $payment_type
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property User $doctor
 * @property Clinic $clinic
 * @property Price $bookPrice
 * @property PaycomOrder $payme
 * @property Click $click
 * @mixin Eloquent
 */
class Book extends Model
{
    const STATUS_WAITING = 1;
    const STATUS_ACTIVE = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_POSTPONED = 5;
    const STATUS_COMPLETED = 10;

    const PAYME = 1;
    const CLICK = 2;

    const SUCCESSFUL = 1;

    protected $table = 'books';

    protected $fillable = [
        'user_id', 'doctor_id', 'clinic_id', 'booking_date', 'time_start', 'time_finish', 'description', 'payment_type', 'status' , 'order_status'
    ];

    public static function new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, $finishTime, $description, $paymentType): self
    {
        return static::create([
            'user_id' => $userId,
            'doctor_id' => $doctorId,
            'clinic_id' => $clinicId,
            'booking_date' => $bookingDate,
            'time_start' => $timeStart,
            'time_finish' => $finishTime,
            'description' => $description,
            'payment_type' => $paymentType,
            'status' => self::STATUS_WAITING,
            'order_status' => self::SUCCESSFUL,
        ]);
    }

    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
    }

    public function cancel()
    {
        $this->status = self::STATUS_CANCELLED;
    }

    public static function statusList(): array
    {
        return [
            self::STATUS_WAITING => 'Ожидание платежа',
            self::STATUS_ACTIVE => 'Оплачен',
            self::STATUS_CANCELLED =>'Отменен',
            self::STATUS_POSTPONED =>'Отложен' ,
            self::STATUS_COMPLETED => 'Выполнен',
        ];
    }

    public function statusName(): string
    {
        return self::statusList()[$this->status];
    }

    public static function typeList()
    {
        return [
            self::PAYME => 'Payme',
            self::CLICK => 'Click',
        ];
    }

    public static function typeName($type): string
    {
        return self::typeList()[$type];
    }


    ########################################### Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function bookPrice()
    {
        return $this->belongsTo(Price::class, 'price_id', 'id');
    }

    public function payme()
    {
        return $this->hasOne(PaycomOrder::class, 'book_id', 'id');
    }

    public function click()
    {
        return $this->hasOne(Click::class, 'book_id', 'id');
    }

    ###########################################
}
