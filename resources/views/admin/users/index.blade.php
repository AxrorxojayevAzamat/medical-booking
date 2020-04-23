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
                <table id="laravel_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
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
                            <td>@foreach($user->roles()->pluck('name') as $role)
                                {{$role}}
                                @endforeach </td>
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