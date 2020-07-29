@extends('layouts.admin.page')

@section('content')
    <p><a href="{{ route('admin.services.create') }}" class="btn btn-success">Добавить</a></p>

    <div class="card mb-4">
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::text('name', request('name'), ['class'=>'form-control', 'placeholder' => 'Название']) !!}
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
            <th>Иконка</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($services as $service)
            <tr>
                <td><a href="{{ route('admin.services.show', $service) }}">{{ $service->name_ru }}</a></td>
                <td>{{ $service->iconThumbnail() }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $services->links() }}
@endsection
