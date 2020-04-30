@extends('adminlte::page')
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

    <div class="content-header">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Праздничные дни</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="http://localhost:8081/home">Главная </a></li>
                            <li class="breadcrumb-item"><a href="http://localhost:8081/celebration">Список праздничных дней</a></li>
                            <li class="breadcrumb-item active">Новый праздничный день</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>

    <div class=" card col-md-6 offset-md-3">
        <div class="  card-header " align="center"><h3>Добавление праздничного дня</h3></div>
        <div class=" container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('celebration.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.celebrations.forms.Forms')
                    <button type="submit" class="btn btn-success btn-sm ml-1"><i
                            class="fas fa-check"></i></button>
                    <a href="{{ route('celebration.index') }}" class="btn btn-default btn-sm ml-1"><i
                            class="fas fa-arrow-left"></i> Назад</a>
                </form>
            </div>
        </div>
    </div>


@endsection
