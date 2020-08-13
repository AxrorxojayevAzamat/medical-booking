@extends('doctor.base')

@section('content')
<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
          @include('doctor.breadcrumbs')

            <div class="box_general padding_bottom">
@if($errors->count() > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
@endif
{{-- <h1 align="center">{{trans('menu.photos')}} <a href="{{route('doctor.profile')}}" style="float: right;">{{trans('menu.back')}}</a></h1> --}}

<div class="card" id="photos">
    <div class="card-header border">{{ trans('') }}</div>
    <div class="card-body">
        <div class="row">
            @foreach($profile->photos as $photo)
                <div class="col-md-2 col-xs-3" style="text-align: center">
                    <div class="btn-group">
                        <a href="{{ route('doctor.move-photo-up', ['user' => $profile->user_id , 'photo' => $photo]) }}" id="{{ $profile ->user_id }}" photo_id="{{ $photo->id }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-left"></span>
                        </a>
                        <a href="{{ route('doctor.delete-photo', ['user' =>  $profile->user_id , 'photo' => $photo]) }}" id="{{ $profile ->user_id }}" photo_id="{{ $photo->id }}" class="btn btn-default" onclick="return confirm('{{ trans('Действительно хотите удалить?') }}')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <a href="{{ route('doctor.move-photo-down', ['user' =>  $profile->user_id , 'photo' => $photo]) }}" id="{{ $profile ->user_id }}" photo_id="{{ $photo->id }}" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </a>
                    </div>
                    <div style="margin-top: 10px;">
                        <a href="{{ $photo->fileOriginal }}" target="_blank" class="img-thumbnail"><img src="{{ $photo->fileThumbnail }}"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header border">{{ trans('') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('doctor.add-photo', Auth::id()) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="file-loading">
                    <input id="file-input" class="file" type="file" name="photo">
                </div>
                @if ($errors->has('photo'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('photo') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">{{ trans('Сохранить') }}</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

@endsection
@section('js')
<script>
    let fileInput = $("#file-input");
    fileInput.fileinput({
        language: "ru",
        showUpload: false,
        previewFileType: 'text',
        browseOnZoneClick: true,
        overwriteInitial: false,
        allowedFileExtensions: ['jpg', 'jpeg', 'png'],

    });
</script>
@endsection