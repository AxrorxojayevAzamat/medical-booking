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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-footer">
                    <a class="btn btn-success" href="{{ route("admin.users.create") }}">{{ __('Добавить') }} </a> 
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="id" class="col-form-label">{{ __('ID') }}</label>
                                        <input id="id" class="form-control {{ $errors->has('id') ? 'is-invalid' : '' }}" name="id" value="{{ request('id') }}" >

                                        @if ($errors->has('id'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('id') }}</strong>
                                        </div>
                                        @endif
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
                                        <label for="email" class="col-form-label">{{ __('Email') }}</label>
                                        <input id="email" class="form-control" name="email" value="{{ request('email') }}">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label">{{ __('Роль') }}</label>
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
                                        <label for="status" class="col-form-label">{{ __('Статус') }}</label>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending";>{{ __('ID') }}</th>
                                <th>{{ __('Имя') }}</th>
                                <th>{{ __('Фамилия') }}</th>
                                <th>{{ __('Телефон') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Роль') }}</th>
                                <th>{{ __('Статус') }}</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach ($roles as $value => $label)
                                    @if ($value === $user->role)
                                    {{$label}}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="project-state">
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
                                </td>
                                <td class="project-actions text-right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show',$user->id)}}">
                                            <i class="fas fa-eye">
                                            </i>

                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit',$user->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>

                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ route('admin.users.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Вы уверены?')">
                                                <i class="fas fa-trash">
                                                </i>
                                            </button>
                                        </form> 
                                    </div>
                                </td>
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