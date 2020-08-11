@extends('layouts.admin.page')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-danger card-outline">
            <div class="card-header">
                <a class="btn btn-success" href="{{ route("admin.call-center.create-patient") }}">{{ trans('Добавить') }} </a>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="?" method="GET">
                        <div class="row d-flex justify-content-between">
                            <div class="">
                                <div class="form-group">
                                    <label for="id" class="col-form-label">{{ trans('Ид') }}</label>
                                    <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                                    @if ($errors->has('id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">{{ trans('Имя пользователя') }}</label>
                                    <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                                    @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="first_name" class="col-form-label">{{ trans('Имя') }}</label>
                                    <input id="first_name" class="form-control" name="first_name" value="{{ request('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="last_name" class="col-form-label">{{ trans('Фамилия') }}</label>
                                    <input id="last_name" class="form-control" name="last_name" value="{{ request('last_name') }}">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">{{ trans('Телефон') }}</label>
                                    <input id="phone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ request('phone') }}">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ trans('Email') }}</label>
                                    <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group pl-1">
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
                            <th>{{ trans('ID') }}</th>
                            <th>{{ trans('ФИО') }}</th>
                            <th>{{ trans('Телефон') }}</th>
                            <th>{{ trans('Email') }}</th>
                            <th>{{ trans('Роль') }}</th>
                            <th>{{ trans('Статус') }}</th>
                            <th>{{ trans('Действие') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->profile ? $user->profile->fullName : '' }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roleName() }}</td>
                            <td class="project-state">
                                @if ($user->status === \App\Entity\User\User::STATUS_INACTIVE)
                                <span class="badge badge-secondary">Неактивный</span>
                                @endif
                                @if ($user->status === \App\Entity\User\User::STATUS_ACTIVE)
                                <span class="badge badge-primary">Aктивный</span>
                                @endif
                            </td>
                            <td> 
                                <a class="btn btn-block btn-outline-primary btn-sm" href="{{ route('admin.call-center.patient-doctor', $user) }}">{{ trans('Выбрать врача') }}</a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            {{ $users->links() }}
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@stop
