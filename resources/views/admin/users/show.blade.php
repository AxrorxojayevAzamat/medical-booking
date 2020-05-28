@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('Показать пользователя') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                    <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $user->email }}</li>
                    <li class="breadcrumb-item active">{{ __('Показать пользователя') }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                </div>
                <!-- /.card-header -->


                <div class="card-body">
                    <div class="form-group">

                        <label for="name" class="col-form-label text-md-left">{{ __('Имя') }}</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label text-md-left">{{ __('Фамилия') }}</label>
                        <input id="lastname" type="text" class="form-control" name="lastname"
                               value="{{ old('lastname', isset($user) ? $user->lastname : '') }}" disabled>

                    </div>
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Отчество') }}</label>
                        <input id="patronymic" type="text" class="form-control" name="patronymic"
                               value="{{ old('patronymic', isset($user) ? $user->patronymic : '') }}" disabled>

                    </div>

                    <div class="form-group">
                        <label for="email"
                               class="col-form-label text-md-left">{{ __('Адрес электронной почты') }}</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email', isset($user) ? $user->email : '') }}" disabled>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card primary-->
        </div>
        <!-- /.col-md -6.1 -->
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Телефон') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                   data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask=""
                                   im-insert="true" value="{{ old('birth_date', isset($user) ? $user->phone : '') }}"
                                   disabled>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="bith_date" class="col-form-label text-md-left">{{ __('Дата рождения') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input id="birth_date " type="text" class="form-control" data-inputmask-alias="datetime"
                                   data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date"
                                   value="{{ old('birth_date', isset($user) ? $user->birth_date : '') }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label text-md-left">{{ __('Пол') }}</label>
                        <select id="gender" class="form-control" name="gender" disabled>
                            <option value="" selected=""></option>
                            >
                            <option value="0" {{$user->gender === 0 ? 'selected' : ''}} >{{ __('Женский') }}</option>
                            <option value="1" {{$user->gender === 1 ? 'selected' : ''}} >{{ __('Мужской') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="patronymic"
                               class="col-form-label text-md-left">{{ __('Роль пользователя') }}</label>
                        <select id="role" class="form-control @error('roles') is-invalid @enderror" name="role"
                                disabled>
                            @foreach($roles as $value => $label)
                                <option
                                    value="{{ $value }}"{{ $value === $user->role ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label text-md-left">{{ __('Статус') }}</label>
                        <select id="status" class="form-control" name="status"
                                value="{{$user->status==1 ?'selected':'' }}" disabled>
                            @foreach ($statuses as $value => $label)
                                <option
                                    value="{{ $value }}"{{ $value === $user->status ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach;
                        </select>
                    </div>
                    <div class="form-group">
                        @if( !empty($user->avatar))
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="/uploads/avatars/{{ $user->avatar }}"
                                     alt="Фотография пользователя">
                            </div>
                        @endif
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card primary-->
        </div>
        <!-- /.col-md -6.2 -->
        @if($user->inRole('doctor'))
            <div class="col-md-6">
                <div class="card primary">
                    <div class="card-header">
                        {{ __('Специализации доктора') }}
                        <a class="btn btn-secondary float-right" href="{{ route('admin.users.additional',$user) }}"
                           disabled>{{ __('Изменить/Добавить') }}</a>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="col-sm-12">

                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <tbody>
                                @foreach($doctorList->specializations as $spec)
                                    <tr>
                                        <td>{{$spec->name_ru}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer -->

                </div>
                <!-- /.card primary-->
            </div>
            <div class="col-md-6">
                <div class="card primary">
                    <div class="card-header">
                        {{ __('Расписание доктора') }}
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="col-sm-12">

                            <div class="container table">
                                @if (!empty($timetable))
                                @foreach($timetable as $time)
                                
                                @if($time->scheduleType == 1)
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>{{$time->scheduleType}}</th>
                                                <th>Clinic_name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($time->monday_start!= null)
                                                <tr>
                                                    <td>Понедельник</td>
                                                    <td>{{$time->monday_start}}</td>
                                                    <td>{{$time->monday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->tuesday_start!= null)
                                                <tr>
                                                    <td>Вторник</td>
                                                    <td>{{$time->tuesday_start}}</td>
                                                    <td>{{$time->tuesday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->wednesday_start!= null)
                                                <tr>
                                                    <td>Среда</td>
                                                    <td>{{$time->wednesday_start}}</td>
                                                    <td>{{$time->wednesday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->thursday_start!= null)
                                                <tr>
                                                    <td>Четверг</td>
                                                    <td>{{$time->thursday_start}}</td>
                                                    <td>{{$time->thursday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->friday_start!= null)
                                                <tr>
                                                    <td>Пятница</td>
                                                    <td>{{$time->frisday_start}}</td>
                                                    <td>{{$time->frirsday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->saturday_start!= null)
                                                <tr>
                                                    <td>Суббота</td>
                                                    <td>{{$time->satursday_start}}</td>
                                                    <td>{{$time->satursday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->sunday_start!= null)
                                                <tr>
                                                    <td>Воскресенье</td>
                                                    <td>{{$time->sunday_start}}</td>
                                                    <td>{{$time->sunsday_end}}</td>
                                                </tr>
                                            @endif
                                            @if ($time->day_off_start!= null)
                                                <tr>
                                                    <td>Отпуск</td>
                                                    <td>{{$time->day_off_start}}</td>
                                                    <td>{{$time->day_off_end}}</td>
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
                                    @else
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
                                                <td>{{$time->odd_start}}</td>
                                                <td>{{$time->odd_end}}</td>
                                            </tr>
                                            <tr>
                                                <td>Отпуск</td>
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
                        <!-- /.card-body -->
                        <div class="card-footer">
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card primary-->
                </div>
            </div>
                <!-- /.col-md -6.3 -->
                @endif




                @if($user->inRole('doctor'))
                    <div class="col-md-6">
                        <div class="card primary">
                            <div class="card-header">
                                {{ __('Клиники для доктора') }}
                                <a class="btn btn-secondary float-right"
                                   href="{{ route('admin.users.additionalForClinic',$user) }}"
                                   disabled>{{ __('Изменить/Добавить') }}</a>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-sm-12">

                                    <table id="example1" class="table table-bordered table-striped dataTable"
                                           role="grid" aria-describedby="example1_info">
                                        <tbody>
                                        @foreach($doctorList->clinics as $clinic)
                                            <tr>
                                                <td>{{$clinic->name_ru}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            </div>
                            <!-- /.card-footer -->

                        </div>
                        <!-- /.card primary-->
                    </div>
                    <!-- /.col-md -6.3 -->
                @endif

            </div>
            <!-- /.row -->
            <div class="row no-print">
                <div class="col-sm-12">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm"
                           href="{{ route('admin.users.edit',$user->id)}}">{{ __('Редактировать') }}</a>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Вы уверены?')">
                                {{ __('Удалить') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

@stop
