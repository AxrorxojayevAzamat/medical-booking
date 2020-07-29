@extends('layouts.admin.page')
@section('breadcrumbs', '')
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
<form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">

                    <div class="form-group">
                        <label for="email" class="col-form-label text-md-left">{{ trans('Адрес электронной почты') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="patronymic" class="col-form-label text-md-left">{{ trans('Телефон') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
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
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
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
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <span class="invalid-feedback"><strong>{{ $errors->first('first_name') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-form-label text-md-left">{{ trans('Фамилия') }}</label>
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required >
                        @error('last_name')
                            <span class="invalid-feedback"><strong>{{ $errors->first('last_name') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="col-form-label text-md-left">{{ trans('Отчество') }}</label>
                        <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ old('middle_name') }}" required>
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
                            <input id="birth_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date') }}" required>
                        </div>
                        @error('birth_date')
                            <span class="invalid-feedback"><strong>{{ $errors->first('birth_date') }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-form-label text-md-left">{{ trans('Пол') }}</label>
                        <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required>
                            <option value="" selected=""></option>>
                            <option value="0" {{ old('gender') == 0 ? 'selected' : '' }} >Женский</option>>
                            <option value="1" {{ old('gender') == 1 ? 'selected' : '' }} >Мужской</option>>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback"><strong>{{ $errors->first('gender') }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">{{ trans('Сохранять') }}</button>
        <a class="btn btn-secondary" href="{{ route("admin.users.index") }}">{{ trans('Отменить') }}</a>
    </div>
</form>
@endsection
