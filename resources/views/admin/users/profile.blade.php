@extends('adminlte::page')

@section('content_header')
<h1>Profile</h1>
@stop

@section('content')
<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="/uploads/avatars/{{ $user->avatar }}"
                 alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ $user->lastname }} {{ $user->name }}</h3>

        <form enctype="multipart/form-data" action="{{ route("admin.users.update_avatar") }}" method="POST">
            <label>Update Profile Image</label>
            <input type="file" name="avatar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="pull-right btn btn-sm btn-primary">
        </form>

    </div>
    <!-- /.card-body -->
</div>





@stop

