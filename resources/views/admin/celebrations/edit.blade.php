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

    <div class="card col-md-6 offset-md-3">
        <div class="  card-header " align="center"><h3>Редактирование праздничного дня</h3></div>
        <div class="container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('admin.celebration.update', $celebrations) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('admin.celebrations.forms.Forms')
                    <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
                    {{-- <a href="{{ route('admin.celebration.index') }}" class="btn btn-default btn-sm ml-1">Назад</a> --}}
                </form>
            </div>
        </div>
    </div>


@endsection
