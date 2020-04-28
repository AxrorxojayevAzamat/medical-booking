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
                <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи') }}</a></li>
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
    <!-- /.col-md -6.1 -->
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
                        <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" value="{{ old('birth_date', isset($user) ? $user->phone : '') }}" disabled>
                    </div>

                </div>
                <div class="form-group">
                    <label for="bith_date" class="col-form-label text-md-left">{{ __('Дата рождения') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input id="birth_date "type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ old('birth_date', isset($user) ? $user->birth_date : '') }}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-form-label text-md-left">{{ __('Пол') }}</label>
                    <select id="gender" class="form-control" name="gender" disabled>
                        <option value="" selected=""></option>>
                        <option value="0" {{$user->gender === 0 ? 'selected' : ''}} >{{ __('Женский') }}</option>
                        <option value="1" {{$user->gender === 1 ? 'selected' : ''}} >{{ __('Мужской') }}</option>
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
                        <option value="0" {{$user->status === 0 ? 'selected' : ''}}>{{ __('Aктивный') }}</option>
                        <option value="1" {{$user->status === 1 ? 'selected' : ''}}>{{ __('Неактивный') }}</option>
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
    <!-- /.col-md -6.2 -->
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Добавить дополнения') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="form-group">

                    <label for="specialization" class="col-form-label text-md-left">{{ __('Добавить специализации') }}</label>
                    <!--<select class="select2" multiple="multiple" data-placeholder="специализации" style="width: 100%;">-->
                    <select class="select2 select2-hidden-accessible" multiple="multiple" data-placeholder="специализации" style="width: 100%;">
                        <option>Spec1</option>
                        <option>Spec2</option>
                    </select>

                    @error('specialization')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                {{ __('Расписание') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <a class="btn btn-primary btn-sm" href="{{ route('timetables.create',$user->id, 1)}}">
                    <i class="fas fa-folder">
                    </i>
                    {{ __('Создать') }}
                </a>
                <a class="btn btn-info btn-sm" href="{{ route('timetables.edit',$user->id, 1)}}">
                    <i class="fas fa-pencil-alt">
                    </i>
                    {{ __('Редактировать') }}
                </a>
                <a class="btn">
                    <form action="{{ route('timetables.destroy', $user->id, 1)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Вы уверены?')">
                            <i class="fas fa-trash">
                            </i>{{ __('Удалить') }}
                        </button>
                    </form>
                </a>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->

        </div>
        <!-- /.card primary-->
    </div>

    <!-- /.col-md -6.3 -->
</div>
<!-- /.row -->

@stop
