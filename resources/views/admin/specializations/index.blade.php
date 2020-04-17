@extends('adminlte::page')
@section('title', 'Специализации')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Специализации</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                <li class="breadcrumb-item active">Specializations</li>
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
                    <a class="btn btn-block btn-success" href="{{ route("admin.specializations.create") }}">
                        Добавить
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table id="laravel_datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <td>Наименование(ru)</td>
                            <td>Наименование(uz)</td> 
                            <th style="width: 25%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specializations as $specialization)
                        <tr>
                            <td>{{$specialization->id}}</td>
                            <td>{{$specialization->name_ru}}</td>
                            <td>{{$specialization->name_uz}}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.specializations.show',$specialization->id)}}">
                                    <i class="fas fa-folder">
                                    </i>
                                    Посмотреть    
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('admin.specializations.edit',$specialization->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Редактировать   
                                </a>
                                <a class="btn">
                                    <form action="{{ route('admin.specializations.destroy', $specialization->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash">
                                            </i>Удалить
                                        </button>
                                    </form>   
                                </a>

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
<!--@section('js')
<script>
    $(document).ready(function () {
        $('#laravel_datatable').DataTable();
    });
</script>
@stop-->