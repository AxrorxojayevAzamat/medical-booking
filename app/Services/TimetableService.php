<?php

namespace App\Services;

use App\Entity\Clinic\Timetable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TimeTableRequest;

class TimetableService
{
    public function create(TimeTableRequest $request)
    {
        try {
            $timetable = Timetable::make([
                'doctor_id' => $request->input('user_id'),
                'clinic_id' => $request->input('clinic_id'),
                'schedule_type' => $request->schedule_type,
                'interval' => $request->interval?? null,
                'monday_start' => $request->monday_start ?? null,
                'monday_end' => $request->monday_end ?? null,
                'tuesday_start' => $request->tuesday_start?? null,
                'tuesday_end' => $request->tuesday_end?? null,
                'wednesday_start' => $request->wednesday_start,
                'wednesday_end' => $request->wednesday_end,
                'thursday_start' => $request->thursday_start,
                'thursday_end' => $request->thursday_end,
                'friday_start' => $request->friday_start,
                'friday_end' => $request->friday_end,
                'saturday_start' => $request->saturday_start,
                'saturday_end' => $request->saturday_end,
                'sunday_start' => $request->sunday_start,
                'sunday_end' => $request->sunday_end,
        
                'lunch_start' => $request->lunch_start,
                'lunch_end' => $request->lunch_end,
        
                'odd_start' => $request->odd_start,
                'odd_end' => $request->odd_end,
                'even_start' => $request->even_start,
                'even_end' => $request->even_end,
                'day_off_start' => $request->day_off_start,
                'day_off_end' => $request->day_off_end,
                'created_by' => Auth::user()->id,
                'updated_by'=> Auth::user()->id,
            ]);
            $timetable->save();
            return $timetable;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update($id, TimeTableRequest $request)
    {
        //dd($id, $request);
        $timetable = Timetable::find($id);
        try {
            $timetable->update([
                // 'doctor_id' => $request->input('user_id'),
                // 'clinic_id' => $request->input('clinic_id'),
                'schedule_type' => $request->schedule_type,
                'interval' => $request->interval,
                'monday_start' => $request->monday_start,
                'monday_end' => $request->monday_end,
                'tuesday_start' => $request->tuesday_start,
                'tuesday_end' => $request->tuesday_end,
                'wednesday_start' => $request->wednesday_start,
                'wednesday_end' => $request->wednesday_end,
                'thursday_start' => $request->thursday_start,
                'thursday_end' => $request->thursday_end,
                'friday_start' => $request->friday_start,
                'friday_end' => $request->friday_end,
                'saturday_start' => $request->saturday_start,
                'saturday_end' => $request->saturday_end,
                'sunday_start' => $request->sunday_start,
                'sunday_end' => $request->sunday_end,
        
                'lunch_start' => $request->lunch_start,
                'lunch_end' => $request->lunch_end,
        
                'odd_start' => $request->odd_start,
                'odd_end' => $request->odd_end,
                'even_start' => $request->even_start,
                'even_end' => $request->even_end,
                'day_off_start' => $request->day_off_start,
                'day_off_end' => $request->day_off_end,
                'created_by' => Auth::user()->id,
                'updated_by'=> Auth::user()->id,
            ]);
            $timetable->save();
            return $timetable;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
