@extends('layouts.admin.page')
@section('content')
    

<form action="{{ route('admin.partners.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-left">{{ __('Название') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('name_uz') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="site_url" class="col-form-label text-md-left">{{ __('Ссылка сайта') }}</label>
                        <input id="site_url" type="text" class="form-control @error('site_url') is-invalid @enderror" name="site_url" value="{{ old('site_url') }}" required autocomplete="name_uz" autofocus>
                        @if ($errors->has('site_url'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('site_url') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="sort" class="col-form-label text-md-left">{{ __('Сортировка очереди') }}</label>
                        <input id="sort" type="number" class="form-control @error('sort') is-invalid @enderror" name="sort" value="{{ old('sort') }}" autocomplete="name_uz" autofocus>
                        @if ($errors->has('sort'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label text-md-left">{{ trans('Статус') }}</label>
                        <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                            @foreach($status as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                        @enderror
                    </div>
                    <div class="card" id="photos">
                        <div class="card-body">
                                <div class="form-group">
                                    <div class="file-loading">
                                        <input id="file-input" class="file" type="file" name="photo">
                                    </div>
                                    @if ($errors->has('logo'))
                                        <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                                    @endif
                                </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-success btn-sm ml-1">Сохранить</button>
    </div>
</form>
@endsection
@section('js')
<script>
    let fileInput = $("#file-input");
        fileInput.fileinput({
            language: "ru",
            showUpload: false,
            previewFileType: 'text',
            browseOnZoneClick: true,
            maxFileCount: 1,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        });
    
</script>
@endsection