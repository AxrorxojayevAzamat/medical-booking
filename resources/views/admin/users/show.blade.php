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
<div class="d-flex flex-row mb-3">
    <a class="btn btn-primary mr-1" href="{{ route('admin.users.edit',$user->id)}}">{{ __('Редактировать') }}</a>
    <a class="btn btn-success mr-1" href="{{ route('admin.users.edit',$user->id)}}">{{ __('Забронировать') }}</a>
    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="mr-1">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('{{ 'Are you?' }}')">
            {{ __('Удалить') }}
        </button>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger card-outline">
            <div class="card-header">   
                {{ __('Пользователи') }}
            </div>


            <div class="card-body">
                <table class="table table-striped projects">
                    <tbody>
                        <tr><th>{{ __('ID') }}</th><td>{{ $user->id }}</td></tr>
                        <tr><th>{{ __('Имя') }}</th><td>{{ $user->name }}</td></tr>
                        <tr><th>{{ __('Фамилия') }}</th><td>{{ $user->lastname }}</td></tr>
                        <tr><th>{{ __('Отчество') }}</th><td>{{ $user->patronymic }}</td></tr>
                        <tr><th>{{ __('Адрес электронной почты') }}</th><td>{{ $user->email }}</td></tr>
                        <tr><th>{{ __('Телефон') }}</th><td>{{ $user->phone }}</td></tr>
                        <tr><th>{{ __('Дата рождения') }}</th><td>{{ $user->birth_date }}</td></tr>
                        <tr><th>{{ __('Пол') }}</th><td>{{$user->gender === 0 ? 'Женский' : 'Мужской'}}</td></tr>
                        <tr><th>{{ __('Роль пользователя') }}</th><td>@foreach ($roles as $value => $label)
                                @if ($value === $user->role)
                                {{$label}}
                                @endif
                                @endforeach</td></tr>
                        <tr><th>{{ __('Статус') }}</th><td class="project-state">
                                @foreach ($statuses as $value => $label)
                                @if ($value === $user->status)
                                @if ($user->isInactive())
                                <span class="badge badge-secondary">{{ $label }}</span>
                                @endif
                                @if ($user->isActive())
                                <span class="badge badge-success">{{ $label }}</span>
                                @endif
                                @endif
                                @endforeach
                            </td></tr>
                        <tr><th>{{ __('Photo') }}</th><td><div class="form-group">
                                    @if( !empty($user->avatar))
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="/uploads/avatars/{{ $user->avatar }}"
                                             alt="Фотография пользователя">
                                    </div>
                                    @endif
                                </div></td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@if($user->inRole('doctor'))
<div class="card card-primary card-outline" id="specializations">
    <div class="card-header card-green with-border">{{ __('Специализации доктора') }}</div>
    <div class="card-body">
        <p><a class="btn btn-secondary" href="{{ route('admin.users.additional',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a></p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('Название специализации') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctorList->specializations as $spec)
                <tr>
                    <td>{{$spec->id }}</td>
                    <td>{{$spec->name_ru}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card card-secondary card-outline" id="doctorClinic">
    <div class="card-header card-green with-border">{{ __('Клиники для доктора') }}</div>
    <div class="card-body">
        <p><a class="btn btn-secondary" href="{{ route('admin.users.additionalForClinic',$user) }}" disabled>{{ __('Изменить/Добавить') }}</a></p>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('Клиники для доктора') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctorList->clinics as $clinic)
                <tr>
                    <td>{{$clinic->id }}</td>
                    <td>{{$clinic->name_ru}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@stop
