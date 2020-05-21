@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Добавить пользователя') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("admin") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Добавить пользователя') }}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Добавить пользователя') }}
                </div>
                <!-- /.card-header -->


                <div class="card-body">
                    <div class="form-group">

                        <label for="name" class="col-form-label text-md-left">{{ __('Имя') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label text-md-left">{{ __('Фамилия') }}</label>
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Отчество') }}</label>
                        <input id="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic') }}" required autocomplete="patronymic" autofocus>

                        @error('patronymic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>     

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-left">{{ __('Адрес электронной почты') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderro
                         name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label text-md-left">{{ __('Пароль') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-form-label text-md-left">{{ __('Подтвердите пароль') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                    {{ __('Добавить пользователя2') }}
                </div>
                <!-- /.card-header -->

                <div class="card-body">                  
                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ __('Телефон') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
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
                            <input id="birth_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date') }}" required>
                        </div>
                        @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label text-md-left">{{ __('Пол') }}</label>
                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                            <option value="" selected=""></option>>
                            <option value="0">Женский</option>>
                            <option value="1">Мужской</option>>
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
                            <option value="" selected=""></option>
                            @foreach($roles as $value => $label)
                            <option value="{{ $value }}" {{ (in_array($value, old('role', [])) || isset($user) && $user->role->contains($id)) ? 'selected' : '' }}>{{ $label }}</option>
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
                            <option value="" selected=""></option>
                            @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
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
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary" href="{{ route("admin.users.index") }}">{{ __('Отменить') }}</a>
            <button type="submit" class="btn btn-success float-right">{{ __('Сохранять') }}</button>
        </div>
    </div>
    <!-- /.row -->
</form>
@stop