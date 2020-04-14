@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Показать специализацию') }}</div>

        <div class="card-body">
          @csrf

          <div class="form-group row">
            <label for="name_ru" class="col-md-4 col-form-label text-md-right">{{ __('Наименование(ru)') }}</label>

            <div class="col-md-6">
              <input id="name_ru" type="text" readonly class="form-control" name="name_ru" value="{{$specialization->name_ru}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="name_uz" class="col-md-4 col-form-label text-md-right">{{ __('Наименование(uz)') }}</label>

            <div class="col-md-6">
              <input id="name_uz" type="text" readonly class="form-control" name="name_uz" value="{{$specialization->name_uz}}">
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection