@extends('layouts.admin.page')

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

    <div class="row">
        <div class="col-12 ">
            <div class="card">
                <div class=" card-header">
                    <div class=" container" align='center'>
                        <form action="{{ route('admin.celebration.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('admin.celebrations._form')
                            <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
                            <a href="{{ route('admin.celebration.index') }}" class="btn btn-default btn-sm ml-1">Назад</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
