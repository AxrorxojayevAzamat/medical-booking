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

    <div class=" card col-md-10 offset-md-1">
        <div class="  card-header " align="center"><h3>Редактирование Клиники</h3></div>
        <div class=" card-header">
            <div  align='center'>
                <form action="{{ route('admin.clinics.update',$clinics->id) }}" method="post" enctype="multipart/form-data" id="upload">
                    @csrf
                    @method('PATCH')
                    @include('admin.clinics.forms.editForms')
                    <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
                    <a href="{{ route('admin.clinics.index') }}" class="btn btn-default btn-sm ml-1">Назад</a>
                </form>
            </div>
        </div>
    </div>

@endsection
