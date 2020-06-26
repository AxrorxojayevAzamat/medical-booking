@extends('layouts.admin.page')

@section('content')
<form method="POST" action="{{ route("admin.specializations.update", $specialization) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="card primary">
                <div class="card-header">
                    {{ __('Редактировать специализацию') }}
                </div>
                <!-- /.card-header -->


                <div class="card-body">
                    <div class="form-group">

                        <label for="name_ru" class="col-form-label text-md-left">{{ __('Наименование(ru)') }}</label>
                        <input id="name_ru" type="text" class="form-control @error('name_ru') is-invalid @enderror" name="name_ru" value="{{ old('name_ru', isset($specialization) ? $specialization->name_ru : '') }}" required autocomplete="name_ru" autofocus>

                        @error('name_ru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="name_uz" class="col-form-label text-md-left">{{ __('Наименование(uz)') }}</label>
                        <input id="name_uz" type="text" class="form-control @error('name_uz') is-invalid @enderror" name="name_uz" value="{{ old('name_uz', isset($specialization) ? $specialization->name_uz : '') }}" required autocomplete="name_uz" autofocus>

                        @error('name_uz')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
                <!-- /.card-footer -->

            </div>
            <!-- /.card primary-->
        </div>
        <!-- /.col-md -6 -->
    </div>
    <!-- /.row -->
    <div class="row no-print">
        <div class="col-12">
            <button type="submit" class="btn btn-success float-right">{{ __('Сохранять') }}</button>
            <a class="btn btn-secondary float-right" style="margin-right: 5px; href="{{ route("admin.specializations.index") }}">{{ __('Отменить') }}</a>
        </div>
    </div>
    <!-- /.row -->
</form>
@stop
