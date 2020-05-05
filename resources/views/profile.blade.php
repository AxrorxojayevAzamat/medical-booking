@extends('adminlte::page')

@section('content_header')
<h1>{{ __('Профиль пользователя') }}</h1>
@stop

@section('content')
<div class="col-md-6">
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                @if( !empty($user->avatar))
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="/uploads/avatars/{{ $user->avatar }}"
                         alt="Фотография пользователя">
                </div>
                @endif
            </div>

            <h3 class="profile-username text-center">{{ $user->lastname }} {{ $user->name }}</h3>

            <div class="form-group">
                <form id="blaForm" method="POST" enctype="multipart/form-data" action="{{ route("profile.update") }}">
                    @csrf
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="avater" class="custom-file-input" name="avatar" >
                            <label class="custom-file-label" for="avatar">{{ __('Выберите файл') }}</label>
                        </div>       
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text" id="">
                                {{ __('Обновить') }}
                            </button>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>





        @stop

