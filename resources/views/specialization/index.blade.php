@extends('layouts.app')

@section('content')

<main>

<div class="col-lg-8 col-md-8 mx-auto">
	<h2 align="center">{{trans('specialization.type_of_doctor')}}</h2>
		<?php $num = 2 ?>
	@if(count($specializations)>50)
		<?php $num = 3 ?>
	@endif
	<div style="columns: {{ $num }}">
		@foreach($specializations as $specialization)
		    <p>
		    	@if($lang=='name_uz')
					<a href="{{route('doctors.index', ['specialization' => $specialization->id])}}">
						{{ $specialization->name_uz }}
					</a>
		    	@else
		      		<a href="{{route('doctors.index', ['specialization' => $specialization->id])}}">
						{{ $specialization->name_ru }}
					</a>
		      	@endif
		    </p>
		@endforeach
	</div>
	<div style="height: 15vh"></div>
</div>
</main>

@endsection
