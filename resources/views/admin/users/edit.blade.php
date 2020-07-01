@extends('layouts.admin.page')

@section('content')
<form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
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
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone', $user ? $user->phone : '') }}" required autocomplete="phone" autofocus>
                        </div>
                        @error('phone')
                        <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-left">{{ trans('Пароль') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="new-password">
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
                <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-green card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name" class="col-form-label text-md-left">{{ trans('Имя') }}</label>
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', $profile ? $profile->first_name : '') }}" required>
                        @error('first_name')
                            <span class="invalid-feedback"><strong>{{ $errors->first('first_name') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-form-label text-md-left">{{ trans('Фамилия') }}</label>
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', $profile ? $profile->last_name : '') }}" required >
                        @error('last_name')
                            <span class="invalid-feedback"><strong>{{ $errors->first('last_name') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="col-form-label text-md-left">{{ trans('Отчество') }}</label>
                        <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name', $profile ? $profile->middle_name : '') }}" required>
                        @error('middle_name')
                            <span class="invalid-feedback"><strong>{{ $errors->first('middle_name') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date" class="col-form-label text-md-left">{{ trans('Дата рождения') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input id="birth_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date', $profile ? $profile->birth_date : '') }}" required>
                        </div>
                        @error('birth_date')
                            <span class="invalid-feedback"><strong>{{ $errors->first('birth_date') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label text-md-left">{{ trans('Пол') }}</label>
                        <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                            <option value="" selected=""></option>>
                            <option value="0" {{ old('gender', $profile ? $profile->gender : null) == 0 ? 'selected' : '' }} >Женский</option>>
                            <option value="1" {{ old('gender', $profile ? $profile->gender : null) == 1 ? 'selected' : '' }} >Мужской</option>>
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
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">{{ trans('Фото') }}</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="avatar" class="custom-file-input" name="avatar" >
                                <label class="custom-file-label" for="avatar">{{ trans('Выберите файл') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @can('manage-doctor')
            <div class="col-md-6">
                <div class="card primary">
                    <div class="card-header">
                        {{ trans('Специализации доктора') }}
                        <a class="btn btn-secondary float-right" href="{{ route('admin.users.specializations', $user) }}">{{ trans('Изменить/Добавить') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <tbody>
                                @foreach($doctorList->specializations as $spec)
                                    <tr><td>{{$spec->name_ru}}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card primary">
                    <div class="card-header">
                        <a name="doctors-timetable"></a>
                        {{ __('Расписание доктора') }}
                        {{-- <a class="btn btn-secondary float-right" href="{!! route('admin.timetables.create',['id'=>$user->id, 'clinic_id'=>1])!!}">{{ __('Изменить/Добавить') }}</a> --}}
                    </div>
                    @if (!$clinics->isEmpty())
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th>{{ __('Название клиники') }}</th>
                                <th>{{ __('Управление') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($doctorList->clinics as $clinic)
                            <tr>
                                <td>{{$clinic->name_ru}}</td>
                                <td><a href="{{ route('admin.timetables.create', [$user->id, $clinic->id])}}">Создать расписание</td></td>
                            </tr>
                            @endforeach --}}

                            @if(!empty($time))
                            @foreach ($time as $clinic)
                            <tr>
                                <td>{{$clinic->clinic->name_ru}}</td>
                                <td>
                                    <a href="{{ route('admin.timetables.create', [$user, $clinic->clinic])}}">Создать расписание</a><br>
                                    <a href="{{ route('admin.timetables.edit', [$user, $clinic->clinic])}}">Редактировать расписание</a><br>
                                    <a href="{{ route('admin.timetables.destroy', [$user->id, $clinic])}}">Удалить расписание</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="card primary">
                    <div class="card-header">
                        {{ trans('Клиника для доктора') }}
                        <a class="btn btn-secondary float-right" href="{{ route('admin.users.user-clinics',$user) }}" disabled>{{ trans('Изменить/Добавить') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <tbody>
                                @foreach($doctorList->clinics as $clinic)
                                    <tr>
                                        
                                        <td>{{$clinic->id}}</td>
                                        <td>{{$clinic->name_ru}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        @endcan
    </div>

    <div class="form-group">
        <a class="btn btn-secondary" href="{{ route('admin.users.show', $user) }}">{{ trans('Отменить') }}</a>
        <button type="submit" class="btn btn-success">{{ trans('Сохранять') }}</button>
    </div>

</form>
@endsection
