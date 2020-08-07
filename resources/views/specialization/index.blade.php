@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-md-10 mx-auto mt-4">
  {{-- <h2 align="center">{{trans('specialization.type_of_doctor')}}</h2> --}}
    <?php $num = 4 ?>
  @if(count($specializations)>50)
    <?php $num = 3; $relative = "relative" ?>
  @endif
  <div class="list_home">
		<ul class="row d-flex justify-content-start pb-3">
			@foreach($specializations as $specialization)
			<li class="my-3 col-lg-{{$num}} col-md-6 col-sm-12">
				@if($lang=='name_uz')
				<a href="{{route('doctors.index', ['specialization' => $specialization->id])}}">
					{{ $specialization->name_uz }}
				</a>
				@else
				<a href="{{route('doctors.index', ['specialization' => $specialization->id])}}">
					{{ $specialization->name_ru }}
				</a>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
</div>
@include('specialization.spec-css')
@endsection
