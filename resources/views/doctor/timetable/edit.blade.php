@extends('doctor.base')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid" style="margin-top: 60px">
        <div class="box_general padding_bottom">
		<h1 align="center">{{trans('menu.timetable')}}</h1>
		@if(Session::has('error'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  @include('partials.timetable.error')
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif
    <form action="{{route('doctor.update', [$user, $timetable])}}" method="post", enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.timetables._form')
    </form>
		</div>
	</div>
</div>
@endsection
