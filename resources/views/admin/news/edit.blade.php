@extends('layouts.admin.page')

@section('content')
    {!! Form::open(['url' => route('admin.news.update', $news), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        @method('PUT')

        @include('partials.admin._nav')

        @include('admin.news._form')
    {!! Form::close() !!}
@endsection
