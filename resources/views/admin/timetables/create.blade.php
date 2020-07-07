@extends('layouts.admin.page')

@section('content')
    <form action="{{route('admin.timetables.store', ['user_id'=>$user->id,'clinic_id'=>$clinic->id])}}" method="post", enctype="multipart/form-data">
        @csrf
        @include('admin.timetables._form', ['timetable' => null])
    </form>
@endsection
