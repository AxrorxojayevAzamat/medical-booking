@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Добавить Клинику') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи') }}</a></li>
                <li class="breadcrumb-item active">{{ $user->email }}</li>
                <li class="breadcrumb-item active">{{ __('Добавить клинику') }}</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card primary">
            <div class="card-header">
                {{ __('Добавить клинику') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route("admin.users.clinic", $user) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="clinic" class="col-form-label text-md-left">{{ __('Клиники') }}</label>
                                    <select class="select2 select2-hidden-accessible" name="clinicUser[]" multiple="multiple" data-placeholder="{{ __('Клиники') }}" style="width: 100%;">
                                        <option value=""></option>

                                        @foreach($clinics as $id => $clinic)
                                        <option value="{{ $id }}" {{ (in_array($id, old('clinics', [])) || isset($user) && $user->clinics()->pluck('id')->contains($id)) ? 'selected' : '' }}>{{ $clinic }}</option>
                                        @endforeach

                                    </select>


                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success float-left">{{ __('Обновить') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->

        </div>
        <!-- /.card primary-->
    </div>
    <!-- /.col-md -6.3 -->
</div>
<!-- /.row -->

@stop
