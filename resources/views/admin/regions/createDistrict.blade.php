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
        <div class=" container card-header "><h3>Новый район</h3></div>
        <div class="container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('region.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.regions.forms.createDistrictForms')
                    <input type="submit" value="Создать" class="btn btn-success">
                    <a href="{{ route('region.index') }}" class="btn btn-default">Назад</a>
                </form>
            </div>
        </div>
    </div>



@endsection

