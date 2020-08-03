@extends('doctor.base')

@section('content')
<div class="content-wrapper">
        <div class="container-fluid" style="margin-top: 60px">
            <div class="box_general padding_bottom">

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
<h1 align="center">{{trans('menu.main_photo')}} <a href="{{route('doctor.profileEdit')}}" style="float: right;">{{trans('menu.back')}}</a></h1>

<div class="card" id="photos">
    <div class="card-body">
        <form method="POST" action="{{ route('doctor.add-main-photo', Auth::id()) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="file-loading">
                    <input id="file-input" class="file" type="file" name="photo">
                </div>
                @if ($errors->has('logo'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Сохранить</button>
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
    let logoUrl = '{{ $profile ? ($profile->main_photo_id ? $profile->mainPhoto->fileOriginal : null) : null }}';

    if (logoUrl) {
        let send = XMLHttpRequest.prototype.send, token = $('meta[name="csrf-token"]').attr('content');
        console.log(token)
        XMLHttpRequest.prototype.send = function(data) {
            this.setRequestHeader('X-CSRF-Token', token);
            return send.apply(this, arguments);
        };

        fileInput.fileinput({ 
            language: "ru",
            initialPreview: [logoUrl],
            initialPreviewAsData: true,
            showUpload: false,
            previewFileType: 'text',
            browseOnZoneClick: true,
            overwriteInitial: true,
            deleteUrl: 'remove-main-photo',
            maxFileCount: 1,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        });
    } else {
        fileInput.fileinput({
            language: "ru",
            showUpload: false,
            previewFileType: 'text',
            browseOnZoneClick: true,
            maxFileCount: 1,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        });
    }
</script>
@endsection




