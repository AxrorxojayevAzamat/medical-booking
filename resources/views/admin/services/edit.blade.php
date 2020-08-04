@extends('layouts.admin.page')

@section('content')
    {!! Form::open(['url' => route('admin.services.update', $service), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        @method('PUT')

        @include('partials.admin._nav')

        @include('admin.services._form')
    {!! Form::close() !!}
@endsection
