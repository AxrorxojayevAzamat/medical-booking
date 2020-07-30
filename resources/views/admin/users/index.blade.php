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
                                        <label for="id" class="col-form-label">{{ trans('Ид') }}</label>
                                        <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                                        @if ($errors->has('id'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('id') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">{{ trans('Имя пользователя') }}</label>
                                        <input id="first_name" class="form-control" name="first_name" value="{{ request('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="last_name" class="col-form-label">{{ trans('Фамилия') }}</label>
                                        <input id="last_name" class="form-control" name="last_name" value="{{ request('last_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ trans('Телефон') }}</label>
                                        <input id="phone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 99 999-9999&quot;" data-mask="" im-insert="true" name="phone" value="{{ request('phone') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">{{ trans('Email') }}</label>
                                        <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label">{{ trans('Роль') }}</label>
                                        <select id="role" class="form-control" name="role">
                                            <option value=""></option>
                                            @foreach ($roles as $value => $label)
                                            <option value="{{ $value }}"{{ $value === request('role') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label">{{ trans('Статус') }}</label>
                                        <select id="status" class="form-control" name="status">
                                            <option value=""></option>
                                            @foreach ($statuses as $value => $label)
                                            <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">Поиск</button>
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
                                {{-- <td>{{ $user->profile ? $user->profile->fullName : '' }}</td> --}}
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

    {{ $users->links() }}
@endsection
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
