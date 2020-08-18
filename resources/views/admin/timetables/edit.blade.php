@extends('layouts.admin.page')
@section('content')
	@if(Session::has('error'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  @include('partials.timetable.error')
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	@endif
    <form action="{{route('admin.timetables.update', [$user, $timetable])}}" method="post", enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.timetables._form')
    </form>
@endsection
