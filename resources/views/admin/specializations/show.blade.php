@extends('adminlte::page')
@section('title', 'Специализации')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Показать специализацию') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная')}} </a></li>
                <li class="breadcrumb-item"><a href="{{ route("admin.specializations.index") }}">{{ __('Специализации')}}</a></li>
                <li class="breadcrumb-item active">{{ __('Показать специализацию')}}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Показать специализацию') }}
            </div>
            <!-- /.card-header -->


            <div class="card-body">
                <div class="form-group">

                    <label for="name_ru" class="col-form-label text-md-left">{{ __('Наименование(ru)') }}</label>
                    <input id="name_ru" type="text" class="form-control" name="name_ru" value="{{$specialization->name_ru}}" disabled>
                </div>
                <div class="form-group">

                    <label for="name_uz" class="col-form-label text-md-left">{{ __('Наименование(uz)') }}</label>
                    <input id="name_uz" type="text" class="form-control" value="{{$specialization->name_uz}}" disabled>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->

        </div>
        <!-- /.card primary-->
    </div>
    <!-- /.col-md -6 -->
</div>
<!-- /.row -->
@stop