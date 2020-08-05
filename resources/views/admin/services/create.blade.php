@extends('layouts.admin.page')

@section('content')
    {!! Form::open(['url' => route('admin.services.store'), 'method' => 'POST',  'enctype' => 'multipart/form-data']) !!}
        @csrf

        @include('partials.admin._nav')

        @include('admin.services._form', ['service' => null])
    {!! Form::close() !!}
@endsection
