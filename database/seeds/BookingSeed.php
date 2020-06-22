<?php

use App\Entity\Book\Book;
use Illuminate\Database\Seeder;

class BookingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking1 = Book::create([
                    'user_id' => 9,
                    'doctor_id' => 6,
                    'clinic_id' => 3,
                    'booking_date' => '2020-06-03',
                    'time_start' => '12:31:00',
                    'time_finish' => null,
                    'description' => null,
                    'status' => null,
        ]);
        $booking2 = Book::create([
                    'user_id' => 10,
                    'doctor_id' => 6,
                    'clinic_id' => 3,
                    'booking_date' => '2020-06-03',
                    'time_start' => '15:30:00',
                    'time_finish' => null,
                    'description' => null,
                    'status' => null,
        ]);
    }
}
