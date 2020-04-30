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
                        <h1>Регионы</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="http://localhost:8081/home">Главная </a></li>
                            <li class="breadcrumb-item"><a href="http://localhost:8081/region">Список регионов </a></li>
                            <li class="breadcrumb-item active">Редектирование региона</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <div class="card">
        <div class="  container card-header row "><h3>Редактирование региона</h3></div>
        <div class="container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('region.update',['id'=>$regions->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('admin.regions.forms.editForms')
                    <div class="form-group " align='center'>
                        <button type="submit" class="btn btn-success btn-sm ml-1"><i
                                class="fas fa-check"></i></button>
                        <a href="{{ route('region.index') }}" class="btn btn-default btn-sm ml-1"><i
                                class="fas fa-arrow-left"></i> Назад</a></div>
                </form>
            </div>
        </div>
    </div>



@endsection
