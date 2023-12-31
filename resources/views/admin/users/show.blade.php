@extends('layouts.admin.page')

@section('content')
    <div class="d-flex bd-highlight mb-3">
        @can('manage-users')<a class="btn btn-primary mr-1 p-2 bd-highlight" href="{{ route('admin.users.edit',$user)}}">{{ trans('Редактировать') }}</a>@endcan
        @if($user->isDoctor())
        <a class="btn btn-success mr-1 p-2 bd-highlight" href="{{ route('admin.users.user-clinics',$user)}}">{{ trans('Добавить клинику') }}</a>
        <a class="btn btn-success mr-1 p-2 bd-highlight" href="{{ route('admin.users.specializations', $user)}}">{{ trans('Добавить специализацию') }}</a>
        <a class="btn btn-info mr-1 p-2" href="{{ route('admin.users.main-photo', $user)}}">Главное фото</a>
        <a class="btn btn-info mr-1 p-2" href="{{ route('admin.users.photos', $user)}}">Фотографии</a>
        @endif
        @can('manage-admin-clinics',$user)
        <a class="btn btn-success mr-1 p-2 bd-highlight" href="{{ route('admin.users.admin-clinics',$user)}}">{{ trans('Добавить админу клиники') }}</a>
        @endcan
    @can('manage-users')
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="ml-auto mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mr-1" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
            </form>@endcan
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if( $profile && !empty($profile->mainPhoto))
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{$profile->mainPhoto->fileThumbnail}}" alt="Фотография пользователя">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <table class="table table-striped projects">
                        <tbody>
                            <tr><th>{{ trans('ID') }}</th><td>{{ $user->id }}</td></tr>
                            {{-- <tr><th>{{ trans('Логин') }}</th><td>{{ $user->name }}</td></tr> --}}
                            <tr><th>{{ trans('Адрес электронной почты') }}</th><td>{{ $user->email }}</td></tr>
                            <tr><th>{{ trans('Телефон') }}</th><td>{{ $user->phone }}</td></tr>
                            <tr><th>{{ trans('Роль пользователя') }}</th><td>{{ $user->roleName() }}</td></tr>

                            <tr>
                                <th>{{ trans('Статус') }}</th>
                                <td class="project-state">
                                    @if ($user->status === \App\Entity\User\User::STATUS_INACTIVE)
                                        <span class="badge badge-secondary">Неактивный</span>
                                    @endif
                                    @if ($user->status === \App\Entity\User\User::STATUS_ACTIVE)
                                        <span class="badge badge-primary">Aктивный</span>
                                    @endif
                                </td>
                            </tr>

                            <tr><th>{{ trans('Имя') }}</th><td>{{ $profile ? $profile->first_name : '' }}</td></tr>
                            <tr><th>{{ trans('Фамилия') }}</th><td>{{ $profile ? $profile->last_name : '' }}</td></tr>
                            <tr><th>{{ trans('Отчество') }}</th><td>{{ $profile ? $profile->middle_name : '' }}</td></tr>
                            <tr><th>{{ trans('Дата рождения') }}</th><td>{{ $profile->birth_date ? $profile->birth_date->format('d-m-Y') : '' }}</td></tr>
                            <tr><th>{{ trans('Пол') }}</th><td>{{ $profile ? $profile->gender === 0 ? 'Женский' : 'Мужской' : ''}}</td></tr>

                            @if($user->isDoctor())
                            @if(!$doctor->specializations->isEmpty())
                            <tr>
                                <th>{{'Специализации'}}</th>
                                <th>
                                    @foreach($doctor->specializations as $spec)
                                    <a href='{{ route('admin.specializations.show', $spec->id) }}'><strong>{{$spec->name_ru}}</strong></a><br>
                                    @endforeach
                                </th>
                            </tr>
                                @endif
                            @endif
                            @if($user->isClinic())
                            @if(!$user->adminsClinics->isEmpty())
                            <tr>
                                <th>{{'Клиники админа'}}</th>
                                <th>
                                    @foreach($user->adminsClinics as $admin_clinic)
                                    <a href='{{ route('admin.clinics.show', $admin_clinic->id) }}'><strong>{{$admin_clinic->name}}</strong></a><br>
                                    @endforeach
                                </th>
                            </tr>
                                @endif
                            @endif
                                {{-- <tr>
                                <th>
                                        <div class="col-md-3">
                                            @if( $profile && !empty($profile->avatar))
                                            <div class="">
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="/uploads/avatars/{{ $profile->avatar }}"
                                                     alt="Фотография пользователя">
                                            </div>
                                            @endif
                                        </div>
                                </th>
                                </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('manage-doctor-timetable',$user)
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
                                        
                                    <form method="POST" action="{{ route('admin.timetables.destroy', $time->id)}}" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" role="button" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
                                        </form>
                                </div>
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Начало приёма</th>
                                            <th>Конец приёма</th>
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
            @endforeach
        </div>
    @endcan
    @include('doctor.add_style')
    <style>
        table thead tr th:nth-child(1), table tbody tr td:nth-child(1) {
            width: 80%;
        }
        .card {
            background-color: #f4f6f9;
            border: none;
        }
        .card-header {
            margin-bottom: 1.5em;
        }
    
        .card-header:nth-last-child(-n+2) {
            margin-bottom: 0;
        }
    
        </style>
@endsection
