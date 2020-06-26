@extends('layouts.admin.page')
@section('content')


<div class="card" id="photos">
    <div class="card-header border">Фотографии клиники</div>
    <div class="card-body">
        {{-- <form method="POST" action="{{ route('admin.clicnics.add-main-photo', $clinics) }}" enctype="multipart/form-data"> --}}
        <form method="POST" action="" enctype="multipart/form-data">
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

@endsection

@section('script')
<script>
    let fileInput = $("#file-input");
    let logoUrl = '{{ $clinic ? ($clinic->main_photo_id ? $product->mainPhoto->fileOriginal : null) : null }}';

    if (logoUrl) {
        let send = XMLHttpRequest.prototype.send, token = $('meta[name="csrf-token"]').attr('content');
        XMLHttpRequest.prototype.send = function(data) {
            this.setRequestHeader('X-CSRF-Token', token);
            return send.apply(this, arguments);
        };

        fileInput.fileinput({
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
            showUpload: false,
            previewFileType: 'text',
            browseOnZoneClick: true,
            maxFileCount: 1,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        });
    }
</script>
@endsection
