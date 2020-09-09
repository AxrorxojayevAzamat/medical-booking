<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Clinic\Clinic;
use App\Http\Requests\TimeTableRequest;
use App\Services\TimetableService;
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

        $timetable = Timetable::where('doctor_id', $user->id)->where('clinic_id', $clinic->id)->first();
        return view('admin.timetables.edit', compact('timetable', 'user', 'clinic'));
    }

    public function update(TimeTableRequest $request, User $user, Timetable $timetable)
    {
        try {
            $this->service->validation($request, $user->id);
            $timetable = $this->service->update($timetable->id, $request);
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
