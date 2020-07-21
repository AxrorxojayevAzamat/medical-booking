@extends('layouts.admin.page')

@section('content')
    <p><a href="{{ route('admin.news.create') }}" class="btn btn-success">Добавить</a></p>

    <div class="card mb-4">
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('title', request('title'), ['class'=>'form-control', 'placeholder' => 'Название']) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::select('status', \App\Entity\News::getStatusList(), request('status'), ['class'=>'form-control', 'placeholder' => 'Статус']) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Искать</button>
                            <a href="?" class="btn btn-outline-secondary">Очистить</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Название меню</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($news as $page)
            <tr>
                <td><a href="{{ route('admin.news.show', $page) }}">{{ $page->title_ru }}</a></td>
                <td>{{ $page->menu_title_ru ?: $page->title_ru }}</td>
                <td>{!! $page->getStatusLabel() !!}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $news->links() }}
@endsection
