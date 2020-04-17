@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Показать пользователя</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Показать пользователя') }}
            </div>
            <!-- /.card-header -->


            <div class="card-body">
                <div class="form-group">

                    <label for="name" class="col-form-label text-md-left">{{ __('Имя') }}</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}"disabled>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-form-label text-md-left">{{ __('Фамилия') }}</label>
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', isset($user) ? $user->lastname : '') }}" disabled>

                </div>
                <div class="form-group">
                    <label for="patronymic" class="col-form-label text-md-left">{{ __('Отчество') }}</label>
                    <input id="patronymic" type="text" class="form-control" name="patronymic" value="{{ old('patronymic', isset($user) ? $user->patronymic : '') }}" disabled>

                </div>     

                <div class="form-group">
                    <label for="email" class="col-form-label text-md-left">{{ __('Адрес электронной почты') }}</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" disabled>
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
                {{ __('Показать пользователя2') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="form-group">
                    <label for="patronymic" class="col-form-label text-md-left">{{ __('Телефон') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" disabled>
                    </div>
                    <!--<input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}"-->

                </div>
                <div class="form-group">
                    <label for="bith_date" class="col-form-label text-md-left">{{ __('Дата рождения') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input id="birth_date "type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="birth_date" value="{{ old('birth_date', isset($user) ? $user->birth_date : '') }}" disabled>
                    </div>
                          <!--<input id="birth_date" type="date" class="form-control" name="birth_date" value="{{$user->birth_date}}"-->
                </div>
                <div class="form-group">
                    <label for="gender" class="col-form-label text-md-left">{{ __('Пол') }}</label>
                    <select id="gender" class="form-control" name="gender" value="{{ old('gender', isset($user) ? $user->gender : '') }}" disabled>
                        <option value="" selected=""></option>>
                        <option value="0">Женский</option>>
                        <option value="1">Мужской</option>>
                    </select>
                </div>
                <div class="form-group">
                    <label for="patronymic" class="col-form-label text-md-left">{{ __('Роль пользователя') }}</label>
                    @foreach($user->roles()->pluck('name') as $role)
                    <input id="role" type="text" class="form-control" name="role" value="{{$role}}" disabled>
                    @endforeach  
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label text-md-left">{{ __('Статус') }}</label>
                    <select id="status" class="form-control" name="status" value="{{$user->status==1 ?'selected':'' }}" disabled>
                        <option value="" selected=""></option>>
                        <option value="0">Aктивный</option>>
                        <option value="1">Неактивный</option>>
                    </select>
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

@stop