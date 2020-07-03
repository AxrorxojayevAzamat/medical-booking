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
    
    <form action="{{route('admin.timetables.store', ['user_id'=>$user->id,'clinic_id'=>$clinic->id])}}" method="post", enctype="multipart/form-data">
        @csrf
        @include('admin.timetables._form', ['timetable' => null])
    </form>
@endsection
