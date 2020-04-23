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


    <div class=" card col-md-6 offset-md-3">
        <div class="  card-header " align="center"><h3>Добавление праздничного дня</h3></div>
        <div class=" container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('celebration.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.celebrations.forms.Forms')
                    <input type="submit" value="Создать" class="btn btn-success">
                    <a href="{{ route('celebration.index') }}" class="btn btn-default">Назад</a>
                </form>
            </div>
        </div>
    </div>


@endsection
