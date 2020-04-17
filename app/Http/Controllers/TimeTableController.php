<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($request)
    {
        $times = Time::all();
        return view('/timetable/show', compact('times'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('time', compact('time'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $time = new Time();
        $time->doctor_id = $request->id;
        $time->clinic_id = $request->clinic_id;
        $time->scheduleType = $request->scheduleType;
        $time->monday_start = $request->monday_start->default(null);
        $time->monday_end = $request->monday_end->default(null);
        $time->tuesday_start = $request->tuesday_start->default(null);
        $time->tuesday_end = $request->tuesday_end->default(null);
        $time->wednesday_start = $request->wednesday_start->default(null);
        $time->wednesday_end = $request->wednesday_end->default(null);
        $time->thursday_start = $request->thursday_start->default(null);
        $time->thursday_end = $request->thursday_end->default(null);
        $time->friday_start = $request->friday_start->default(null);
        $time->friday_end = $request->friday_end->default(null);
        $time->saturday_start = $request->saturday_start->default(null);
        $time->saturday_end = $request->saturday_end->default(null);
        $time->sunday_start = $request->sunday_start->default(null);
        $time->sunday_end = $request->sunday_end->default(null);
        $time->odd_start = $request->odd_start->default(null);
        $time->odd_end = $request->odd_end->default(null);
        $time->even_start = $request->even_start->default(null);
        $time->even_end = $request->even_end->default(null);
        $time->day_off_start = $request->day_off_start->default(null);
        $time->day_off_end = $request->day_off_end->default(null);
        //$time->created_by = $request->id;
        //$time->update_by = $request->id;
        $time->save();
        return view('show');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $time = new Time();
        $time->doctor_id = $request->id;
        $time->clinic_id = $request->clinic_id;
        $time->scheduleType = $request->scheduleType;
        $time->monday_start = $request->monday_start->default(null);
        $time->monday_end = $request->monday_end->default(null);
        $time->tuesday_start = $request->tuesday_start->default(null);
        $time->tuesday_end = $request->tuesday_end->default(null);
        $time->wednesday_start = $request->wednesday_start->default(null);
        $time->wednesday_end = $request->wednesday_end->default(null);
        $time->thursday_start = $request->thursday_start->default(null);
        $time->thursday_end = $request->thursday_end->default(null);
        $time->friday_start = $request->friday_start->default(null);
        $time->friday_end = $request->friday_end->default(null);
        $time->saturday_start = $request->saturday_start->default(null);
        $time->saturday_end = $request->saturday_end->default(null);
        $time->sunday_start = $request->sunday_start->default(null);
        $time->sunday_end = $request->sunday_end->default(null);
        $time->odd_start = $request->odd_start->default(null);
        $time->odd_end = $request->odd_end->default(null);
        $time->even_start = $request->even_start->default(null);
        $time->even_end = $request->even_end->default(null);
        $time->day_off_start = $request->day_off_start->default(null);
        $time->day_off_end = $request->day_off_end->default(null);
        $time->interval = $request->interval;
        //$time->created_by = $request->id;
        //$time->update_by = $request->id;
        $time->update();
        return view('show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
