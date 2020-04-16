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

    <p></p>
    <div class="card">
    <div class="  container card-header row "><h3 >Редактирование</h3> <a href="{{ route('region.index') }}" class="btn btn-success ml-5">Назад</a></div>
    <div class="container card-header">
        <div class=" container" align='center'>
            <form action="{{ route('region.update',['id'=>$regions->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @include('regions.forms.editForms')
                <div class="form-group " align='center'>
                    <input type="submit" value="Сохранить" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    </div>


@endsection
