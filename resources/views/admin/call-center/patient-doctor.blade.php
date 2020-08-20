@extends('layouts.admin.page')

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
                                        <label for="name" class="col-form-label">{{ __('Имя,Фамилия') }}</label>
                                        <input name="name" type="text" class="form-control"  value="{{ request('name') }}">
                                    </div>
                                </div>
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
                                        <label for="clinic" class="col-form-label">{{ __('Название клиники') }}</label>
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
                                        <label for="spec" class="col-form-label">{{ __('Направление') }}</label>
                                        <select class="form-control" name="spec" id="spec">
                                            <option></option>
                                            @foreach ($specList as $value => $label)
                                            <option value="{{ $value }}"{{ $value == request('spec') ? ' selected' : '' }}>{{ $label }}</option>
                                            @endforeach;
                                        </select>
                                        <label></label>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" class="btn btn-primary">{{ __('Поиск') }}</button>
                                        <a href="?" class="btn btn-danger">{{ __('Очистить') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th>{{ trans('Врач') }}</th>
                                <th>{{ trans('Специализации') }}</th>
                                <th>{{ trans('Клиники') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                            <tr>
                                <td><a href="{{ route('admin.call-center.show-doctor',[$user, $doctor]) }}">{{ $doctor->profile ? $doctor->profile->fullName : '' }}</a></td>
                                <td>
                                    @foreach($doctor->specializations()->pluck('name_ru') as $value)
                                    {{ $loop->first ? '' : ', ' }}
                                    {{$value}}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($doctor->clinics()->pluck('name_ru') as $value)
                                    {{ $loop->first ? '' : ', ' }}
                                    {{$value}}
                                    @endforeach
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

    @include('admin.call-center._script')
