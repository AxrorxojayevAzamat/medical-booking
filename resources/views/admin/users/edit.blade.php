@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Редактировать пользователя') }}</div>

                <div class="card-body">
                    <form method="PATCH" action="{{ route("admin.users.update", [$user->id]) }}" >
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}" required autocomplete="name" autofocus>

                                <!-- @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Фамилия') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', isset($user) ? $user->lastname : '') }}" required autocomplete="lastname" autofocus>

                                <!-- @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="patronymic" class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

                            <div class="col-md-6">
                                <input id="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic', isset($user) ? $user->patronymic : '') }}" required autocomplete="patronymic" autofocus>

                                <!-- @error('patronymic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Телефон') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" required autocomplete="phone" autofocus>

                                <!-- @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Дата рождения') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date', isset($user) ? $user->birth_date : '') }}" required autocomplete="birth_date" autofocus>

                                <!-- @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Пол') }}</label>

                            <div class="col-md-6">
                                <input id="gender" type="number" min="0" max="1" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender', isset($user) ? $user->gender : '') }}" required autocomplete="gender" autofocus>

                                <!-- @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Адрес электронной почты') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" autocomplete="email">

                                <!-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                <!-- @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Подтвердите пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>


                        @can('user-manage')
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Роль пользователя') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control select2 @error('password') is-invalid @enderror" name="role" required>
                                    @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>

                                <!-- @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif -->
                            </div>
                        </div>           
                        @endcan

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Сохранять') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection