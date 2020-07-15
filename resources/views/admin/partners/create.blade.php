@extends('layouts.admin.page')
@section('content')
    

<form action="{{ route('admin.partners.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-body">
                    <div class="form-group">

                        <label for="name_ru" class="col-form-label text-md-left">{{ __('Название (ru)') }}</label>
                        <input id="name_ru" type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" value="{{ old('name_ru') }}" required autocomplete="name_ru" autofocus>

                        @error('name_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="name_uz" class="col-form-label text-md-left">{{ __('Название (uz)') }}</label>
                        <input id="name_uz" type="text" class="form-control @error('name_uz') is-invalid @enderror" name="name_uz" value="{{ old('name_uz') }}" required autocomplete="name_uz" autofocus>

                        @error('name_uz')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
        {{-- <a href="{{ route('admin.regions.index') }}" class="btn btn-default btn-sm ml-1">Назад</a> --}}
    </div>
</form>
@endsection