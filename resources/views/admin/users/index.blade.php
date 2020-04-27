@extends('adminlte::page')
@section('title','Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Пользователи') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item active">{{ __('Пользователи') }}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')

<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">{{ __('Фильтр') }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">{{ __('ID') }}</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Имя') }}</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="lastname" class="col-form-label">{{ __('Фамилия') }}</label>
                            <input id="lastname" class="form-control" name="lastname" value="{{ request('lastname') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Телефон') }}</label>
                            <input id="phone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ request('phone') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Дата рождения') }}</label>
                            <input id="birth_date "type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask name="birth_date" value="{{ request('birth_date') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('Адрес электронной почты') }}</label>
                            <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="role" class="col-form-label">{{ __('Роль пользователя') }}</label>
                            <select id="role" class="form-control" name="role">
                                <option value=""></option>
                                @foreach ($roles as $value => $label)
                                <option value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">{{ __('Статус') }}</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                <option value="0">Неактивный</option>>
                                <option value="1">Aктивный</option>>
                            </select>
                        </div>
                    </div>



                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-1">
                        <a class="btn btn-block btn-success" href="{{ route("admin.users.create") }}">
                            {{ __('Добавить') }}
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending";>{{ __('ID') }}</th>
                                <th>{{ __('Имя') }}</th>
                                <th>{{ __('Фамилия') }}</th>
                                <th>{{ __('Телефон') }}</th>
                                <th>{{ __('Дата рождения') }}</th>
                                <th>{{ __('Адрес электронной почты') }}</th>
                                <th>{{ __('Роль пользователя') }}</th>
                                <th>{{ __('Статус') }}</th>
                                <th style="width: 25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->birth_date}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($roles as $value => $label)
                                    @if ($value === $user->role)
                                    {{$label}}
                                    @endif
                                    @endforeach

                                </td>
                                <td class="project-state">
                                    <span class="badge badge-success">{{$user->status==1 ? 'Aктивный' : 'Неактивный'}}</span>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show',$user->id)}}">
                                        <i class="fas fa-folder">
                                        </i>
                                        {{ __('Посмотреть') }}    
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit',$user->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        {{ __('Редактировать') }}   
                                    </a>
                                    <a class="btn">
                                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Вы уверены?')">
                                                <i class="fas fa-trash">
                                                </i>{{ __('Удалить') }}
                                            </button>
                                        </form>   
                                    </a> 

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @stop
    @section('script')
    $(function () {
    $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
    });
    $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    });
    });
    @stop