@extends('layouts.admin.page')

@section('content')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('admin.regions.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title">Названия</h3></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_uz" class="col-form-label">Название (узбекское)</label>
                                    <input id="name_uz" class="form-control{{ $errors->has('name_uz') ? ' is-invalid' : '' }}" name="name_uz" value="{{ old('name_uz') }}" required>
                                    @if ($errors->has('name_uz'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('name_uz') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ru" class="col-form-label">Название (русское)</label>
                                    <input id="name_ru" class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru" value="{{ old('name_ru') }}" required>
                                    @if ($errors->has('name_ru'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('name_ru') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-green card-outline">
                    <div class="card-header"><h3 class="card-title">Родительский регион</h3></div>
                    <div class="card-body" id="regions">
                        <div class="form-group" id="form-group-1">
                            <label for="parents" class="col-form-label">Родительский регион</label>
                            <select id="parents" class="form-control parent-region{{ $errors->has('parents') ? ' is-invalid' : '' }}" name="parents[]" data-depth="1">
                                <option value=""></option>
                                @foreach ($parents as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('admin.regions.index') }}" class="btn btn-default">Назад</a>
    </form>
@endsection

@include('admin.regions._script')
