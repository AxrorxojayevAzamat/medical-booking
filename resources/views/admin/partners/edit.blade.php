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
    
    
    
    <form action="{{ route('admin.partners.update', $partner) }}" method="post"enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-12">
                <div class="card primary">
                    <div class="card-header">
                        {{ __('Редактировать специализацию') }}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Название</label>
                            <input id="name" class="form-control{{ $errors->has('site_url') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $partner->name) }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="site_url" class="col-form-label">Ссылка</label>
                            <input id="site_url" class="form-control{{ $errors->has('site_url') ? ' is-invalid' : '' }}" name="site_url" value="{{ old('site_url', $partner->site_url) }}" required>
                            @if ($errors->has('site_url'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('site_url') }}</strong></span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="sort" class="col-form-label">Сортировка</label>
                            <input id="sort" type="number" class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}" name="sort" value="{{ old('sort', $partner->sort) }}" required>
                            @if ($errors->has('sort'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('sort') }}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-form-label">Статус</label>
                            <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>
                                @foreach($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === $partner->status ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback"><strong>{{ $errors->first('status') }}</strong></span>
                            @enderror
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header"><h3 class="card-title">Изображение</h3></div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="file-loading">
                                <input id="file-input" class="file" type="file" name="photo">
                            </div>
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('photos') }}</strong></span>
                            @endif
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
    let logoUrl = '{{ $partner ? ($partner->photo ? $partner->fileOriginal : null) : null }}';

    if (logoUrl) {
    let send = XMLHttpRequest.prototype.send, token = $('meta[name="csrf-token"]').attr('content');
        XMLHttpRequest.prototype.send = function(data) {
            this.setRequestHeader('X-CSRF-Token', token);
            return send.apply(this, arguments);
        };
        fileInput.fileinput({
            language: "ru",
            initialPreview: [logoUrl],
            initialPreviewAsData: true, showUpload: false,
            previewFileType: 'text',
            browseOnZoneClick: true,
            maxFileCount: 1,
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            deleteUrl: 'delete-photo',
        });
    }else {
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

