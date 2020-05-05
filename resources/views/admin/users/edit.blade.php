@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Редактировать пользователя')}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная')}} </a></li>
                <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи')}}</a></li>
                <li class="breadcrumb-item active">{{ $user->email }}</li>
                <li class="breadcrumb-item active">{{ __('Редактирование')}}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
    <div class="row">
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Редактировать пользователя') }}
                </div>
                <!-- /.card-header -->


                <div class="card-body">
                    <div class="form-group">

                        <label for="name" class="col-form-label text-md-left">{{ __('Имя') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label text-md-left">{{ __('Фамилия') }}</label>
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', isset($user) ? $user->lastname : '') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Отчество') }}</label>
                        <input id="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic', isset($user) ? $user->patronymic : '') }}" required autocomplete="patronymic" autofocus>

                        @error('patronymic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>     

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-left">{{ __('Адрес электронной почты') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-left">{{ __('Пароль') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label text-md-left">{{ __('Подтвердите пароль') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card primary-->
        </div>
        <!-- /.col-md -6 -->
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Редактировать пользователя2') }}
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Телефон') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" required autocomplete="phone" autofocus>
                        </div>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bith_date" class="col-form-label text-md-left">{{ __('Дата рождения') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input id="birth_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date', isset($user) ? $user->birth_date : '') }}" required>
                        </div>

                        @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label text-md-left">{{ __('Пол') }}</label>
                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender', isset($user) && $user->gender== 1 ? 'selected' : '') }}" required autocomplete="gender" autofocus>
                            <option value="" selected=""></option>>
                            <option value="0" {{$user->gender === 0 ? 'selected' : ''}} >Женский</option>>
                            <option value="1" {{$user->gender === 1 ? 'selected' : ''}} >Мужской</option>>
                        </select>

                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Роль пользователя') }}</label>
                        <select id="role" class="form-control @error('roles') is-invalid @enderror" name="role" required>
                            @foreach($roles as $value => $label)
                            <option value="{{ $value }}"{{ $value === $user->role ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label text-md-left">{{ __('Статус') }}</label>
                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>
                            @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}"{{ $value === $user->status ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach;
                        </select>

                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-form-label text-md-left">{{ __('Фото') }}</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="avater" class="custom-file-input" name="avatar" >
                                <label class="custom-file-label" for="avatar">{{ __('Выберите файл') }}</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">{{ __('Загрузить') }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="/uploads/avatars/{{ $user->avatar }}"
                                 alt="Фотография пользователя">
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card primary-->
        </div>
        <!-- /.col-md -6 -->
        @if($user->inRole('doctor'))
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Специализации доктора') }}
                    <a class="btn btn-secondary float-right" href="{{ route('admin.users.additional',$user) }}">{{ __('Изменить/Добавить') }}</a>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="col-sm-12">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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
        <!-- /.col-md -6.3 -->
        @endif
    </div>
    <!-- /.row -->
    <div class="row no-print">
        <div class="col-12 ">
            <button type="submit" class="btn btn-success float-right">{{ __('Сохранять') }}</button>
            <a class="btn btn-secondary float-right" style="margin-right: 5px; href="{{ route("admin.users.index") }}">{{ __('Отменить') }}</a>
        </div>
    </div>
    <!-- /.row -->
</form>
@stop