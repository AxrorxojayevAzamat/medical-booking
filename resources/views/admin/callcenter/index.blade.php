@extends('adminlte::page')
@section('title','AdminCallCenter')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('AdminCallCenter') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item active">{{ __('AdminCallCenter') }}</li>
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
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body">
                        <form action="?" method="GET">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="reg1" class="col-form-label">{{ __('Регион') }}</label>
                                        <select class="form-control" name="reg1" id="reg1">
                                            <option></option>
                                            @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name_ru}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="region" class="col-form-label">{{ __('Город') }}</label>
                                        <select class="form-control" name="region" id="reg1">
                                            <option disabled>{{ __('Выберете регион сначала') }}</option>
                                        </select>
                                        <label></label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="type" class="col-form-label">{{ __('Тип клиники ') }}</label>
                                        <select id="type" class="form-control @error('status') is-invalid @enderror" name="type" value="{{ old('type') }}" autocomplete="type" autofocus>
                                            <option value="" selected=""></option>
                                            @foreach ($clinicTypeList as $value => $label)
                                            <option value="{{ $value }}"{{ $value === request('type') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="clinic" class="col-form-label">{{ __('Название') }}</label>
                                        <select class="form-control" name="clinic" id="clinic">
                                            <option disabled>{{ __('Выберете Тип клиники сначала') }}</option>
                                        </select>
                                        <label></label>
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
                                <th>{{ __('Направление') }}</th>
                                <th>{{ __('Врач') }}</th>
                                <th>{{ __('Клиника') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clinics as $clinic)
                            @foreach ($clinic->users as $user)
                            @foreach ($user->specializations as $spec)
                            <tr>
                                <td>{{$spec->name_ru}}</td>
                                <td>{{$clinic->name_uz}}</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            @endforeach
                            @endforeach
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