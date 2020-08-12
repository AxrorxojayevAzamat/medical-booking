@extends('doctor.base')

@section('content')

<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
            <div class="box_general padding_bottom">
        <h1 align="center">{{trans('menu.timetable')}}</h1>
    <div class="card card-secondary card-outline" id="doctor-clinic">

                @foreach($doctor->clinics as $clinic)
                <div class="card-header mb-0">{{ __('Клиника ') }}<strong> {{$clinic->name_ru}}</strong>
                    <div class="card-body">
                        @php
                            $time = $timetable->where('clinic_id', $clinic->id);
                        @endphp
                        @if($time)
                        @foreach($time as $time)
                            <div class="row my-2">
                                <a class="btn btn-primary" role="button" href="{{ route('doctor.edit', $clinic)}}">{{ trans('Редактировать расписание') }}</a>
                            </div>
                        <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Начало</th>
                                            <th>Конец</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @if($time->schedule_type == 1)
                                    @if ($time->monday_start)
                                        <tr>
                                            <td>Понедельник</td>
                                            <td>{{ $time->monday_start}}</td>
                                            <td>{{ $time->monday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->tuesday_start)
                                        <tr>
                                            <td>Вторник</td>
                                            <td>{{ $time->tuesday_start}}</td>
                                            <td>{{ $time->tuesday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->wednesday_start)
                                        <tr>
                                            <td>Среда</td>
                                            <td>{{ $time->wednesday_start}}</td>
                                            <td>{{ $time->wednesday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->thursday_start)
                                        <tr>
                                            <td>Четверг</td>
                                            <td>{{ $time->thursday_start}}</td>
                                            <td>{{ $time->thursday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->friday_start)
                                        <tr>
                                            <td>Пятница</td>
                                            <td>{{ $time->friday_start}}</td>
                                            <td>{{ $time->friday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->saturday_start)
                                        <tr>
                                            <td>Суббота</td>
                                            <td>{{ $time->satursday_start}}</td>
                                            <td>{{ $time->satursday_end}}</td>
                                        </tr>
                                    @endif
                                    @if ($time->sunday_start)
                                        <tr>
                                            <td>Воскресенье</td>
                                            <td>{{ $time->sunday_start}}</td>
                                            <td>{{ $time->sunday_end}}</td>
                                        </tr>
                                    @endif

                                @elseif ($time->schedule_type == 2 && $time->even_start || $time->even_end)
                                            <tr>
                                                <td><strong>Четные дни месяца</strong></td>
                                                <td>{{ $time->even_start}}</td>
                                                <td>{{ $time->even_end}}</td>
                                            </tr>

                                            @elseif ($time->schedule_type == 2 && $time->odd_start || $time->odd_end)

                                        <tr>
                                            <td><strong>Нечетные дни месяца</strong></td>
                                            <td>{{ $time->odd_start}}</td>
                                            <td>{{ $time->odd_end}}</td>
                                        </tr>

                                @endif

                                @if($time->lunch_start)

                                        <tr>
                                            <td><strong>Обеденный пеперыв</strong></td>
                                            <td>{{$time->lunch_start}}</td>
                                            <td>{{$time->lunch_end}}</td>
                                        </tr>

                                @endif

                                @if($time->day_off_start)

                                        <tr>
                                            <td><strong>Отпуск или нерабочий день</strong></td>
                                            <td>{{$time->day_off_start}}</td>
                                            <td>{{$time->day_off_end}}</td>
                                        </tr>

                                @endif
                                    </tbody>
                                </table>
                        @endforeach
                        @endif

                    </div>
                </div>
                <br>
                @endforeach
            </div></div></div>
            @include('doctor.add_style')
@endsection