@extends('adminlte::page')
@section('title','Клиники')
@section('content_header')

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Клиники</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="http://localhost:8081/home">Главная </a></li>
                            <li class="breadcrumb-item"><a href="http://localhost:8081/clinic">Список клиник</a></li>
                            <li class="breadcrumb-item active">Новая клиника</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

@stop
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

    <div class=" card col-md-10 offset-md-1">
        <div class="  card-header " align="center"><h3>Добавление Новой Клиники</h3></div>
        <div class=" card-header">
            <div  align='center'>
                <form action="{{ route('admin.clinic.store') }}" method="post" enctype="multipart/form-data" id="upload">
                    @csrf
                    @include('admin.clinics.forms.Forms')
                    <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
                    <a href="{{ route('admin.clinic.index') }}" class="btn btn-default btn-sm ml-1">Назад</a>
                </form>
            </div>
        </div>
    </div>

@endsection



