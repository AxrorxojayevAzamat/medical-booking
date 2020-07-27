@extends('layouts.admin.page')

@section('content')
<div class="d-flex bd-highlight mb-3">
    <a class="btn btn-primary mr-1 p-2 bd-highlight" href="{{ route('admin.partners.edit',$partner)}}">{{ trans('Редактировать') }}</a>
    

        <form method="POST" action="{{ route('admin.partners.destroy', $partner->id) }}" class="ml-auto mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mr-1" onclick="return confirm('{{ 'Вы уверены?' }}')">{{ trans('Удалить') }}</button>
        </form>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title">Основной</h3></div>
            <div class="card-body">
                <table class="table {{--table-bordered--}} table-striped projects">
                    <tbody>
                    <tr><th>ID</th><td>{{ $partner->id }}</td></tr>
                    <tr><th>Название (uz)</th><td>{{ $partner->name }}</td></tr>
                    <tr><th>Ссылка</th><td>{{ $partner->site_url }}</td></tr>
                    <tr><th>Очередь</th><td>{{ $partner->sort }}</td></tr>
                    @foreach($statuses as $value => $label)
                        @if($partner->status === $value)
                        <tr><th>Статус</th><td>{{ $label }}</td></tr>
                        @endif
                    @endforeach

                    <tr><th>Фото</th><td><a href="{{ $partner->fileOriginal }}" target="_blank" class="img-thumbnail"><img src="{{ $partner->fileThumbnail }}"></a></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@can('admin-panel')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-green card-outline">
                    <div class="card-header"><h3 class="card-title">Другие</h3></div>
                    <div class="card-body">
                        <table class="table table-striped projects">
                            <tbody>
                            <tr><th>Добавлено</th><td>{{ $partner->created_at }}</td></tr>
                            <tr><th>Редактировано</th><td>{{ $partner->updated_at }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection