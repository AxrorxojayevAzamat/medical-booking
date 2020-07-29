@extends('layouts.admin.page')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Основной</h3></div>
                <div class="card-body">
                    <table class="table {{--table-bordered--}} table-striped projects">
                        <tbody>
                        <tr><th>ID</th><td>{{ $service->id }}</td></tr>
                        <tr><th>Название (узбекское)</th><td>{{ $service->name_uz }}</td></tr>
                        <tr><th>Название (русское)</th><td>{{ $service->name_ru }}</td></tr>
                        <tr><th>Описание (узбекское)</th><td>{!! $service->description_uz !!}</td></tr>
                        <tr><th>Описание (русское)</th><td>{!! $service->description_ru !!}</td></tr>
                        <tr>
                            <th>Иконка</th>
                            <td>
                                @if ($service->icon)
                                    <a href="{{ $service->iconOriginal }}" target="_blank"><img src="{{ $service->iconThumbnail }}"></a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('admin-panel')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning card-outline">
                    <div class="card-header"><h3 class="card-title">Другие</h3></div>
                    <div class="card-body">
                        <table class="table {{--table-bordered--}} table-striped projects">
                            <tbody>
                            <tr><th>Добавил</th><td>{{ $service->createdBy->email }}</td></tr>
                            <tr><th>Редактировал</th><td>{{ $service->updatedBy->email }}</td></tr>
                            <tr><th>Добавлено</th><td>{{ $service->created_at }}</td></tr>
                            <tr><th>Редактировано</th><td>{{ $service->updated_at }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
