<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Entity\User\User;
use App\Entity\Book\Book;
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\Clinic;
use Illuminate\Http\Request;
use App\Http\Requests\TimeRequest;
use App\Http\Requests\TimeTableRequest;
use App\Services\TimetableService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TimeTableController extends Controller
{
    private $service;
    public function __construct(TimetableService $service)
    {
        $this->service = $service;
    }

    public function create(User $user, Clinic $clinic)
    {
        $user=$user;
        $clinic= $clinic;
    
        return view('admin.timetables.create', compact('user', 'clinic'));
    }

    public function store(TimeTableRequest $request)
    {
        try {
            $timetable = $this->service->create($request);
            return redirect()->route('admin.users.show', $timetable->doctor_id)->with('success', 'Успешно!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $user, Clinic $clinic)
    {
        $this->checkAccess($user, $clinic);
        $user=$user;
        $clinic = $clinic;
        
        $timetable = Timetable::where('doctor_id', $user->id)->where('clinic_id', $clinic->id)->first();
        return view('admin.timetables.edit', compact('timetable', 'user', 'clinic'));
    }

    public function update(TimeTableRequest $request, User $user, Timetable $timetable)
    {
        if($request->schedule_type=='1'){
            $clients = Book::where('doctor_id', $user->id)->get();
            foreach ($clients as $client) {
               $weekday=date('w', strtotime($client->booking_date));
               //1-monday
               switch ($weekday) {
                    case '1':
                        if($request->monday_start>$client->time_start ||
                           $request->monday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '1');
                       break;
                    case '2':
                        if($request->tuesday_start>$client->time_start ||
                           $request->tuesday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '2');
                       break;
                    case '3':
                        if($request->wednesday_start>$client->time_start ||
                           $request->wednesday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '3');
                       break;
                    case '4':
                        if($request->thursday_start>$client->time_start ||
                           $request->thursday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '4');
                       break;
                    case '5':
                        if($request->friday_start>$client->time_start ||
                           $request->friday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '5');
                       break;
                    case '6':
                        if($request->saturday_start>$client->time_start ||
                           $request->saturday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '6');
                       break;
                    case '7':
                        if($request->sunday_start>$client->time_start ||
                           $request->sunday_end<$clinet->time_finish)
                            return redirect()->back()->with('error', '7');
                       break;
                   default:
                       break;
               }
            }
        }else{
            if($timetable->odd_start){
            $odd_start_check = Book::where(
                'doctor_id', $user->id)
            ->where('time_start','<',$request->odd_start)->first();
            
            $odd_finish_check = Book::where(
                'doctor_id', $user->id)
            ->where('time_finish','>',$request->odd_end)->first();
            
            if($odd_start_check || $odd_finish_check)
                return redirect()->back()->with('error', 'true');
            }

            if($timetable->even_start){
            $even_start_check = Book::where(
                'doctor_id', $user->id)
            ->where('time_start','<',$request->even_start)->first();

            $even_finish_check = Book::where(
                'doctor_id', $user->id)
            ->where('time_finish','>',$request->even_end)->first();
                
            if($even_start_check || $even_finish_check)
                return redirect()->back()->with('error', 'true');
            }
        }
              
        try {
                $timetable=$this->service->update($timetable->id, $request);
            return redirect()->route('admin.users.show', $user)->with('success', 'Расписание обновлено');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

   
    public function destroy(Timetable $time)
    {
        $time->delete();
        return redirect()->route('admin.users.show', $time->doctor_id)->with('success', 'Расписание удалено!');
    }
    
    private function checkAccess(User $user, Clinic $clinic): void
    {
        if (!Gate::allows('manage-own-doctors-clinics', [$user, $clinic])) {
            abort(403);
        }
    }
}
