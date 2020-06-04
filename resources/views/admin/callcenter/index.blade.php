@extends('adminlte::page')

@section('breadcrumbs', '')

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
                                        <label for="region" class="col-form-label">{{ __('Регион') }}</label>
                                        <select class="form-control" name="region" id="region">
                                            <option ></option>
                                            @foreach($regionList as $value => $label)
                                            <option value="{{ $value }}"{{ $value == request('region') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="city" class="col-form-label">{{ __('Город') }}</label>
                                        <select class="form-control" name="city" id="city">
                                            <option value="" selected=""></option>
                                            @foreach ($cityList as $value => $label)
                                            <option value="{{ $value }}"{{ $value == request('city') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
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
                                            <option value="{{ $value }}"{{ $value == request('type') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="clinic" class="col-form-label">{{ __('Название') }}</label>
                                        <select class="form-control" name="clinic" id="clinic">
                                            <option></option>
                                            @foreach ($clinicList as $value => $label)
                                            <option value="{{ $value }}"{{ $value == request('clinic') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
                                        </select>
                                        <label></label>
                                    </div>
                                </div>                         
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">{{ __('Имя,Фамилия,Направление') }}</label>
                                        <input name="name" type="text" class="form-control"  value="{{ request('name') }}" placeholder="Имя,Фамилия,Направление ...">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">{{ __('Поиск') }}</button>
                                        <a href="?" class="btn btn-outline-secondary">{{ __('Очистить') }}</a>
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
                                <td>{{$user->name}}</td>
                                <td>{{$clinic->name_ru}}</td>
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