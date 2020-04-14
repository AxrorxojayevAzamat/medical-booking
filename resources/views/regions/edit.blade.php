@extends('adminlte::page')
@section('content')
    <p></p>
    <div class=" container card-header "><h3 >Редактирование</h3></div>
    <div class="container card-header">
        <div class=" container" align='center'>
            <form action="{{ route('region.update',['id'=>$regions->id]) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                @include('regions.forms.editForms')
                <br>

            </form>
        </div>
@endsection
