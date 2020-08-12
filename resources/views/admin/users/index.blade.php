@extends('layouts.admin.page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-footer">
                    @if(Auth::user()->isAdmin())<a class="btn btn-success" href="{{ route("admin.users.create") }}">{{ trans('Добавить') }} </a>@endif
                </div>

                <div class="card-body">
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        {!! Form::label('id', 'ИД', ['class' => 'col-form-label']) !!}
                                        {!! Form::text('id', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('fio', 'ФИО:', ['class' => 'col-form-label']) !!}
                                        {!! Form::text('fio', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Телефон:', ['class' => 'col-form-label']) !!}
                                        {!! Form::text('phone',null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                               
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email:', ['class' => 'col-form-label']) !!}
                                        {!! Form::text('email',null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>  
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('role', 'Роль:', ['class' => 'col-form-label']) !!}
                                        {!! Form::select('role', \App\Entity\User\User::rolesList(), request('role'), ['class'=>'form-control', 'placeholder' => '']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('status', 'Статус:', ['class' => 'col-form-label']) !!}
                                        {!! Form::select('status', \App\Entity\User\User::statusList(), request('status'), ['class'=>'form-control', 'placeholder' => '']) !!}
                                     
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Поиск</button>
                                        <a href="?" class="btn btn-outline-secondary">{{ __('Очистить') }}</a>
                                    </div>
                                </div>
                               
                            </div>
                        </form>
                    </div>

                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending";>{{ trans('ID') }}</th>
                                <th>{{ trans('ФИО') }}</th>
                                <th>{{ trans('Телефон') }}</th>
                                <th>{{ trans('Email') }}</th>
                                <th>{{ trans('Роль') }}</th>
                                <th>{{ trans('Статус') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->profile ? $user->profile->fullName : '' }}</a></td>
                                <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->phone }}</a></td>
                                <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->email }}</a></td>
                                <td>{{ $user->roleName() }}</td>
                                <td class="project-state">
                                    @if ($user->status === \App\Entity\User\User::STATUS_INACTIVE)
                                        <span class="badge badge-secondary">Неактивный</span>
                                    @endif
                                    @if ($user->status === \App\Entity\User\User::STATUS_ACTIVE)
                                        <span class="badge badge-primary">Aктивный</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{$users->appends( Request::query() )->render()}}
@endsection
