@extends('adminlte::page')

@section('content')
<form method="POST" action="{{ route("admin.callcenter.bookingDoctor") }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger card-outline">
                <div class="card-header">   
                    {{ __('Зарегистрировать нового пользователя') }}
                </div>
                <div class="card-body">
                    <table class="table table-striped projects">
                        <tbody>
                            <tr><th>{{ __('Имя, Фамилия, Отчество') }}</th><td>
                                    <div class="row">
                                        <div class="col-3"><input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Имя"></div>
                                        <div class="col-4"><input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="Фамилия"></div>
                                        <div class="col-5"><input id="patronymic" type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic') }}" required autocomplete="patronymic" autofocus placeholder="Отчество"></div>
                                    </div>
                                </td></tr
                            <tr><th>{{ __('Адрес электронной почты') }}</th><td><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"></td></tr>
                            <tr><th>{{ __('Телефон') }}</th><td><input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus></td></tr>
                            <tr><th>{{ __('Дата рождения') }}</th><td><input id="birth_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date') }}" required></td></tr>
                            <tr><th>{{ __('Пол') }}</th><td><select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                        <option value="" selected=""></option>>
                                        <option value="0">Женский</option>>
                                        <option value="1">Мужской</option>>
                                    </select></td></tr>
                            <tr><th>{{ __('Дата бронирования') }}</th>
                                <td><input id="booking_date "type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="booking_date" value="{{$calendar2}}" disabled></td></tr>
                            <tr><th>{{ __('Время') }}</th>
                                <td>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input id="timepickerstart" type="text" class="form-control timepicker"
                                               data-inputmask="&quot;mask&quot;: &quot;99:99&quot;" data-mask="" im-insert="true"
                                               value="{{$radioTime}}" disabled>
                                        <div class="input-group-append" data-target="#timepickerstart" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </td></tr>                            


                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    <table class="table table-striped projects">

                        <tbody>
                            <tr><th>{{ __('Доктор') }}</th><td>{{$user1->name}}</td>
                                <th>{{ __('Специализации') }}</th>
                                <td>@foreach($user1->specializations()->pluck('name_ru') as $value)
                                    {{ $loop->first ? '' : ', ' }}
                                    {{$value}}

                                    @endforeach
                                </td></tr>
                        </tbody>
                    </table>

                    <table class="table table-striped projects">

                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Имя забронированного пациента') }}</th>
                                <th>{{ __('Дата бронирования') }}</th>
                                <th>{{ __('Время') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($b_users as $b_user)
                            <tr>
                                <td>{{$b_user->id}}</td>
                                <td>{{$b_user->user->name}}</td>
                                <td>{{$b_user->booking_date}}</td>
                                <td>{{$b_user->time_start}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input name="doctor_id" type="hidden" value="{{$user1->id}}"/>
                    <input name="clinic_id" type="hidden" value="{{$clinic1->id}}"/>
                    <input name="time_start" type="hidden" value="{{$radioTime}}"/>
                    <input name="booking_date" type="hidden" value="{{$calendar2}}"/>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" id="submit-button">
                            <button type="submit" class="btn btn-primary">{{ __('Сохранить')}}</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@stop
