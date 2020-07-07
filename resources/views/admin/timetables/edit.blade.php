@extends('layouts.admin.page')
@section('content')
    <form action="{{route('admin.timetables.update', [$user, $timetable])}}" method="post", enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.timetables._form')
    </form>
@endsection
