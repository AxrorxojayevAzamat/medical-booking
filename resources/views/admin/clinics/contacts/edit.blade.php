@extends('layouts.admin.page')

@section('content')
    <form method="POST" action="{{ route('admin.clinics.contacts.update', ['clinic' => $clinic, 'contact' => $contact]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.clinics.contacts._form')
    </form>
@endsection
