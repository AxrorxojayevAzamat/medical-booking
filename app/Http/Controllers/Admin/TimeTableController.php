<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\Clinic;
use Illuminate\Http\Request;
use App\Http\Requests\TimeRequest;
use App\Http\Requests\TimeTableRequest;
use App\Services\TimetableService;
use Illuminate\Support\Facades\Auth;

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
            //dd($timetable);
            return redirect()->route('admin.users.show', $timetable->doctor_id)->with('success', 'Успешно!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $user, Clinic $clinic)
    {
        $user=$user;
        $clinic = $clinic;
        
        $timetable = Timetable::where('doctor_id', $user->id)->where('clinic_id', $clinic->id)->first();
        return view('admin.timetables.edit', compact('timetable', 'user', 'clinic'));
    }

   
    public function update(TimeTableRequest $request, User $user, Timetable $timetable)
    {
        $timetable->update($request->all());
        // $time = new Timetable();
        // $time->doctor_id = $request->input('id');
        // $time->clinic_id = $request->input('clinic_id');
        // $time->scheduleType = $request->scheduleType;
        // $time->monday_start = $request->monday_start;
        // $time->monday_end = $request->monday_end;
        // $time->tuesday_start = $request->tuesday_start;
        // $time->tuesday_end = $request->tuesday_end;
        // $time->wednesday_start = $request->wednesday_start;
        // $time->wednesday_end = $request->wednesday_end;
        // $time->thursday_start = $request->thursday_start;
        // $time->thursday_end = $request->thursday_end;
        // $time->friday_start = $request->friday_start;
        // $time->friday_end = $request->friday_end;
        // $time->saturday_start = $request->saturday_start;
        // $time->saturday_end = $request->saturday_end;
        // $time->sunday_start = $request->sunday_start;
        // $time->sunday_end = $request->sunday_end;
        // $time->lunch_start = $request->lunch_start;
        // $time->lunch_end = $request->lunch_end;
        // $time->odd_start = $request->odd_start;
        // $time->odd_end = $request->odd_end;
        // $time->even_start = $request->even_start;
        // $time->even_end = $request->even_end;
        // $time->day_off_start = $request->day_off_start;
        // $time->day_off_end = $request->day_off_end;
        // $time->interval = $request->interval;
   
        // $time->update();
        return redirect()->route('admin.users.show', $user)->with('success', 'Расписание обновлено');
    }

   
    public function destroy(Timetable $time)
    {
        $time->delete();
        return redirect()->route('admin.users.show', $time->doctor_id)->with('success', 'Расписание удалено!');
    }
}
