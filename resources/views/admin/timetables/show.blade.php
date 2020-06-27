@extends('layouts.admin.page')
@section('content')

    <div class ="container table">
        <table>
            <thead>
                <th>id</th>
                <th>clinic</th>
                <th>doctor</th>
                <th>type</th>
                <th>even days</th>
                <th>odd days</th>
                <th>interval</th>
                <th>ПН</th>
                <th>ВТ</th>
                <th>СР</th>
                <th>ЧТ</th>
                <th>ПТ</th>
                <th>СБ</th>
                <th>ВС</th>
                <th>интервал</th>
                <th>Выходные </th>
            </thead>
            <tbody>
            @foreach($times as $time)
                <th>{{$time->id}}</th>
                <th>{{$time->clinic_id}}</th>
                <th>{{$time->doctor_id}}</th>
                <th>{{$time->scheduleType}}</th>
                <th>{{$time->even_start}}-{{$time->even_end}}}</th>
                <th>{{$time->odd_start}}-{{$time->odd_end}}}</th>
                <th>{{$time->interval}}</th>
                <th>{{$time->monday_start}}-{{$time->monday_end}}}</th>
                <th>{{$time->tuesday_start}}-{{$time->tuesday_end}}}</th>
                <th>{{$time->wednesday_start}}-{{$time->wednesday_end}}}</th>
                <th>{{$time->thursday_start}}-{{$time->thursday_end}}}</th>
                <th>{{$time->friday_start}}-{{$time->friday_end}}}</th>
                <th>{{$time->saturday_start}}-{{$time->saturday_end}}}</th>
                <th>{{$time->sunday_start}}-{{$time->sunday_end}}}</th>
                <th>{{$time->interval}}</th>
                <th>{{$time->day_off_start}}-{{$time->day_off_end}}}</th>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection()
