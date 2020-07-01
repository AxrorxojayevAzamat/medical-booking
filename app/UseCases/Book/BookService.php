<?php

namespace App\UseCases\Book;

use Illuminate\Http\Request;
use App\Entity\Region;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Timetable;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class BookService {

    public function findDoctorByRegion(Request $request) {
        $region_id = $request->get('region');
        $result = $this->findCityByRegion($region_id);
        $clinics = $this->findClinicByRegion($region_id);

        $data = ['cities' => $result, 'clinics' => $clinics];


        return json_encode($data);
    }

    public function findDoctorByType(Request $request) {
        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $result = $this->findClinicByType($type_id, $city_id, $region_id);

        return json_encode($result);
    }

    public function findCityByRegion($region_id) {
        if (!empty($region_id)) {
            $result = Region::where('parent_id', $region_id)->pluck('name_ru', 'id');
        }

        if (empty($region_id)) {
            $result = Region::whereNotNull('parent_id')->pluck('name_ru', 'id');
        }

        return $result;
    }

    public function findClinicByType($type_id, $city_id, $region_id) {
        $query = Clinic::orderBy('id');

        if (!empty($region_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }
        if (!empty($region_id) && empty($city_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }

        if (!empty($city_id)) {
            $query->where('region_id', $city_id);
        }

        if (!empty($type_id)) {
            $query->where('type', $type_id);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }

    public function findClinicByRegion($region_id) {
        $query = Clinic::orderBy('id');

        if (!empty($region_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }

    public function daysDisabled(array $dayOfWeeks, string $start, string $end) {
        $daysOff1 = array();
        $period = CarbonPeriod::between($start, $end);

        foreach ($period as $date) {
            if (!empty($dayOfWeeks)) {
                foreach ($dayOfWeeks as $dayOfWeek) {
                    if ($date->dayOfWeek === $dayOfWeek) {
                        $daysOff1[] = $date->format('Y-m-d');
                    }
                }
            }
        }
        return $daysOff1;
    }

    public function restDays(string $restStart, string $restEnd) {
        $daysOff3 = array();
        $restPeriod = CarbonPeriod::between($restStart, $restEnd);
        if (!empty($restPeriod)) {
            foreach ($restPeriod as $date) {
                $daysOff3[] = $date->format('Y-m-d');
            }
        }
        return $daysOff3;
    }

    public function celebrationDays(Collection $celebrationDays) {
        $daysOff2 = array();
        if (!empty($celebrationDays)) {
            foreach ($celebrationDays as $celeb) {
                $count = $celeb->quantity;
                $c = Carbon::createFromFormat('Y-m-d H:i:s', $celeb->date);
                for ($i = 0; $i < $count; $i++) {
                    $daysOff2[] = $c->format('Y-m-d');
                    $c = $c->addDay();
                }
            }
        }
        return $daysOff2;
    }

    public function timeSlots(Timetable $timetable, string $currentDate) {
        $timeSlots = array();
        $duration = $this->getTime($timetable, $currentDate);
        if (!empty($duration['start']) && !empty($duration['end']) && !empty($duration['inter'])) {
            $timeSlots = $this->getTimes($duration['start'], $duration['end'], $duration['inter']);
        }
        return $timeSlots;
    }

    public function getTimes(string $startTime, string $endTime, int $interval) {
        $time_slots = array();
        if (!empty($startTime) && !empty($endTime) && !empty($interval)) {
            $start_time = Carbon::createFromFormat('H:i:s', $startTime);
            $end_time = Carbon::createFromFormat('H:i:s', $endTime);

            $time = $start_time;

            while ($end_time->greaterThan($time)) {
                $time_slots[] = $time->format('H:i');
                $time = $time->addMinutes($interval);
            }
        }

        return $time_slots;
    }

    public
            function getTime(Timetable $timetable, string $date) {
        $carbon = Carbon::createFromFormat('Y-m-d', $date);
        $time = array();

        switch ($carbon->dayOfWeek) {
            case Carbon::MONDAY:
                $time['start'] = $timetable->monday_start;
                $time['end'] = $timetable->monday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::TUESDAY:
                $time['start'] = $timetable->tuesday_start;
                $time['end'] = $timetable->tuesday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::WEDNESDAY:
                $time['start'] = $timetable->wednesday_start;
                $time['end'] = $timetable->wednesday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::THURSDAY:
                $time['start'] = $timetable->thursday_start;
                $time['end'] = $timetable->thursday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::FRIDAY:
                $time['start'] = $timetable->friday_start;
                $time['end'] = $timetable->friday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::SATURDAY:
                $time['start'] = $timetable->saturday_start;
                $time['end'] = $timetable->saturday_end;
                $time['inter'] = $timetable->interval;
                break;
            case Carbon::SUNDAY:
                $time['start'] = $timetable->sunday_start;
                $time['end'] = $timetable->sunday_end;
                $time['inter'] = $timetable->interval;
                break;
        }

        return $time;
    }

    public function getDaysConst(Timetable $timetable) {

        $daysConst = array();
        switch ($timetable->shcedule_type) {
            case Timetable::SCHEDULE_TYPE_WEEK:
                if (empty($timetable->monday_start)) {
                    array_push($daysConst, Carbon::MONDAY);
                }

                if (empty($timetable->tuesday_start)) {
                    array_push($daysConst, Carbon::TUESDAY);
                }

                if (empty($timetable->wednesday_start)) {
                    array_push($daysConst, Carbon::WEDNESDAY);
                }

                if (empty($timetable->thursday_start)) {
                    array_push($daysConst, Carbon::THURSDAY);
                }

                if (empty($timetable->friday_start)) {
                    array_push($daysConst, Carbon::FRIDAY);
                }

                if (empty($timetable->saturday_start)) {
                    array_push($daysConst, Carbon::SATURDAY);
                }

                if (empty($timetable->sunday_start)) {
                    array_push($daysConst, Carbon::SUNDAY);
                }
                break;
            case Timetable::SCHEDULE_TYPE_ODD_OR_EVEN:
                if (!empty($timetable->odd_start) && !empty($timetable->odd_end)) {
                    $daysConst = [Carbon::MONDAY, Carbon::WEDNESDAY, Carbon::FRIDAY, Carbon::SUNDAY];
                }

                if (!empty($timetable->even_start) && !empty($timetable->even_end)) {
                    $daysConst = [Carbon::TUESDAY, Carbon::THURSDAY, Carbon::SATURDAY];
                }

                break;
        }

        return $daysConst;
    }

}
