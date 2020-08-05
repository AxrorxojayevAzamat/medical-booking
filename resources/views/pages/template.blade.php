@extends('layouts.app')

@section('content')

<h1 align="center">{{$page->slug}}</h1>

<p>{{$page->title_uz}}</p>
<p>{!!$page->content_uz!!}</p>

@endsection