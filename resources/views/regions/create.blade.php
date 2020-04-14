@extends('layouts.region')

@section('content')
    <p></p>
    <div class=" container card-header "><h3>Новый регион</h3></div>
    <div class="container card-header">
        <div class=" container" align='center'>
            <form action="{{ route('region.store') }}"method="post" enctype="multipart/form-data">
                @csrf
                @include('regions.forms.createForms')
                <input type="submit" value="Создать" class="btn btn-primary">
                <a href="{{ route('region.index') }}" class="btn btn-success">Назад</a>
            </form>
        </div>
    </div>


@endsection

