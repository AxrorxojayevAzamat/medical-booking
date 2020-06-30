<?php

namespace App\Entity\Book;

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
 * @property Carbon $time_start
 * @property Carbon $time_finish
 * @property string $description
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property User $doctor
 * @property Clinic $clinic
 * @mixin Eloquent
 */
class Book extends Model
{
    const STATUS_CREATED = 1;
    const STATUS_WAITING_PAY = 2;
    const STATUS_PAYED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_POSTPONED = 5;
    const STATUS_COMPLETED = 10;

    protected $table = 'books';

    protected $fillable = [
        'user_id', 'doctor_id', 'clinic_id', 'booking_date', 'time_start', 'time_finish', 'description', 'status'
    ];

    public static function new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, $finishTime, $description): self
    {
        return static::create([
            'user_id' => $userId,
            'doctor_id' => $doctorId,
            'clinic_id' => $clinicId,
            'booking_date' => $bookingDate,
            'time_start' => $timeStart,
            'time_finish' => $finishTime,
            'description' => $description,
            'status' => self::STATUS_CREATED,
        ]);
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

    ###########################################

}
