@extends('layouts.admin.page')
@section('content')
    
    <form action="{{route('admin.timetables.update', [$user,$timetable])}}" method="post", enctype="multipart/form-data">
        @csrf
        @include('admin.timetables._form')
    </form>
@endsection
