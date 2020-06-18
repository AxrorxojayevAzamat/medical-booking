<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Clinic;
use App\Timetable;
use Illuminate\Http\Request;
use App\Http\Requests\TimeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{


    /**
     * Display the specified resource.

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $times = Timetable::all();
        return view('/timetables/show', compact('times'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user, Clinic $clinic)
    {
        $user=$user;
        $clinic= $clinic;
    
        return view('admin.timetables.create', compact('user', 'clinic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $time = new Timetable();
        $time->doctor_id = $request->input('user_id');
        $time->clinic_id = $request->input('clinic_id');
        $time->scheduleType= $request->scheduleType;
        $time->interval = $request->interval;
        $time->monday_start = $request->monday_start;
        $time->monday_end = $request->monday_end;
        
        $time->tuesday_start = $request->tuesday_start;
        $time->tuesday_end = $request->tuesday_end;
        $time->wednesday_start = $request->wednesday_start;
        $time->wednesday_end = $request->wednesday_end;
        $time->thursday_start = $request->thursday_start;
        $time->thursday_end = $request->thursday_end;
        $time->friday_start = $request->friday_start;
        $time->friday_end = $request->friday_end;
        $time->saturday_start = $request->saturday_start;
        $time->saturday_end = $request->saturday_end;
        $time->sunday_start = $request->sunday_start;
        $time->sunday_end = $request->sunday_end;
        $time->odd_start = $request->odd_start;
        $time->odd_end = $request->odd_end;
        $time->even_start = $request->even_start;
        $time->even_end = $request->even_end;
        $time->day_off_start = $request->day_off_start;
        $time->day_off_end = $request->day_off_end;
        $time->created_by = Auth::user()->id;
        $time->updated_by = Auth::user()->id;

        $time->save();
        return redirect()->route('admin.users.show', $time->doctor_id)->with('success', 'Успешно!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(User $user, Clinic $clinic)
    {
        $user=$user;
        $clinic = $clinic;
        $time = Timetable::where('doctor_id', $user->id)->get();
        if (!$time) {
            return redirect()->route('user.show')->withErrors('Такого расписания  нет на сайте');
        }
        //dd($time);
        return view('admin.timetables.edit', compact('time
        ', 'user', 'clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $time = new Timetable();
        $time->doctor_id = $request->input('id');
        $time->clinic_id = $request->input('clinic_id');
        $time->scheduleType = $request->scheduleType;
        $time->monday_start = $request->monday_start;
        $time->monday_end = $request->monday_end;
        $time->tuesday_start = $request->tuesday_start;
        $time->tuesday_end = $request->tuesday_end;
        $time->wednesday_start = $request->wednesday_start;
        $time->wednesday_end = $request->wednesday_end;
        $time->thursday_start = $request->thursday_start;
        $time->thursday_end = $request->thursday_end;
        $time->friday_start = $request->friday_start;
        $time->friday_end = $request->friday_end;
        $time->saturday_start = $request->saturday_start;
        $time->saturday_end = $request->saturday_end;
        $time->sunday_start = $request->sunday_start;
        $time->sunday_end = $request->sunday_end;
        $time->odd_start = $request->odd_start;
        $time->odd_end = $request->odd_end;
        $time->even_start = $request->even_start;
        $time->even_end = $request->even_end;
        $time->day_off_start = $request->day_off_start;
        $time->day_off_end = $request->day_off_end;
        $time->interval = $request->interval;
        //$time->created_by = $request->id;
        //$time->update_by = $request->id;
        $time->update();
        return redirect()->route('admin.timetables.show', compact('id'))->with('success', 'Расписание обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time = Timetable::find($id);
        if (!$time) {
            return redirect()->route('user.show')->withErrors('Такой страницы нет на сайте');
        }

        $time->delete();
        return redirect()->route('user.show')->with('success', 'Расписание удалено!');
    }
}
