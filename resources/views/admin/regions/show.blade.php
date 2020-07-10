@extends('layouts.admin.page')

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.regions.edit', $region) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.regions.destroy', $region) }}" class="mr-1">
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
                        <tr><th>ID</th><td>{{ $region->id }}</td></tr>
                        <tr><th>Название (узбекское)</th><td>{{ $region->name_uz }}</td></tr>
                        <tr><th>Название (русское)</th><td>{{ $region->name_ru }}</td></tr>
                        <tr>
                            <th>Родительские регионы</th>
                            <td>
                                @php($parentRegion = $region->parent)
                                @while($parentRegion)
                                    <a href="{{ route('admin.regions.show', $parentRegion) }}">{{ $parentRegion->name_ru }}</a><br>
                                    @php($parentRegion = $parentRegion->parent)
                                @endwhile
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
                <div class="card card-green card-outline">
                    <div class="card-header"><h3 class="card-title">Другие</h3></div>
                    <div class="card-body">
                        <table class="table {{--table-bordered--}} table-striped projects">
                            <tbody>
                            <tr><th>Добавил</th><td><a href="{{ route('admin.users.show', $region->createdBy) }}">{{ $region->createdBy->email }}</a></td></tr>
                            <tr><th>Редактировал</th><td><a href="{{ route('admin.users.show', $region->updatedBy) }}">{{ $region->updatedBy->email }}</a></td></tr>
                            <tr><th>Добавлено</th><td>{{ $region->created_at }}</td></tr>
                            <tr><th>Редактировано</th><td>{{ $region->updated_at }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection
