@extends('layouts.admin.page')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-danger card-outline">
            <div class="card-header">
                {{ trans('Зарегистрировать нового пользователя') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.call-center.store-patient")}}"  enctype="multipart/form-data">
                    @csrf
                    <table class="table table-striped projects">
                        <tbody>
                            <tr><th>{{ trans('Адрес электронной почты') }}</th><td><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                    @endif
                                </td></tr>
                            <tr><th>{{ trans('Телефон') }}</th><td><input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" data-inputmask="&quot;mask&quot;: &quot;999999999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                    @if ($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </div>
                                    @endif
                                </td></tr>
                            <tr><th>{{ trans('Имя, Фамилия, Отчество') }}</th><td>
                                    <div class="row">
                                        <div class="col-3"><input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus placeholder="Имя">
                                            @if ($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-4"><input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus placeholder="Фамилия">
                                            @if ($errors->has('last_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-5"><input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus placeholder="Отчество">
                                            @if ($errors->has('middle_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('middle_name') }}</strong>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td></tr>
                            <tr><th>{{ trans('Дата рождения') }}</th><td><input id="birth_date" type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date') }}" required>
                                    @if ($errors->has('birth_date'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </div>
                                    @endif
                                </td></tr>
                            <tr><th>{{ trans('Пол') }}</th><td><select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" autocomplete="gender" autofocus>
                                        <option value="" selected=""></option>>
                                        <option value="0">Женский</option>>
                                        <option value="1">Мужской</option>>
                                    </select>
                                    @if ($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </div>
                                    @endif
                                </td></tr>
                        </tbody>
                    </table>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group" id="submit-button">
                                <button type="submit" class="btn btn-primary">{{ trans('Сохранить')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@stop
