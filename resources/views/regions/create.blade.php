@extends('layouts.region')

@section('content')

    <form action="{{ route('regions.store') }}"method="post" enctype="multipart/form-data">
        @csrf
        <font color="white"><h3>Создать новый Регион</h3></font>

        @include('regions.forms.forms')

        <input type="submit" value="Создать" class="btn btn-primary">
    </form>

@endsection

