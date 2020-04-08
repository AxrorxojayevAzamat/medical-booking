@extends('layouts.region')

@section('content')
    <form action="{{ route('regions.update',['id'=>$regions->id]) }}"method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @include('regions.forms.forms')
        <input type="submit" value="Редактировать" class="btn btn-primary">
    </form>
@endsection
