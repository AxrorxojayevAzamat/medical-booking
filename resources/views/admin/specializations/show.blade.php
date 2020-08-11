@extends('layouts.admin.page')

@section('content')


<div class="row">
    <div class="col-md-6">
        <div class="d-flex bd-highlight mb-3">
            <a class="btn btn-primary mr-1 p-2 bd-highlight" href="{{route('admin.specializations.edit',$specialization->id)}}">{{ trans('Редактировать') }}</a>
        
                <form method="POST" action="{{ route('admin.specializations.destroy', $specialization->id) }}" class="ml-auto mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger mr-1" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
                </form>
        </div>
        <div class="card primary">
            <div class="card-body">
                <div class="form-group">

                    <label for="name_ru" class="col-form-label text-md-left">{{ __('Название (ru)') }}</label>
                    <input id="name_ru" type="text" class="form-control" name="name_ru" value="{{$specialization->name_ru}}" disabled>
                </div>
                <div class="form-group">

                    <label for="name_uz" class="col-form-label text-md-left">{{ __('Название (uz)') }}</label>
                    <input id="name_uz" type="text" class="form-control" value="{{$specialization->name_uz}}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
