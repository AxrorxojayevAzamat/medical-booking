<?php

namespace App\Entity\Booking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = [
        'user_id', 'doctor_id', 'clinic_id', 'booking_date', 'time_start', 'time_finish', 'description', 'status'
    ];

    public static function new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, $timeFinish, $description, $status): self
    {
        return static::create([
            'user_id' => $userId,
            'doctor_id' => $doctorId,
            'clinic_id' => $clinicId,
            'booking_date' => $bookingDate,
            'time_start' => $timeStart,
            'time_finish' => $timeFinish,
            'description' => $description,
            'status' => $status,
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Entity\User\User', 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Entity\User\User', 'doctor_id', 'id');
    }

}
