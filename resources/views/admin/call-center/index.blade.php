@extends('layouts.admin.page')

@section('content')

 @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @endif
    
<div class="row">
    <div class="col-md-12">

        <div class="card card-danger card-outline">
            <div class="card-header">
                <a class="btn btn-success" href="{{ route("admin.call-center.create-patient") }}">{{ trans('Добавить') }} </a>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="?" method="GET">
                        <div class="row d-flex justify-content-start">
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
                            <div class="col-2">
                                <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('Имя,Фамилия') }}</label>
                                        <input name="name" type="text" class="form-control"  value="{{ request('name') }}">
                                    </div>
                                </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">{{ trans('Телефон') }}</label>
                                    <input id="phone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;999999999&quot;" data-mask="" im-insert="true" name="phone" value="{{ request('phone') }}">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ trans('Email') }}</label>
                                    <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group pl-1">
                                    <label class="col-form-label">&nbsp;</label><br />
                                    <button type="submit" class="btn btn-primary">Поиск</button>
                                    <a href="?" class="btn btn-danger">{{ __('Очистить') }}</a>
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
