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

                @include('admin.specializations._form')

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-success">{{ __('Сохранить') }}</button>
            {{-- <a class="btn btn-secondary" href="{{ route("admin.specializations.index") }}">{{ __('Отменить') }}</a> --}}
        </div>
    </div>
</form>
@stop
