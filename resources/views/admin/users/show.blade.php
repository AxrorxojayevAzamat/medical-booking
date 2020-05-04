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
    <div class="col-12">
        <a class="btn">
            <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger float-left" type="submit" onclick="return confirm('Вы уверены?')">
                    {{ __('Удалить') }}
                </button>
            </form>
        </a>
        <a class="btn btn-secondary float-right" href="{{ route('admin.users.edit',$user->id)}}">{{ __('Редактировать') }}</a>
    </div>
</div>
<!-- /.row -->
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
                    <select id="role" class="form-control @error('roles') is-invalid @enderror" name="role" disabled>
                        @foreach($roles as $value => $label)
                        <option value="{{ $value }}"{{ $value === $user->role ? ' selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label text-md-left">{{ __('Статус') }}</label>
                    <select id="status" class="form-control" name="status" value="{{$user->status==1 ?'selected':'' }}" disabled>
                        @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}"{{ $value === $user->status ? ' selected' : '' }}>{{ $label }}</option>
                        @endforeach;
                    </select>
                </div>
                <div class="form-group">
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
    <!-- /.col-md -6.2 -->
    @if($user->inRole('doctor'))
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Специализации доктора') }}
                <a class="btn btn-secondary float-right" href="{{ route('admin.users.additional',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a>
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




    @if($user->inRole('doctor'))
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Клиники для доктора') }}
                    <a class="btn btn-secondary float-right" href="{{ route('admin.users.additionalForClinic',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="col-sm-12">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <tbody>
                            @foreach($doctorList->clinics as $clinic)
                                <tr>
                                    <td>{{$clinic->name_ru}}</td>
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

@stop
