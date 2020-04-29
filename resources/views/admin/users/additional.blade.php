@extends('adminlte::page')
@section('title', 'Пользователи')
@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('Добавить специализации') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">{{ __('Главная') }} </a></li>
                <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">{{ __('Пользователи') }}</a></li>
                <li class="breadcrumb-item active">{{ $user->email }}</li>
                <li class="breadcrumb-item active">{{ __('Добавить специализации') }}</li>
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
                {{ __('Добавить специализации') }}
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route("admin.users.specialization", $user) }}">
                        @csrf
                        {{--@method('PUT')--}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <label for="specialization" class="col-form-label text-md-left">{{ __('Специализации') }}</label>
                                    <select class="select2 select2-hidden-accessible" name="specializationUser[]" multiple="multiple" data-placeholder="{{ __('Специализации') }}" style="width: 100%;">
                                        <option value=""></option>

                                        @foreach($specializations as $id => $spec)
                                        <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || isset($user) && $user->specializations()->pluck('id')->contains($id)) ? 'selected' : '' }}>{{ $spec }}</option>
                                        @endforeach

                                    </select>

                                    @error('specializationUser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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