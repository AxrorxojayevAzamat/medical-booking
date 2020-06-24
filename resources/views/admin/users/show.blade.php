@extends('adminlte::page')

@section('content')  
<div class="d-flex flex-row mb-3">
    <a class="btn btn-primary mr-1" href="{{ route('admin.users.edit',$user->id)}}">{{ __('Редактировать') }}</a>
    <a class="btn btn-success mr-1" href="{{ route('admin.users.edit',$user->id)}}">{{ __('Забронировать') }}</a>
    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="mr-1">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('{{ 'Are you?' }}')">
            {{ __('Удалить') }}
        </button>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger card-outline">
            <div class="card-header">   
                {{ __('Пользователи') }}
            </div>


            <div class="card-body">
                <table class="table table-striped projects">
                    <tbody>
                        <tr><th>{{ __('ID') }}</th><td>{{ $user->id }}</td></tr>
                        <tr><th>{{ __('Имя') }}</th><td>{{ $user->name }}</td></tr>
                        <tr><th>{{ __('Фамилия') }}</th><td>{{ $user->lastname }}</td></tr>
                        <tr><th>{{ __('Отчество') }}</th><td>{{ $user->patronymic }}</td></tr>
                        <tr><th>{{ __('Адрес электронной почты') }}</th><td>{{ $user->email }}</td></tr>
                        <tr><th>{{ __('Телефон') }}</th><td>{{ $user->phone }}</td></tr>
                        <tr><th>{{ __('Дата рождения') }}</th><td>{{ $user->birth_date }}</td></tr>
                        <tr><th>{{ __('Пол') }}</th><td>{{$user->gender === 0 ? 'Женский' : 'Мужской'}}</td></tr>
                        <tr><th>{{ __('Роль пользователя') }}</th><td>@foreach ($roles as $value => $label)
                                @if ($value === $user->role)
                                {{$label}}
                                @endif
                                @endforeach</td></tr>
                        <tr><th>{{ __('Статус') }}</th><td class="project-state">
                                @foreach ($statuses as $value => $label)
                                @if ($value === $user->status)
                                @if ($user->isInactive())
                                <span class="badge badge-secondary">{{ $label }}</span>
                                @endif
                                @if ($user->isActive())
                                <span class="badge badge-success">{{ $label }}</span>
                                @endif
                                @endif
                                @endforeach
                            </td></tr>
                        <tr><th>{{ __('Photo') }}</th><td><div class="form-group">
                                    @if( !empty($user->avatar))
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="/uploads/avatars/{{ $user->avatar }}"
                                             alt="Фотография пользователя">
                                    </div>
                                    @endif
                                </div></td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@if($user->inRole('doctor'))
    <div class="card card-primary card-outline" id="specializations">
        <div class="card-header card-green with-border">{{ __('Специализации доктора') }}</div>
        <div class="card-body">
            <p><a class="btn btn-primary" href="{{ route('admin.users.specializations',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Название') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctorList->specializations as $spec)
                    <tr>
                        <td>{{$spec->id}}</td>
                        <td>{{$spec->name_ru}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-secondary card-outline" id="doctorClinic">
        <div class="card-header card-green with-border">{{ __('Клиники доктора') }}</div>
        <div class="card-body">
            <p><a class="btn btn-info" href="{{ route('admin.users.user-clinics',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Название') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctorList->clinics as $clinic)
                    <tr>
                        <td>{{($clinic->id) }}</td>
                        <td>{{$clinic->name_ru}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (!empty($timetable))
        @foreach($timetable as $time)
    
    <div class="card card-secondary card-outline" id="doctor-timetable">
        <div class="card-header">{{ __('Расписание доктора для клиники ') }} <a href='{{ route('admin.clinic.show', $time->clinic) }}'><strong> {{$time->clinic->name_ru}}</strong></a> </div>
            <div class="card-body">
            <p><a class="btn btn-secondary" href="{{ route('admin.users.edit', $user)}}#doctors-timetable" disabled>{{ __('Изменить/Добавить') }}</a></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Начало приёма') }}</th>
                        <th>{{ __('Конец приёма') }}</th>
                    </tr>
                </thead>
                    @if($time->scheduleType == 1)       
                    <tbody>
                    @if ($time->monday_start)
                        <tr>
                            <td>Понедельник</td>
                            <td>{{$time->monday_start}}</td>
                            <td>{{$time->monday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->tuesday_start)
                        <tr>
                            <td>Вторник</td>
                            <td>{{$time->tuesday_start}}</td>
                            <td>{{$time->tuesday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->wednesday_start)
                        <tr>
                            <td>Среда</td>
                            <td>{{$time->wednesday_start}}</td>
                            <td>{{$time->wednesday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->thursday_start)
                        <tr>
                            <td>Четверг</td>
                            <td>{{$time->thursday_start}}</td>
                            <td>{{$time->thursday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->friday_start)
                        <tr>
                            <td>Пятница</td>
                            <td>{{$time->friday_start}}</td>
                            <td>{{$time->friday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->saturday_start)
                        <tr>
                            <td>Суббота</td>
                            <td>{{$time->saturday_start}}</td>
                            <td>{{$time->saturday_end}}</td>
                        </tr>
                    @endif
                    @if ($time->sunday_start)
                        <tr>
                            <td>Воскресенье</td>
                            <td>{{$time->sunday_start}}</td>
                            <td>{{$time->sunsday_end}}</td>
                        </tr>
                    @endif
                    </tbody>
            </table>
            @elseif ($time->scheduleType == 2)
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Clini_id</th>
                        <th>Clinic_name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Дни месяца</td>
                        <td>{{$time->even_start}}</td>
                        <td>{{$time->even_end}}</td>
                    </tr>
                    <tr>
                        <td>Отпуск</td>
                        <td>{{$time->day_off_start}}</td>
                        <td>{{$time->day_off_end}}</td>
                    </tr>
                    </tbody>
                </table>
            @endif
            </div>
    </div>
        

    @if($time->day_off_start && $time->day_off_end)
    <div class="card card-secondary card-outline">
        <div class="card-header card-green with-border">{{ __('Отпуск врача в клинике')}}<a href='{{ route('admin.clinic.show', $time->clinic) }}'><strong> {{$time->clinic->name_ru}}</strong></a></div>
            <div class="card-body">
            <p><a class="btn btn-secondary btn-warning" href="{{ route('admin.users.edit', $user)}}#doctors-timetable" disabled>{{ __('Изменить/Добавить') }}</a></p>
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
                    <td>Отпуск</td>
                    <td>{{$time->day_off_start}}</td>
                    <td>{{$time->day_off_end}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif

        @endforeach
    @endif
       


@endif
@endsection
