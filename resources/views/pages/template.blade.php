@extends('layouts.app')

@section('content')
<div class="px-5">
@if(Session::get('locale')=='uz')
	<h1 align="center">{{$page->title_uz}}</h1>
	<p>{!!$page->content_uz!!}</p>
@else
	<h1 align="center">{{$page->title_ru}}</h1>
	<p>{!!$page->content_ru!!}</p>
@endif
</div>
@endsection