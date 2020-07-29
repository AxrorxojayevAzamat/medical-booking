@extends('doctor.base')

@section('content')


    
    <div class="card card-secondary card-outline" id="doctor-clinic">

                @foreach($doctor->clinics as $clinic)
                <div class="card-header">{{ __('Клиника ') }} <a href='{{ route('admin.clinics.show', $clinic) }}'><strong> {{$clinic->name_ru}}</strong></a>
                    <form action="{{ route('admin.clinics.destroy',$clinic) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div>
                        <button type="submit" class="btn btn-danger float-right btn-delete" onclick="return confirm('При удалени клиники удаляются все расписании и брони Хотите удалить клинику {{$clinic->name_ru}}?')"  >Удалить клинику</button>
                    </div>
                    </form>
                    <div class="card-body">
                                @php
                                    $time = $timetable->where('clinic_id', $clinic->id);
                                @endphp

                                @if($time->isEmpty())
                                <p><a class="btn btn-secondary" href="{{ route('admin.timetables.create', [$user, $clinic])}}" disabled>{{ trans('Создать расписание') }}</a></p>
                                @endif

                                @if($time)
                                @foreach($time as $time)
                                    <div class="row">
                                        <a class="btn btn-primary mr-1" role="button" href="{{ route('admin.timetables.edit', [$user, $clinic])}}">{{ trans('Редактировать расписание') }}</a>

                                        <form method="POST" action="{{ route('admin.timetables.destroy', $time)}}" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" role="button" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
                                            </form>
                                    </div>

                                @if($time->schedule_type == 1)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Начало приёма</th>
                                        <th>Конец приёма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                                            <td>{{ $time->friday_start}}</td>
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
                                            <td>{{ $time->sunsday_end}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                @elseif ($time->schedule_type == 2 && $time->even_start || $time->even_end)
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Начало</th>
                                            <th>Конец</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Четные дни месяца</strong></td>
                                                <td>{{ $time->even_start}}</td>
                                                <td>{{ $time->even_end}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                @elseif ($time->schedule_type == 2 && $time->odd_start || $time->odd_end)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Начало</th>
                                        <th>Конец</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Нечетные дни месяца</strong></td>
                                            <td>{{ $time->odd_start}}</td>
                                            <td>{{ $time->odd_end}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                                @if($time->lunch_start)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Начало</th>
                                            <th>Конец</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Обеденный пеперыв</strong></td>
                                            <td>{{$time->lunch_start}}</td>
                                            <td>{{$time->lunch_end}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                                @if($time->day_off_start)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Начало</th>
                                            <th>Конец</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Отпуск или нерабочий день</strong></td>
                                            <td>{{$time->day_off_start}}</td>
                                            <td>{{$time->day_off_end}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                                @endforeach
                                @endif
                    </div>
                </div>
                @endforeach
@endsection