@extends('layouts.admin.page')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.news.destroy', $news) }}" class="mr-1">
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
                        <tr><th>ID</th><td>{{ $news->id }}</td></tr>
                        <tr><th>Название (узбекское)</th><td>{{ $news->title_uz }}</td></tr>
                        <tr><th>Название (русское)</th><td>{{ $news->title_ru }}</td></tr>
                        <tr><th>Название меню (узбекское)</th><td>{{ $news->menu_title_uz ?: $news->title_uz }}</td></tr>
                        <tr><th>Название меню (русское)</th><td>{{ $news->menu_title_ru ?: $news->title_ru }}</td></tr>
                        <tr><th>Описание (узбекское)</th><td>{!! $news->description_uz !!}</td></tr>
                        <tr><th>Описание (русское)</th><td>{!! $news->description_ru !!}</td></tr>
                        <tr><th>Содержание (узбекское)</th><td>{!! $news->content_uz !!}</td></tr>
                        <tr><th>Содержание (русское)</th><td>{!! $news->content_ru !!}</td></tr>
                        <tr><th>Статус</th><td>{!! $news->getStatusLabel() !!}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-gray card-outline">
                <div class="card-header"><h3 class="card-title">Изображение</h3></div>
                <div class="card-body">
                    @if ($news->image)
                        <a href="{{ $news->imageOriginal }}" target="_blank"><img src="{{ $news->imageThumbnail }}"></a>
                    @endif
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
                            <tr><th>Добавил</th><td>{{ $news->createdBy->email }}</td></tr>
                            <tr><th>Редактировал</th><td>{{ $news->updatedBy->email }}</td></tr>
                            <tr><th>Добавлено</th><td>{{ $news->created_at }}</td></tr>
                            <tr><th>Редактировано</th><td>{{ $news->updated_at }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
