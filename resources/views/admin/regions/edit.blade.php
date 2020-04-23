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
        <div class="  container card-header row "><h3>Редактирование региона</h3></div>
        <div class="container card-header">
            <div class=" container" align='center'>
                <form action="{{ route('region.update',['id'=>$regions->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    @include('admin.regions.forms.editForms')
                    <div class="form-group " align='center'>
                        <input type="submit" value="Сохранить" class="btn btn-success">
                        <a href="{{ route('region.index') }}" class="btn btn-default ">Назад</a></div>
                </form>
            </div>
        </div>
    </div>



@endsection
