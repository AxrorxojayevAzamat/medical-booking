<?php

namespace App\Services;

use App\Entity\Clinic\Timetable;
use App\Entity\Book\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TimeTableRequest;
use Illuminate\Http\Request;

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

    public function validation(TimeTableRequest $request,$id){
        $clients = Book::where('doctor_id', $id)->get();
        if($request->schedule_type=='1'){
            foreach ($clients as $client) {
               $weekday=date('w', strtotime($client->booking_date));
               //1-monday
               switch ($weekday) {
                    case '1':
                        if($request->monday_start>$client->time_start ||
                           $request->monday_end<$client->time_finish)
                            return redirect()->back()->with('error', '1');
                       break;
                    case '2':
                        if($request->tuesday_start>$client->time_start ||
                           $request->tuesday_end<$client->time_finish)
                            return redirect()->back()->with('error', '2');
                       break;
                    case '3':
                        if($request->wednesday_start>$client->time_start ||
                           $request->wednesday_end<$client->time_finish)
                            return redirect()->back()->with('error', '3');
                       break;
                    case '4':
                        if($request->thursday_start>$client->time_start ||
                           $request->thursday_end<$client->time_finish)
                            return redirect()->back()->with('error', '4');
                       break;
                    case '5':
                        if($request->friday_start>$client->time_start ||
                           $request->friday_end<$client->time_finish)
                            return redirect()->back()->with('error', '5');
                       break;
                    case '6':
                        if($request->saturday_start>$client->time_start ||
                           $request->saturday_end<$client->time_finish)
                            return redirect()->back()->with('error', '6');
                       break;
                    case '7':
                        if($request->sunday_start>$client->time_start ||
                           $request->sunday_end<$client->time_finish)
                            return redirect()->back()->with('error', '7');
                       break;
                   default:
                       break;
               }
            }
        }else{
            if(($request->odd_start || $request->odd_end) &&
                ($request->even_start || $request->even_end)){
                    return redirect()->back()->with('error', 'odd_even');
            }
            if($request->odd_start || $request->odd_end){
                $request->validate([
                    'odd_start' => 'required',
                    'odd_end' => 'required',
                ]);
                foreach ($clients as $client) {
                    if(!(date('d', strtotime($client->booking_date))%2))
                        return redirect()->back()->with('error', 'even');
                }

                $odd_start_check = Book::where(
                    'doctor_id', $id)
                ->where('time_start','<',$request->odd_start)->first();
                
                $odd_finish_check = Book::where(
                    'doctor_id', $id)
                ->where('time_finish','>',$request->odd_end)->first();
            
                if($odd_start_check || $odd_finish_check)
                    return redirect()->back()->with('error', 'odd');
            }
            else{
                $request->validate([
                    'even_start' => 'required',
                    'even_end' => 'required',
                ]);
                foreach ($clients as $client) {
                    if(date('d', strtotime($client->booking_date))%2)
                        return redirect()->back()->with('error', 'odd');
                }
                $even_start_check = Book::where(
                    'doctor_id', $id)
                ->where('time_start','<',$request->even_start)->first();

                $even_finish_check = Book::where(
                    'doctor_id', $id)
                ->where('time_finish','>',$request->even_end)->first();
                if($even_start_check || $even_finish_check)
                    return redirect()->back()->with('error', 'even');
            }
        }
    }
}
