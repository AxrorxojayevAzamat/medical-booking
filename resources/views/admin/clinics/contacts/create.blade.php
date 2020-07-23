@extends('layouts.admin.page')

@section('content')
    <form method="POST" action="{{ route('admin.clinics.contacts.store', $clinic) }}">
        @csrf

        @include('admin.clinics.contacts._form', ['contact' => null])
    </form>
@endsection
