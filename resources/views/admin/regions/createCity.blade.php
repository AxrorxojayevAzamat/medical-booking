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

    <div class="card">
        <div class=" container card-header " align='center'><h3>Новый Город</h3></div>
        <div class="container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('admin.region.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.regions.forms.createCityForms')
                    <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
                    <a href="{{ route('admin.region.index') }}" class="btn btn-default btn-sm ml-1">Назад</a>
                </form>
            </div>
        </div>
    </div>



@endsection

