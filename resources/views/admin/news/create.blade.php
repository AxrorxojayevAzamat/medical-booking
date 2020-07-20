@extends('layouts.admin.page')

@section('content')
    {!! Form::open(['url' => route('admin.news.store'), 'method' => 'POST',  'enctype' => 'multipart/form-data']) !!}
        @csrf

        @include('partials.admin._nav')

        @include('admin.news._form', ['news' => null])
    {!! Form::close() !!}
@endsection
