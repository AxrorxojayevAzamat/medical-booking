@extends('layouts.admin.page')

@section('content')
    @if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    @endif
    <div class="d-flex bd-highlight mb-3">
        @if($user->isDoctor())  
        <a class="btn btn-success mr-1 p-2 bd-highlight" href="{{ route('admin.users.user-clinics',$user)}}">{{ trans('Добавить клинику') }}</a>
        <a class="btn btn-success mr-1 p-2 bd-highlight" href="{{ route('admin.users.specializations', $user)}}">{{ trans('Добавить специализацию') }}</a>
        <a class="btn btn-info mr-1 p-2" href="{{ route('admin.users.main-photo', $user)}}">Главное фото</a>
        <a class="btn btn-info mr-1 p-2" href="{{ route('admin.users.photos', $user)}}">Фотографии</a>
        @endif
       

            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="ml-auto mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mr-1" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
            </form>
    </div>

    <form method="POST" action="{{ route("admin.users.update", $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-left">{{ trans('Адрес электронной почты') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-form-label text-md-left">{{ trans('Телефон') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input id="phone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999999999&quot;" data-mask="" im-insert="true" name="phone" required value="{{ old('phone', $user ? $user->phone : '') }}">
                            </div>
                            @error('phone')
                            <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-left">{{ trans('Пароль') }}</label>
                            <input id="password" type="text" class="form-control" name="password">
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-form-label text-md-left">{{ trans('Подтвердите пароль') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-form-label text-md-left">{{ trans('Роль пользователя') }}</label>
                            <select id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}"{{ $value === $user->role ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="status" class="col-form-label text-md-left">{{ trans('Статус') }}</label>
                            <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ old('status', $user->status) === $value ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                            @error('status')
                                <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-green card-outline">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name" class="col-form-label text-md-left">{{ trans('Имя') }}</label>
                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', $profile ? $profile->first_name : '') }}">
                            @error('first_name')
                                <span class="invalid-feedback"><strong>{{ $errors->first('first_name') }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-form-label text-md-left">{{ trans('Фамилия') }}</label>
                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $profile ? $profile->last_name : '') }}">
                            @error('last_name')
                                <span class="invalid-feedback"><strong>{{ $errors->first('last_name') }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="middle_name" class="col-form-label text-md-left">{{ trans('Отчество') }}</label>
                            <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name', $profile ? $profile->middle_name : '') }}">
                            @error('middle_name')
                                <span class="invalid-feedback"><strong>{{ $errors->first('middle_name') }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDate">Дата рождения:</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date', $profile->birth_date ? $profile->birth_date->format('Y-m-d') : '') }}">
                                @error('birth_date')
                                    <span class="invalid-feedback"><strong>{{ $errors->first('birth_date') }}</strong></span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label text-md-left">{{ trans('Пол') }}</label>
                            <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender">
                                <option value="" selected=""></option>
                                <option value="1" {{ old('gender', $profile->gender ? $profile->gender : null) == 1 ? 'selected' : '' }} >Мужской</option>>
                                <option value="0" {{ old('gender', $profile->gender ? $profile->gender : null) == 0 ? 'selected' : '' }} >Женский</option>>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback"><strong>{{ $errors->first('gender') }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if( !empty($user->avatar))
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/uploads/avatars/{{ $user->avatar }}" alt="Фотография пользователя">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <button type="submit" class="btn btn-success">{{ trans('Сохранить') }}</button>
        </div>
    </form>
    @can('manage-doctor-timetable',$user)
        @foreach($doctor->clinics as $clinic)
            <div class="card card-secondary card-outline" id="doctor-clinic">
                <div class="card-header">{{ __('Клиника ') }} <a href='{{ route('admin.clinics.show', $clinic) }}'><strong> {{$clinic->name_ru}}</strong></a> 
                    <form action="{{ route('admin.clinics.destroy',$clinic) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger float-right" onclick="return confirm('При удалени клиники удаляются все расписании и брони Хотите удалить клинику {{$clinic->name_ru}}?')" >Удалить клинику</button>
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
                            <div class="row justify-content-between">
                                <div class="row">
                                    <a class="btn btn-primary mr-1" role="button" href="{{ route('admin.timetables.edit', [$user, $clinic])}}">{{ trans('Редактировать расписание') }}</a>

                                    <form method="POST" action="{{ route('admin.timetables.destroy', $time)}}" >
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
            </div> 
        @endforeach    
    @endcan
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
