@extends('adminlte::page')
@section('title', 'Специализации')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Специализации') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("admin") }}">{{ __('Главная')}} </a></li>
                <li class="breadcrumb-item active">{{ __('Специализации') }}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-lg-1">
                    <a class="btn btn-success" href="{{ route("admin.specializations.create") }}">{{ __('Добавить') }}</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table id="laravel_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <td>{{ __('Наименование(ru)') }}</td>
                            <td>{{ __('Наименование(uz)') }}</td> 
                            <th style="width: 15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specializations as $specialization)
                        <tr>
                            <td>{{$specialization->id}}</td>
                            <td>{{$specialization->name_ru}}</td>
                            <td>{{$specialization->name_uz}}</td>
                            <td class="project-actions text-right">
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.specializations.show',$specialization->id)}}">
                                        <i class="fas fa-eye">
                                        </i>

                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.specializations.edit',$specialization->id)}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>

                                    </a>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ route('admin.specializations.destroy', $specialization->id)}}" method="post">
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
